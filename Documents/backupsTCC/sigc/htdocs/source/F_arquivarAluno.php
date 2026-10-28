<?php
session_start();
$id = intval($_GET['idAluno']);
include "../controller/conecta.php";
$sql = "UPDATE aluno SET arquivado = 1 WHERE id='$id'";
$resultado = mysqli_query($conn, $sql);
//header("Location:listarAlunos.php");
 if (mysqli_affected_rows($conn) > 0) {
     echo "<script>alert('Aluno arquivado com sucesso!'); window.location.href = '../pages/listarAlunos.php';</script>";
 } else {
     echo "<script>alert('Houve um erro...'); window.location.href = '../pages/listarAlunos.php';</script>";
 }