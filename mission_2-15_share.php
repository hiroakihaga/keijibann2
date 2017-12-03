<?php


      //DBに接続する。
      $pdo = new PDO("データベース名",'ユーザー名','パスワード');
     


  if($_SERVER['REQUEST_METHOD']==='POST'){


  //通常書き込み。編集用id無し、編集ボタンを押されなかった時に
  if( isset($_POST['comment']) && ("" == $_POST['edit_id']) ){
    if("" != $_POST['password']){
    if( !isset($_POST['edit'])){
  
      //フォームで受け取った内容を変数に格納する
      $name = $_POST['name'];
      $comment = $_POST['comment'];
      $password = $_POST['password'];

      //悪意のある投稿を除外する
      $name = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
      $comment = htmlspecialchars($comment, ENT_QUOTES, "UTF-8");
      $password = htmlspecialchars($password, ENT_QUOTES, "UTF-8");
  
      //改行コードを勝手に入れられる対策として、テキスト上の改行コードに置き換え
      $comment = str_replace(array("\r\n","\n","\r"),"<br/>",$comment);
  
      //日付を出力して変数に入れる。
      $date = date("Y-m-d H:i:s");
  
      
      //データを挿入(書き込み)する。
      $stmt = $pdo -> prepare("INSERT INTO contents(id,name,comment,password,date) VALUES('',:name,:comment,:password,:date)");


      echo $name;
      echo $comment;
      echo $password;
      echo $date;
      
      
      
      
      //受け取った変数を書き込む
      $stmt -> bindParam(':name',$name,PDO::PARAM_STR);
      $stmt -> bindParam(':comment',$comment,PDO::PARAM_STR);
      $stmt -> bindParam(':password',$password,PDO::PARAM_STR);
      $stmt -> bindParam(':date',$date,PDO::PARAM_INT);
      
      $stmt -> execute();
      
    }
    }
  }


  //削除用コード。パスワードが一致しているときだけ削除する
  if( isset($_POST['delete'])){
    
    //受け取る変数の設定
    $delnumber = $_POST['delete_res'];
    $delpass = $_POST['delete_pass'];
    
    //テーブル内のデータを取得
    $sql = 'SELECT * FROM contents';
    $result = $pdo->query($sql);
    foreach($result as $row){
      
      //投稿番号と削除番号を比較する
      if($row['id'] == $delnumber){
        //パスワードを確認する
        if($row['password'] == $delpass){
          //削除を行う
          $stmt = $pdo -> prepare("DELETE FROM contents WHERE id =:id");
          
          $stmt -> bindValue(':id',$delnumber,PDO::PARAM_INT);
          
          $stmt -> execute();
        }
      }

    }
    
  }



  //編集。パスワードが合っているときだけ書き込み内容を読み込む
  if( isset($_POST['edit'])){
  
    //変数の設定
    $editnum = $_POST['edit_res'];
    $editpass = $_POST['edit_pass'];
    
    //投稿内容をループさせてパスワードと投稿番号が合っていれば変数内に中身をいれる
    //テーブル内のデータを取得
    $sql = 'SELECT * FROM contents';
    $result = $pdo->query($sql);
    foreach($result as $editrow){

      //投稿番号が合っているか確認
      if($editrow['id'] == $editnum){
        //パスワードが合っているか確認
        if($editrow['password'] == $editpass){
        
          //書き込まれた内容を変数に格納
          $edittoukou = $editrow['id'];
          $editname = $editrow['name'];
          $editcomment = $editrow['comment'];
          $editpassword = $editrow['password'];
          
        }
      }
      
    }
    
  }


  //編集内容を再び書き込む。テーブル内のデータを引っ張ってきたときだけ動く。
  if( isset($_POST['comment']) && isset($_POST['edit_id']) ){
  
    //変数を設定する
    $edit_num = $_POST['edit_id'];
    $edit_pass = $_POST['password'];
    
    $sql = 'SELECT * FROM contents';
    $result = $pdo ->query($sql);
    foreach($result as $editrow){
    
      //idが一致していることを確認
      if( $editrow['id'] == $edit_num){
      
        //パスワードが一致していることを確認
        if( $editrow['password'] == $edit_pass){
        
          //テーブルの中身を編集する。
          $sql = "UPDATE contents SET name = :name, comment = :comment, password = :password, date = :date WHERE id = :id";
          
          //書き込みのコピペ
          
          $name = $_POST['name'];
          $comment = $_POST['comment'];
          $password = $_POST['password'];
  
          //悪意のある投稿を除外する
          $name = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
          $comment = htmlspecialchars($comment, ENT_QUOTES, "UTF-8");
          $password = htmlspecialchars($password, ENT_QUOTES, "UTF-8");
  
          //改行コードを勝手に入れられる対策として、テキスト上の改行コードに置き換え
          $comment = str_replace(array("\r\n","\n","\r"),"<br/>",$comment);
  
          //日付を出力して変数に入れる。
          $date = date("Y-m-d H:i:s");
          
          //書き込み。テーブルのデータを編集する。
          $stmt = $pdo -> prepare($sql);
          
          $stmt -> bindParam(':id',$edit_num,PDO::PARAM_INT);
          $stmt -> bindParam(':name',$name,PDO::PARAM_STR);
          $stmt -> bindParam(':comment',$comment,PDO::PARAM_STR);
          $stmt -> bindParam(':password',$password,PDO::PARAM_STR);
          $stmt -> bindParam(':date',$date,PDO::PARAM_INT);
          
          $stmt -> execute();
      
        }
      
      }
    
    }

  }
  
  
  }


?>







<!DOCTYPE html>
<html lang = "ja">
<head>
 <meta charset = "UTF-8">
 <title>アニメ考察板</title><br/>
</head>

<body>

<!--見出しはh1で作る-->
<h1>好きなアニメについて詳しく語ろう</h1>

  <form action = "mission_2-15.php" method = "post">
  <input type = "hidden" name = "edit_id" value = <?php echo $edittoukou; ?> >

  名前<br/>
  <input type = "text" name = "name" size = "20" value =<?php echo $editname; ?> ><br/>

  コメント<br/>
  <textarea name = "comment" cols = "50" rows = "5"> <?php echo $editcomment; ?> </textarea><br/>
  
  パスワード<br/>
  <input type = "text" name = "password" value = <?php echo $editpassword; ?> ><br/>

  <input type = "submit" name = "sousinn" value = "送信">

<br/><br/>

  削除対象番号<br/>
  <input type = "number" name = "delete_res"><br/>
  パスワードを入力してください<br/>
  <input type = "text" name = "delete_pass">
  <input type = "submit" name = "delete" value = "削除する">

  <br/><br/>
  
  編集対象番号<br/>
  <input type = "number" name = "edit_res"><br/>
  パスワードを入力してください<br/>
  <input type = "text" name = "edit_pass">
  <input type = "submit" name = "edit" value = "編集する">

</form>

</body>
</html>

<?php

  //テーブルの保存内容をパスワードを抜いて表示する。
  
  //接続
  $pdo = new PDO("mysql:dbname=co_998_it_99sv_coco_com;host=localhost",'co-998.it.99sv-c','Nfhf6G');

  //データの取得
  $sql = 'SELECT * FROM contents order by id';
  
  //実行して結果を取得
  $result = $pdo ->query($sql);
  
  //出力する
  foreach($result as $row){
  
    echo $row['id'].'<br>';
    
    echo $row['name'].'<br>';
    
    echo $row['comment'].'<br>';
    
    echo $row['date'].'<br>';
    
  }
  
?>