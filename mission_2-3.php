<!DOCTYPE html>
<html lang = "ja">
<head>
 <meta charset = "UTF-8">
 <title>アニメ考察板</title><br/>
</head>



<?php

$filename = 'kadai2-3.txt';

//まずファイルを開かないと投稿番号がずれるのでひらく
$fp = fopen($filename,'a');

//変数で送信された情報を受け取る。
/*file()でファイルの中身を一行ごとに変数にして配列に格納してcountを使うことでその行数を読み込み、
そのカウントに＋1することで投稿番号を表示する。*/
$name = ($_POST['name']);
$comment = ($_POST['comment']);
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
$count = count($lines)+1;
$date = date ("Y-m-d H:i:s");

//"と'の違いについてはしっかり調べること！！ここでは区切り文字には’で囲むのが正しかった。
fwrite($fp, $count.'<>'.$name.'<>'.$comment.'<>'.$date.'<>'."\n");


fclose($fp);

?>


<body>

<!--見出しはh1で作る-->
<h1>好きなアニメについて詳しく語ろう</h1>

 <form action = "mission_2-3.php" method = "post">

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

<?php

//まずfile_get_contentsでkadai.txtの中身を読み込む。
//この時変数を利用しないと中身を開くことができなかった。注意
 $data = file_get_contents( $filename );

 //関数explodeを使うことで区切り文字で文字列を分解し配列の中へ格納する。
 //使い方は　explode ( "区切り文字", 区切りたい配列 )
 $data = explode( "<>",$data );
 
 //更にここで区切った後の配列の中身をcountで数える。
 //ここでカウントされた分だけ、forで繰り返される。
 $cnt = count( $data );
 
 /*forの使い方。
   for(カウンタの初期値; ループ処理の条件式; 増減式){
   処理を実行する
   }
   この時の変数は０スタートなのでカウンタも０からスタート
   条件は、上のcountで数えた分だけ動いてほしいので$cntまで動くように
   $iに１ずつ足していくようにする。*/
   /*さっきも書いたように配列は０からスタートなので$data[$i]から
　echoを繰り返してもらう。さらに改行をしてほしいので、後ろに
　<br/>\nをつけてまとめて""で囲む。*/
  for( $i=0;$i<$cnt;$i++ )
  {
  echo "$data[$i]<br/>\n";
  }

?>