<form action = "mission_1-5.php" method = "get">
<p>

<input type="text" name="comment">
</p>

<input type="submit" value="���M">

</form>

<?php

//kadai5���܂�����āA�ϐ�$comment�̒��g�ɓ��̓t�H�[���̒��g��ݒ�
$filename = 'kadai5.txt';
$comment = ($_GET['comment']);

//�ϐ��̒��g��comment�ɂȂ��Ă��邱�Ƃ��m�F���邽�߂̃f�o�b�O�pecho
echo ($comment);

//if�ɂ��comment���ɏ������݂������kadai5�̒��ɏ������܂��
if ($comment){

$fp = fopen($filename, 'w');

//�e�L�X�g����comment���������ޕ����A���ڕϐ���p����ۂɂ�""��''�͗p���Ȃ�(�H)�v�m�F
fwrite($fp, $comment);

fclose($fp);

}

?>