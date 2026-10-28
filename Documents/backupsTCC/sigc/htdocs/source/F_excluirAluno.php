<?php
session_start();
$id = intval($_GET['idAluno']);
include "../controller/conecta.php";
$sql = "DELETE FROM aluno WHERE id='$id'";
$resultado = mysqli_query($conn, $sql);
if ($resultado && mysqli_affected_rows($conn) > 0) {
   echo "<script>alert('Aluno excluído com sucesso!'); window.location.href='../pages/listarAlunos.php';</script>";
} else {
    echo "<script>alert('Houve um erro...'); window.location.href='../pages/listarAlunos.php';</script>";
}