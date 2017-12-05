<?php

$filename = 'kadai2-2.txt';

$fp = fopen($filename,'a');

$name = ($_POST['name']);
$comment = ($_POST['comment']);
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
$count = count($lines)+1;
$date = date ("Y-m-d H:i:s");

fwrite($fp, $count."<>".$name."<>".$comment."<>".$date."<>"."\n");


fclose($fp);

?>

<!DOCTYPE html>
<html lang = "ja">
<head>
 <meta charset = "UTF-8">
 <title>アニメ考察板</title><br/>
</head>

<body>

<h1>好きなアニメについて詳しく語ろう</h1>

 <form action = "mission_2-2.php" method = "post">

  名前<br/>
  <input type = "text" name = "name" size = "20" ><br/>

  コメント<br/>
  <textarea name = "comment" cols = "50" rows = "5"></textarea><br/>
  <br/>

  <input type = "submit" value = "送信する">
  <input type = "reset" value = "取り消す">

 </form>
</body>
</html>