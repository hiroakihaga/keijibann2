<?php

  $tempfile = $_FILES['fname']['tmp_name'];
  $filename = './'.$_FILES['fname']['name'];
  
  if(is_uploaded_file($tempfile)){
  
    if(move_uploaded_file($tempfile,$filename)){
        echo $filename."をアップロードしました";
        echo "<img src=$filename>";
    }else{
        echo "ファイルをアップロードできません";
    }
  }else{
    echo "ファイルが選択されていません";
  }

?>


<!DOCTYPE html>
<html lang = "ja">
<head>
 <meta charset = "UTF-8">
 <title>test</title><br/>
</head>

<body>

<!--見出しはh1で作る-->
  <h1>test</h1>
  
    <form action = "test_display.php" method = "post" enctype = "multipart/form-data">
    
    <input type = "file" name = "fname">
    
    <input type = "submit" name = "upload" value = "送信">
    
</form>

</body>

</html>

//<?php

  // echo "<img src='$getfile'>";
   
//?>