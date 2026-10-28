<?php
session_start();
$id = intval($_GET['idResp']);
include "conecta.php";
$sql = "DELETE FROM responsavel WHERE id='$id'";
$resultado = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Usuário excluído com sucesso!'); window.location.href = 'listaResponsaveis.php';</script>";
} else {
    echo "<script>alert('Erro ao excluir usuário.'); window.location.href = 'listaResponsaveis.php';</script>";
}