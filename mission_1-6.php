<form action = "mission_1-6.php" method = "get">
<p>

<input type="text" name="comment">
</p>

<input type="submit" value="送信">

</form>

<?php

//kadai6をまず作って、変数$commentの中身に入力フォームの中身を設定
$filename = 'kadai6.txt';
$comment = ($_GET['comment']);

//変数の中身がcommentになっていることを確認するためのデバッグ用echo
echo ($comment);

//if(){}によりcomment内に書き込みがあればkadai6の中に書き込まれる
if ($comment){

//'w'は書き込みモード(中身を書き換えられる)、'a'は追記モード(ファイルの内容に追記が出来る)
$fp = fopen($filename, 'a');

/*テキスト内にcommentを書き込む部分、ここでは直接変数を用いる際には""や''は用いない
更にfwrite関数を改行する際に "\n" を入れる(ダブルクォーテーションで！)*/
fwrite($fp, $comment."\n");

fclose($fp);

}

?>