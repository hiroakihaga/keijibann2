<?php

  $pdo = new PDO("データベース名",'ユーザー名','パスワード');
  
  $sql = "DROP TABLE IF EXISTS works";
  
  $pdo -> exec($sql);
  
?>