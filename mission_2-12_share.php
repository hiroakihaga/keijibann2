<?php

  $pdo = new PDO("データベース名",'ユーザー名','パスワード');

  //データの取得
  $sql = 'SELECT * FROM test order by id';

  //実行して結果を取得
  $result = $pdo->query($sql);

  //出力する

  foreach($result as $row){

    echo $row['id'].',';

    echo $row['name'].',';

    echo $row['age'].',';

    echo $row['content'].'<br>';

  }

?>