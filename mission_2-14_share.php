<?php

  $pdo = new PDO("�f�[�^�x�[�X��",'���[�U�[��','�p�X���[�h');

$delete_id = "2";

  $stmt = $pdo -> prepare("DELETE FROM test WHERE id =:id");

  $stmt -> bindValue(':id',$delete_id,PDO::PARAM_INT);

  $stmt -> execute();