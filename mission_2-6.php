<?php

  //テキストファイルを作る
  $filename = 'kadai2-6.txt';

  if($_SERVER['REQUEST_METHOD']==='POST'){

  //ファイルを開く
  $fp = fopen($filename,'a');

  //ファイル書き込み、新規書き込み用
  if( isset($_POST['comment']) && ("" == $_POST['edit_id']) ){
    if("" != $_POST['password']){
    //if( isset($_POST['password'])){
    if( !isset($_POST['edit'])){

      //変数の設定
      $comment = $_POST['comment'];
      $name = $_POST['name'];
      $password = $_POST['password'];

      //悪意のある投稿の除外
      $comment =  htmlspecialchars($comment, ENT_QUOTES, "UTF-8");
      $name =  htmlspecialchars($name, ENT_QUOTES, "UTF-8");
      $password =  htmlspecialchars($password, ENT_QUOTES, "UTF-8");

      //改行コードを勝手に入れられる対策として、テキスト上の改行コードに置き換え
      $comment = str_replace(array("\r\n","\n","\r"),"<br/>",$comment);

      //ファイル内を一行ずつ変数に格納し配列に収め、その総数プラス１で投稿番号を作成
      $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
      $toukou = count($lines)+1;

      //日付を出力して変数に入れる。
      $date = date("Y-m-d H:i:s");

      //改行用の関数nl2br()を間に挟み、改行をコードに直してもらう。
      $write = nl2br( $toukou.'<>'.$name.'<>'.$comment.'<>'.$password.'<>'.$date);

      //ファイルに書き込む。
      fwrite($fp, $write.'<>'."\n");

     }
     }
  }

  //ファイルを閉じる。
  fclose($fp);

  //削除用コード。パスワードが一致しているときだけ消すようにする。
  if( isset($_POST['delete'])){

    //受け取る変数の設定
    $delnumber = $_POST['delete_res'];
    $delpass = $_POST['delete_pass'];
    $delcon = file($filename);
    $count = count($delcon);

    $fp = fopen($filename,"w");
      for( $j=0; $j<$count; $j++ ){
        $deldata = explode("<>",$delcon[$j]);

          //投稿番号とパスワードが一致したときだけ削除を行う。
          //書き込みの順番から、投稿番号は配列の0番目、パスワードは3番目となる。
          if( $deldata[0] != $delnumber && $deldata[3] != $delpass){
            fwrite($fp,$delcon[$j]);
          } else {
            fwrite($fp,"※削除しました。".'<>'."\n");
          }
      }
    fclose($fp);
  }

  //編集用コード。こちらもパスワードが一致しているときのみデータを吸い出す
  if ( isset($_POST['edit']) ){
    
    //変数の設定
    $editnum = $_POST['edit_res'];
    $editpass = $_POST['edit_pass'];
    $editcon = file($filename);
    $editcount = count($editcon);

    //書き込まれたデータから投稿番号とパスが一致したものを抜き出す。
    for( $j=0; $j<$editcount; $j++ ){
      $editdata = explode("<>",$editcon[$j]);

      if ($editdata[0] == $editnum && $editdata[3] == $editpass){ 
        $edittoukou = $editdata[0];
        $editname = $editdata[1];
        $editdata[2] = str_replace('<br/>', '', $editdata[2]);
        $editcomment = $editdata[2];
        $editpassword = $editdata[3];
      }
    }
  }


  //編集時、edit_idが贈られたとき。ファイル上書き。
  if ( isset($_POST['comment']) && isset($_POST['edit_id']) ){
  
    //変数設定
    $edit_num = $_POST['edit_id'];
    $editcon = file($filename);
    $editcount = count($editcon);

    $fp = fopen($filename,"w");
    for( $j=0; $j<$editcount; $j++ ){
      $editdata = explode("<>",$editcon[$j]);

      //編集番号が一致している時、新たに上書きする。一致していなければ中身をそのまま書き込み
      if ($editdata[0] ==$edit_num){

        //以下通常書き込み時のコピペ
        //変数の設定
        $comment = $_POST['comment'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        //悪意のある投稿の除外
        $comment =  htmlspecialchars($comment, ENT_QUOTES, "UTF-8");
        $name =  htmlspecialchars($name, ENT_QUOTES, "UTF-8");
        $password =  htmlspecialchars($password, ENT_QUOTES, "UTF-8");

        //改行コードを勝手に入れられる対策として、テキスト上の改行コードに置き換え
        $comment = str_replace(array("\r\n","\n","\r"),"<br/>",$comment);

        //ファイル内を一行ずつ変数に格納し配列に収め、その総数プラス１で投稿番号を作成
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
        $toukou = count($lines)+1;

        //日付を出力して変数に入れる。
        $date = date("Y-m-d H:i:s");

        //改行用の関数nl2br()を間に挟み、改行をコードに直してもらう。
        $write = nl2br( $toukou.'<>'.$name.'<>'.$comment.'<>'.$password.'<>'.$date);

        //ファイルに書き込む。
        fwrite($fp, $write."\n");
      } else {
        fwrite($fp, $editcon[$j]);
      }
    }
    fclose($fp);
  }

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

 <form action = "mission_2-6.php" method = "post">
<input type = "hidden" name = "edit_id" value = <?php echo $edittoukou; ?> >
  
  名前<br/>
  <input type = "text" name = "name" size = "20"  value = <?php echo $editname; ?> ><br/>

  コメント<br/>
  <textarea name = "comment"cols = "50"rows = "5" > <?php echo $editcomment; ?> </textarea><br/>
  <br/>

  パスワード<br/>
  <input type = "text" name = password value = <?php echo $editpassword; ?> ><br/>

  <input type = "submit"　name = "sousinn" value = "送信する">
  <input type = "reset" value = "取り消す">


<br/><br/>
 

  削除対象番号<br/>
  <input type = "number" name = "delete_res"><br/>
  パスワード<br/>
  <input type = "text" name = "delete_pass">
  <input type = "submit" name = "delete" value = "削除する">
 

  
<br/>

  編集対象番号<br/>
  <input type = "number" name = "edit_res"><br/>
  パスワード<br/>
  <input type = "text" name = "edit_pass">
  <input type = "submit" name = "edit" value = "編集する">

</form>

</body>
</html>

<?php

/*
  //書き込んだ内容をパスワード抜きで表示する。
  
  //ファイルの中身を変数に格納。
  $data = file_get_contents($filename);
  $data = explode("<>",$data);
  $cnt = count($data);
  
  for( $i=0; $i<$cnt; $i++ ){
    echo "$data[$i]<br/>\n";
  }

*/

  $data = file($filename);
  $cnt = count($data);
  
  for( $i=0; $i<$cnt; $i++ ){
  $data2 = explode("<>",$data[$i]);
    echo "$data2[0]<br/>\n";
    echo "$data2[1]<br/>\n";
    echo "$data2[2]<br/>\n";
    echo "$data2[4]<br/>\n";
  }
?>
