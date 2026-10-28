<?php
session_start();
$id = intval($_GET['idResp']);
include "../controller/conecta.php";
$sql = "DELETE FROM responsavel WHERE id='$id'";
$resultado = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Responsável excluído com sucesso!'); window.location.href = 'listarResponsaveis.php';</script>";
} else {
    echo "<script>alert('Houve um erro...'); window.location.href = 'listarResponsaveis.php';</script>";
}