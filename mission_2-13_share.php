<?php

  $pdo = new PDO("データベース名",'ユーザー名','パスワード');
  //テーブルのデータを編集する
  //"UPDATE テーブル名　SET　変更したいフィールド名　WHERE　id = レコード検索用の場所"
  $sql = "UPDATE test SET name = :name, age = :age, content = :content WHERE id = :id";
  //$sql = "update test set name = :name, age = :age, content = :content where id = :id";

  $myname = "カリスト";
  $myage = "25";
  $mycontent = "こんばんわ";

  $stmt = $pdo -> prepare($sql);
  
  $stmt -> bindValue(':id',5, PDO::PARAM_INT);

  $stmt -> bindParam(':name',$myname, PDO::PARAM_STR);

  $stmt -> bindValue(':age',$myage, PDO::PARAM_INT);
  //$stmt -> bindValue(':age',25,PDO::PARAM_INT);

  $stmt -> bindParam(':content',$mycontent,PDO::PARAM_STR);

  $stmt ->execute();

?>