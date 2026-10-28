<?php
session_start();
$id = intval($_GET['idAluno']);
include "conecta.php";
$sql = "DELETE FROM aluno WHERE id='$id'";
$resultado = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Aluno excluído com sucesso!'); window.location.href = 'listarAlunos.php';</script>";
} else {
    echo "<script>alert('Erro ao excluir aluno.'); window.location.href = 'listarAlunos.php';</script>";
}