<?php
include "../controller/conecta.php";
$idAlunos =  $_POST['alunos'];
$numAlunos = count($idAlunos);

for($i = 0; $i < $numAlunos; $i++) {
    $id = $idAlunos[$i];
    $sql = "UPDATE aluno SET estagiando = 1 WHERE id=$id AND id_pelotao = 1";
    $resultado = mysqli_query($conn, $sql);
}
header("Location: ../pages/listarEstagiario.php");
