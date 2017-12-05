<?php

  $pdo = new PDO("データベース名",'ユーザー名','パスワード');


  //INSERT文でmysqlにデータを送信する

  //bindParamは実行したときの変数が入る。
  //bindValueは関数を書いた時点の変数が入る
  //つまりbindParamは実行前であれば中身を変更することが出来る。
  //PARAM_STRは文字列であることを表す。PARAM_INTは数値であることを表す。文字列の場合はbindParamを使うべき。

  //$sql = "INSERT INTO test(id,name,age,content) VALUES ('',:name,:age,:content)";
  $stmt = $pdo -> prepare("INSERT INTO test(id,name,age,content) VALUES ('',:name,:age,:content)");

  //あらかじめ$nameに名前を入れておく
$name = "hiroaki";
$age = "21";
$content = "こんにちは";


  $stmt -> bindParam(':name',$name,PDO::PARAM_STR);

  $stmt -> bindValue(':age',$age,PDO::PARAM_INT);

  $stmt -> bindParam(':content',$content,PDO::PARAM_STR);

  $stmt -> execute();

?>