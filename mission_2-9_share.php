<?php

  //テーブルの一覧の表示

  //PDOでDBに接続する
  $pdo = new PDO("データベース名",'ユーザー名','パスワード');

  //文字化け対策
  $stmt = $pdo->query('SET NAMES utf8');

  //テーブル一覧の表示
  $stmt = $pdo->query('SHOW TABLES FROM co_998_it_99sv_coco_com ');

  foreach($stmt as $re){
    
    echo $re[0];
    
    echo '<br>';

  }

?>