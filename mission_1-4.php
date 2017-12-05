<?php
//textをcommentという名前にして変数($)にcommentを指定、echoで打ち出す
$comment = ($_GET['comment']);

echo ($comment);

?>
<form action = "mission_1-4.php" method = "get">
<p>
<input type="text" name ="comment"> 
</p>
<input type="submit" value="test">
</form>