<?php
  session_start();
  $pdo = new PDO("データベース名",'ユーザー名','パスワード');
  $sql = 'SELECT * FROM works order by id';
  $result = $pdo ->query($sql);
  foreach($result as $row){
    if($row['userid'] == $_SESSION['userid']){
      echo ($row['id']."<br/>");
      $id = $row['id'];
      //画像と動画で仕分ける
      if($row['extention'] == "mp4"){
          echo ("<video src=\".$row['work']." width=\"426\" height=\"240\" controls></video>");
      }else if($row['extention'] == "jpeg" || $row['extention'] == "png" || $row['extention'] == "gif"){
          //echo ("<img src='output_work.php?id=".$id."'>");
          echo "<img src=".$row['work'].">";
      }
      echo ("<br/><br/>");
    }
  }
?>