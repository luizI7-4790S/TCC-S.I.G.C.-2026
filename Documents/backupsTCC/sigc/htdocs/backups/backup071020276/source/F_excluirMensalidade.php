<?php
session_start();
$id = intval($_GET['idMensalidade']);
include "../controller/conecta.php";
$sql = "DELETE FROM mensalidade WHERE id='$id'";
$resultado = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Mensalidade excluída com sucesso!'); window.location.href = 'listarMensalidades.php';</script>";
} else {
    echo "<script>alert('Houve um erro...'); window.location.href = 'listarMensalidades.php';</script>";
}
