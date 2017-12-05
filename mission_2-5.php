


<?php

$filename = 'kadai2-5.txt';

//$edit_id = $_POST['edit_id'];
//echo $edit_id;

//まずファイルを開かないと投稿番号がずれるのでひらく
$fp = fopen($filename,'a');

//編集機能を使わなかった場合、edit_idは送られてこない
//編集用と区別する。こちらは新規書き込み用。
//if( isset($_POST['comment']) ){
//if( isset($_POST['comment']) && !isset($_POST['edit_id']) ){

if( isset($_POST['comment']) && ("" == $_POST['edit_id'])){
  $comment = $_POST['comment'];

  //変数で送信された情報を受け取る。
  /*file()でファイルの中身を一行ごとに変数にして配列に格納してcountを使うことでその行数を読み込み、
  そのカウントに＋1することで投稿番号を表示する。*/
  $name = ($_POST['name']);

  //悪意のある入力を避けるためにhtmlspecialchars()を使う。
  $name = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
  //$comment = ($_POST['comment']);
  $comment = htmlspecialchars($comment, ENT_QUOTES, "UTF-8");

  //改行コードが勝手に入れられてしまうので、str_replace()でソース上の改行コードをテキスト上の改行コードに書き換える。
  $comment = str_replace(array("\r\n","\n","\r"),"<br/>",$comment);
  $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
  $toukou = count($lines)+1;
  $date = date ("Y-m-d H:i:s");

  //改行用の関数nl2br()で改行をコードに直してもらう。
  $write = nl2br( $toukou.'<>'.$name.'<>'.$comment.'<>'.$date);
  //$write = ( $count.'<>'.$name.'<>'.$comment.'<>'.$date);


  //"と'の違いについてはしっかり調べること！！ここでは区切り文字には’で囲むのが正しかった。
  //fwrite($fp, $count.'<>'.$name.'<>'.$comment.'<>'.$date.'<>'."\n");
  fwrite($fp, $write.'<>'."\n");

  }

fclose($fp);


//削除用コード
  if (isset($_POST['delete'])){
      $delnumber = $_POST['delete_res'];
      $delcon = file($filename);
      $count = count($delcon);

      $fp = fopen($filename,"w");
       for( $j=0; $j<$count; $j++ ){
        $deldata = explode("<>",$delcon[$j]);
         if ($deldata[0] !=$delnumber){
         fwrite($fp,$delcon[$j]);
        } else {
         fwrite($fp,"※削除しました。".'<>'."\n");
        }
       }
      fclose($fp);
   }


 if (isset($_POST['edit'])){
     $editnum = $_POST['edit_res'];
     $editcon = file($filename);
     $editcount = count($editcon);

      //$fp = fopen($filename,"r+");
       for( $j=0; $j<$editcount; $j++ ){
         $editdata = explode("<>",$editcon[$j]);
        
          if ($editdata[0] == $editnum){
            $edittoukou = $editdata[0];
            $editname = $editdata[1];
            $editcomment = $editdata[2];
          }
       }
      //fclose($fp);
     }


//編集によりedit_idが送られた場合。編集用コード
if(isset($_POST['comment']) && isset($_POST['edit_id'])){

  $edit_num = $_POST['edit_id'];
  $editcon = file($filename);
  $editcount = count($editcon);
  
  $fp = fopen($filename,"w");
        for( $j=0; $j<$editcount; $j++ ){
          $editdata = explode("<>",$editcon[$j]);
            
            if ($editdata[0] ==$edit_num){
              
              $comment = $_POST['comment'];
              $name = ($_POST['name']);
              $name = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
              $comment = htmlspecialchars($comment, ENT_QUOTES, "UTF-8");
              $comment = str_replace(array("\r\n","\n","\r"),"<br/>",$comment);
              $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
              $toukou = count($lines)+1;
              $date = date ("Y-m-d H:i:s");
              $write = nl2br( $toukou.'<>'.$name.'<>'.$comment.'<>'.$date);

              fwrite($fp, $write.'<>'."\n");
            } else {
              fwrite($fp, $editcon[$j]);
            }
        }
  fclose($fp);
 }

?>


<!DOCTYPE html>
<html lang = "ja">
<head>
 <meta charset = "UTF-8">
 <title>アニメ考察板</title><br/>
</head>



<body>

<!--見出しはh1で作る-->
<h1>好きなアニメについて詳しく語ろう</h1>

 <form action = "mission_2-5.php" method = "post">
<input type = "hidden" name = "edit_id" value = <?php echo $edittoukou; ?> >
  
 名前<br/>
  <input type = "text" name = "name" size = "20"  value = <?php echo $editname; ?>><br/>

  コメント<br/>
  <textarea name = "comment"cols = "50"rows = "5" > <?php echo $editcomment; ?> </textarea><br/>
  <br/>

  <input type = "submit"　name = "sousinn" value = "送信する">
  <input type = "reset" value = "取り消す">


<br/><br/>
 

  削除対象番号<br/>
  <input type = "number" name = "delete_res">
  <input type = "submit" name = "delete" value = "削除する">
 

  
<br/>

 編集対象番号<br/>
 <input type = "number" name = "edit_res">
 
 <input type = "submit" name = "edit" value = "編集する">

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

