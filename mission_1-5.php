<form action = "mission_1-5.php" method = "get">
<p>

<input type="text" name="comment">
</p>

<input type="submit" value="送信">

</form>

<?php

//kadai5をまず作って、変数$commentの中身に入力フォームの中身を設定
$filename = 'kadai5.txt';
$comment = ($_GET['comment']);

//変数の中身がcommentになっていることを確認するためのデバッグ用echo
echo ($comment);

//ifによりcomment内に書き込みがあればkadai5の中に書き込まれる
if ($comment){

$fp = fopen($filename, 'w');

//テキスト内にcommentを書き込む部分、直接変数を用いる際には""や''は用いない(？)要確認
fwrite($fp, $comment);

fclose($fp);

}

?>