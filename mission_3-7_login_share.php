<?php

  //接続
  $pdo = new PDO("データベース名",'ユーザー名','パスワード');


  //セッション開始。サーバー側に変数としてユーザー情報を一時的に格納する。
  session_start();

  //ログインボタンが押された時、確認開始
  if(isset($_POST['login'])){

      //各項目がちゃんと入力されているか確認
      if(empty($_POST['userid'])){
          echo "<script>alert('ユーザーIDが未入力です')</script>";
      }else if(empty($_POST['password'])){
          echo "<script>alert('パスワードが未入力です')</script>";
      }
      
      //どちらも入力されている時スタート
      if(isset($_POST['userid']) && isset($_POST['password'])){
      
          //ユーザーIDを変数に格納
          $userid = $_POST['userid'];
          $password = $_POST['password'];
          
          //ユーザー情報を取得
          $sql = 'SELECT * FROM user';
          
          $result = $pdo -> query($sql);
          
          foreach($result as $row){
          
              //ユーザーIDとパスワードが一致している時、登録した名前を取り出す
              if($row['id'] == $userid && $row['pass'] == $password){
              
                  //DB内の名前のデータをセッション変数に入れる。
                  $_SESSION['name'] = $row['name'];
                  $_SESSION['userid'] = $row['id'];
                  
                  //掲示板ページに転送
                  header('Location: mission_3-8_toukou.php');
                  
                  //飛んだあと処理を終了させるコマンド
                  exit();
                  
              } else {
              
                  //合ってなかったとき
                  echo "<script>alert('ユーザーIDあるいはパスワードに誤りがあります')</script>";
                  
              }
              
          }
          
      }

  }

?>


<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "UTF-8">
<title>ログイン</title>
</head>

<body>

  <h1>ログイン画面</h1><br/><br/>
  
  
    <form aciton = "mission_3-7_login.php" method = "POST">
    
      ユーザーID<br/>
      <input type = "text" name = "userid" ><br/><br/>
    
      パスワード<br/>
      <input type = "text" name = "password"><br/>
    
      <input type = "submit" name = "login" value = "ログイン">
  
    </form>
    <br/>
    
    <form action = "mission_3-6.php">
    
      新規登録の方はこちら<br/>
      <input type = "submit" value = "新規登録">
      
    </form>
    
</body>

<html>