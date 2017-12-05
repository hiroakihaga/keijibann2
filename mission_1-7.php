<h1>好きなアニメ</h1>
<form action = "mission_1-7.php" method = "get">
<p>

<input type="text" name="comment">
</p>

<input type="submit" value="送信">

</form>

<?php

//kadai7をまず作って(kadai7のテキストファイルを変数に格納)、変数$commentの中身に入力フォームの中身を設定
$filename = 'kadai7.txt';
$comment = ($_GET['comment']);

//変数の中身がcommentになっていることを確認するためのデバッグ用echo
//echo ($comment);

//if(){}によりcomment内に書き込みがあればkadai7の中に書き込まれる
if ($comment){

//'w'は書き込みモード(中身を書き換えられる)、'a'は追記モード(ファイルの内容に追記が出来る)
$fp = fopen($filename, 'a');

/*テキスト内にcommentを書き込む部分、ここでは直接変数を用いる際には""や''は用いない
更にfwrite関数を改行する際に "\n" を入れる(ダブルクォーテーションで！)*/
fwrite($fp, $comment."\n");

fclose($fp);

}

?>

<?php

//ファイルを配列に格納し、さらに変数に格納

//file() でファイル全体を読み込んで、配列に格納→その配列に$lineという変数を与える
$lines = file($filename, FILE_SKIP_EMPTY_LINES);

/* foreach(配列変数 as 変数){
   繰り返したい処理
   } 
   は配列の中身(要素)を最後に要素まで勝手に繰り返してくれる。*/

foreach ($lines as $line){

//今回はechoを繰り返す。変数$lineを入れて<br>で表示文に区切り。\nで改行してから
//echoの繰り返しをしてもらう。
echo "$line<br/>\n";
}

?>