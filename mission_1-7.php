<h1>�D���ȃA�j��</h1>
<form action = "mission_1-7.php" method = "get">
<p>

<input type="text" name="comment">
</p>

<input type="submit" value="���M">

</form>

<?php

//kadai7���܂������(kadai7�̃e�L�X�g�t�@�C����ϐ��Ɋi�[)�A�ϐ�$comment�̒��g�ɓ��̓t�H�[���̒��g��ݒ�
$filename = 'kadai7.txt';
$comment = ($_GET['comment']);

//�ϐ��̒��g��comment�ɂȂ��Ă��邱�Ƃ��m�F���邽�߂̃f�o�b�O�pecho
//echo ($comment);

//if(){}�ɂ��comment���ɏ������݂������kadai7�̒��ɏ������܂��
if ($comment){

//'w'�͏������݃��[�h(���g��������������)�A'a'�͒ǋL���[�h(�t�@�C���̓��e�ɒǋL���o����)
$fp = fopen($filename, 'a');

/*�e�L�X�g����comment���������ޕ����A�����ł͒��ڕϐ���p����ۂɂ�""��''�͗p���Ȃ�
�X��fwrite�֐������s����ۂ� "\n" ������(�_�u���N�H�[�e�[�V�����ŁI)*/
fwrite($fp, $comment."\n");

fclose($fp);

}

?>

<?php

//�t�@�C����z��Ɋi�[���A����ɕϐ��Ɋi�[

//file() �Ńt�@�C���S�̂�ǂݍ���ŁA�z��Ɋi�[�����̔z���$line�Ƃ����ϐ���^����
$lines = file($filename, FILE_SKIP_EMPTY_LINES);

/* foreach(�z��ϐ� as �ϐ�){
   �J��Ԃ���������
   } 
   �͔z��̒��g(�v�f)���Ō�ɗv�f�܂ŏ���ɌJ��Ԃ��Ă����B*/

foreach ($lines as $line){

//�����echo���J��Ԃ��B�ϐ�$line������<br>�ŕ\�����ɋ�؂�B\n�ŉ��s���Ă���
//echo�̌J��Ԃ������Ă��炤�B
echo "$line<br/>\n";
}

?>