<?php
  
  $pdo = new PDO("データベース名",'ユーザー名','パスワード');
  

  
  //セッション開始
  session_start();
  
  //echo $_SESSION['userid'];
  
  //ポストで送られたときだけ稼働
  if($_SERVER['REQUEST_METHOD']==='POST'){
  
      //投稿ボタンを押されたらスタート
      if(isset($_POST['submit'])){
      
        if(is_uploaded_file($_FILES['workfile']['tmp_name'])){
      
          //ユーザーIDが入っていない時は投稿させない
          if(empty($_POST['userid'])){
              echo "<script>alert('ログインしてください')</script>";
          }else if(empty($_POST['title'])){
              echo "<script>alert('タイトルを入力してください')</script>";
          }
          
          
          //入力欄が全て埋まっているときDBに挿入する。
          if(isset($_POST['name']) && isset($_POST['title']) ){
          
              //変数に入れる
              $name = $_POST['name'];
              $title = $_POST['title'];
              $caption = $_POST['caption'];
              $userid = $_POST['userid'];
              
              //拡張子の取得
              //$file_nm = $_FILES['workfile']['name'];
              //$tmp_ary = explode('.', $file_nm);
              //$extension = $tmp_ary[count($tmp_ary)-1];
              //echo ($extension);
              
              //拡張子の取得ver2
              $tmp = pathinfo($_FILES['workfile']['name']);
              $extention = $tmp['extension'];
              
              //echo $extention;
              if($extention === "jpg" || $extention === "jpeg" || $extention === "JPG" || $extention === "JPEG"){
                  $extention = "jpeg";
              }else if($extention === "png" || $extention === "PNG"){
                  $extention = "png";
              }else if($extention === "gif" || $extention === "GIF"){
                  $extention = "gif";
              }else if($extention === "mp4" || $extention === "MP4"){
                  $extention = "mp4";
              }else{
                  echo "<script>alert('ファイル形式が違います')</script>";
                  echo ("<a href=\"mission_3-8_toukou.php\">戻る</a><br/>");
                  exit(1);
              }
              
              
              //echo $extention;
              
            //ファイル読み込みと変数格納(失敗)
            //$workfile = $_FILES['workfile']['tmp_name'];
            //$getfile = file_get_contents($workfile);
              
            //バイナリデータにして変数に格納
            //$fp = fopen($_FILES['workfile']['tmp_name'], "rb");
            //$getfile = fread($fp, filesize($_FILES['workfile']['tmp_name']));
            //fclose($fp);
              
              //画像をサーバーに保存してそのパスをDBに保存する。
              $tempfile = $_FILES['workfile']['tmp_name'];
              $getfile = './'.$_FILES['workfile']['name'];
  
              
  
                  if(move_uploaded_file($tempfile,$getfile)){
                      echo $getfile."をアップロードしました";
                      echo "<img src=$getfile>";
                  }else{
                      echo "ファイルをアップロードできません";
                  }
              
              
              
              //echo $getfile;
              
              
              //悪意のある投稿対策
              $name = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
              $title = htmlspecialchars($title, ENT_QUOTES, "UTF-8");
              $caption = htmlspecialchars($caption, ENT_QUOTES, "UTF-8");
              
              //改行コードを勝手に入れられる対策として、テキスト上の改行コードに置き換え
              $caption = str_replace(array("\r\n","\n","\r"),"<br/>",$caption);
              
              //日付の出力
              $date = date("Y-m-d H-i-s");
              
              //データの挿入
              $stmt = $pdo -> prepare("INSERT INTO works(id,title,caption,work,extention,username,userid,date) VALUES('',:title,:caption,:work,:extention,:username,:userid,:date)");
              
              //受け取った変数を書き込む
              $stmt -> bindParam(':title',$title,PDO::PARAM_STR);
              $stmt -> bindParam(':caption',$caption,PDO::PARAM_STR);
              $stmt -> bindParam(':work',$getfile,PDO::PARAM_LOB);
              $stmt -> bindParam(':extention',$extention,PDO::PARAM_STR);
              $stmt -> bindParam(':username',$name,PDO::PARAM_STR);
              $stmt -> bindParam(':userid',$userid,PDO::PARAM_INT);
              $stmt -> bindParam(':date',$date,PDO::PARAM_INT);
              
              $stmt -> execute();
              
              echo "投稿が完了しました";
              
          }
          
        }else{
            echo "ファイルが選択されていません";
        }
      }
      
  }







?>


<!DOCTYPE html>
<html lang = "ja">
<head>
 <meta charset = "UTF-8">
 <title>投稿画面</title><br/>
</head>

<body>

<!--見出しはh1で作る-->
  <h1>作品投稿</h1>
  
    <form action = "mission_3-8_toukou.php" method = "post" enctype = "multipart/form-data">
    <input type = "hidden" name = "userid" value = <?php echo $_SESSION['userid']; ?> >
    
    投稿者名<br/>
    <input type = "text" name = "name" size = "20" value = <?php echo $_SESSION['name']; ?> ><br/>
    
    作品(jpeg,png,gif,mp4のみ投稿可能です)<br/>
    <input type = "file" name = "workfile"><br/>
    
    タイトル<br/>
    <input type = "text" name = "title"><br/>
    
    キャプション<br/>
    <textarea name = "caption" cols = "50" rows = "3"></textarea><br/>
    
    <input type = "submit" name = "submit" value = "送信">
    
</form>
</body
</html>