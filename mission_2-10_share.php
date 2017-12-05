<?php

  //PDOでDBに接続する
  $pdo = new PDO("データベース名",'ユーザー名','パスワード');

  //文字化け対策
  $stmt = $pdo->query('SET NAMES utf8');

  //show create table　を使ってカラム型を確認
  $stmt = $pdo->query('SHOW CREATE TABLE works');

  foreach($stmt as $re){

    print_r($re);

  }

?>