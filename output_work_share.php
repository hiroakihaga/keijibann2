<?php
  $pdo = new PDO("データベース名",'ユーザー名','パスワード');
  if(isset($_GET['id']) && $_GET['id'] !== ""){
      $id = $_GET['id'];
  }else{
      header("Location: view_work.php");
  }
  $MIMETypes = array(
      "png" => "image/png",
      "jpeg" => "image/jpeg",
      "gif" => "image/gif",
      "mp4" => "video/mp4"
  );
  $sql = "SELECT * FROM works WHERE id = $id";
  $result = $pdo ->query($sql);
  foreach($result as $row){
      if($row['id'] == $_GET['id']){
          //echo "Content-Type: ".$MIMETypes[$row['extention']];
          header("Content-Type: ".$MIMETypes[$row['extention']]);
          echo $row['work'];
      }
  }
?>