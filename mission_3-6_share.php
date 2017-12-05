<?php 

  //接続
  $pdo = new PDO("データベース名",'ユーザー名','パスワード');
  
  //登録ボタンを押したらスタート
  if(isset($_POST['entry'])){
      
      //ユーザー名とパスワードが入力されているかチェック
      if(empty($_POST['name'])){
          //$errorMessage = 'ユーザーIDが未入力です';
          echo "<script>alert('ユーザー名が未入力です')</script>";
      }else if(empty($_POST['pass1'])){
          //$errorMessage = 'パスワードが未入力です';
          echo "<script>alert('パスワードが未入力です')</script>";
      }else if(empty($_POST['pass2'])){
          //$errorMessage = 'パスワードが未入力です';
          echo "<script>alert('パスワードが未入力です')</script>";
      }
      
      //全て入力されたうえでpass1とpass2が同じであればレコードに挿入
      if(isset($_POST['name']) && isset($_POST['pass1']) && isset($_POST['pass2']) && $_POST['pass1'] == $_POST['pass2']){
      
          //変数の設定
          $name = $_POST['name'];
          $pass = $_POST['pass1'];
          
          //echo $name;
          //echo $pass;
      
          $name = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
          $pass = htmlspecialchars($pass, ENT_QUOTES, "UTF-8");
      
          //データを挿入する
          $stmt = $pdo -> prepare("INSERT INTO user(id,name,pass) VALUES('',:name,:pass)");
      
          $stmt -> bindParam(':name',$name,PDO::PARAM_STR);
          $stmt -> bindParam(':pass',$pass,PDO::PARAM_STR);
      
          $stmt -> execute();
      
          //$userid = $pdo -> lastinsertid();
          //$signUpMessage = '登録が完了しました。登録ID'.$userid.'。パスワードは'.$pass.'です。';
      
          //データの取得
          $sql = 'SELECT * FROM user';
          
          $result = $pdo -> query($sql);
          
          foreach($result as $row){
          
              //名前とパスワードが一致しているときにIDを取り出して表示する
              if($row['name'] == $name && $row['pass'] == $pass){
              
                  //書き込まれた内容を変数に格納
                  $id = $row['id'];
                  echo "登録ありがとうございます。あなたのIDは".$id."、パスワードは".$pass."です";
                  
              }
              
          }
      
      
      }else if($_POST['pass1'] != $_POST['pass2']){
          $errorMessage = 'パスワードに誤りがあります';
          echo "<script>alert('パスワードに誤りがあります')</script>";
      }
      
  }

?>



<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "UTF-8">
<title>新規登録</title>
</head>

<body> 

  <h1>新規登録画面</h1>
  <br/><br/>
  
    <form action = "mission_3-6.php" method = "POST">
    
    名前<br/>
    <input type = "text" name = "name" size = "20" ><br/>
    
    <br/>
    
    パスワード<br/>
    <input type = "text" name = "pass1"><br/>
    
    確認の為、パスワードをもう一回入力してください<br/>
    <input type = "text" name = "pass2"><br/>
    
    <input type = "submit" name = "entry" value = "登録">
    
    <br/>
    
</body>
</html>

