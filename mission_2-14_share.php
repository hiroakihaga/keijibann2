<?php

  $pdo = new PDO("データベース名",'ユーザー名','パスワード');

$delete_id = "2";

  $stmt = $pdo -> prepare("DELETE FROM test WHERE id =:id");

  $stmt -> bindValue(':id',$delete_id,PDO::PARAM_INT);

  $stmt -> execute();