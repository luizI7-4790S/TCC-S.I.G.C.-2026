<?php

include "conecta.php";
$idUsuario = $_GET['idUsuario'];
$sql = "DELETE FROM administrador WHERE id = $idUsuario";
$result = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Usuário excluído com sucesso!'); window.location.href = 'cadastrarUsuario.php';</script>";
} else {
    echo "<script>alert('Erro ao excluir usuário.'); window.location.href = 'cadastrarUsuario.php';</script>";
}