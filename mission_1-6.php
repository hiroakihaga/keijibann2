<form action = "mission_1-6.php" method = "get">
<p>

<input type="text" name="comment">
</p>

<input type="submit" value="���M">

</form>

<?php

//kadai6���܂�����āA�ϐ�$comment�̒��g�ɓ��̓t�H�[���̒��g��ݒ�
$filename = 'kadai6.txt';
$comment = ($_GET['comment']);

//�ϐ��̒��g��comment�ɂȂ��Ă��邱�Ƃ��m�F���邽�߂̃f�o�b�O�pecho
echo ($comment);

//if(){}�ɂ��comment���ɏ������݂������kadai6�̒��ɏ������܂��
if ($comment){

//'w'�͏������݃��[�h(���g��������������)�A'a'�͒ǋL���[�h(�t�@�C���̓��e�ɒǋL���o����)
$fp = fopen($filename, 'a');

/*�e�L�X�g����comment���������ޕ����A�����ł͒��ڕϐ���p����ۂɂ�""��''�͗p���Ȃ�
�X��fwrite�֐������s����ۂ� "\n" ������(�_�u���N�H�[�e�[�V�����ŁI)*/
fwrite($fp, $comment."\n");

fclose($fp);

}

?>