<?php

  $pdo = new PDO("データベース名",'ユーザー名','パスワード');


  $sql = 'CREATE TABLE works
    (
      id INT(16) AUTO_INCREMENT,
      title VARCHAR(64),
      caption TEXT,
      work MEDIUMBLOB,
      extention VARCHAR(10),
      username VARCHAR(32),
      userid INT(16),
      date DATETIME,
      PRIMARY KEY(id)
    );';

  $result = $pdo->query($sql);

?>