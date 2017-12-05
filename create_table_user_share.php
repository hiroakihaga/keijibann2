<?php

  //DBに接続
  $pdo = new PDO("データベース名",'ユーザー名','パスワード');

  //テーブル作成(ユーザーデータ登録用)
  $sql = 'CREATE TABLE user
    (
      id INT AUTO_INCREMENT,
      name VARCHAR(32),
      pass VARCHAR(100),
      PRIMARY KEY(id)
    );';
    
  $result = $pdo->query($sql);
  
?>