<?php

  $pdo = new PDO("データベース名",'ユーザー名','パスワード');

  $sql = 'CREATE TABLE test
    (
     id INT AUTO_INCREMENT,
     name VARCHAR(255),
     age INT,
     content TEXT,
     PRIMARY KEY(id)
    );';

  $result = $pdo->query($sql);