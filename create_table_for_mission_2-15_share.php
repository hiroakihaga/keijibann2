<?php


  //DBに接続する。
  $pdo = new PDO("データベース名",'ユーザー名','パスワード');

  //テーブル作成(なかったら作る)
  $sql = 'CREATE TABLE contents
    (
      id INT AUTO_INCREMENT,
      name VARCHAR(255),
      comment TEXT,
      password VARCHAR(20),
      date DATETIME,
      PRIMARY KEY(id)
    );';

  $result = $pdo->query($sql);

?>