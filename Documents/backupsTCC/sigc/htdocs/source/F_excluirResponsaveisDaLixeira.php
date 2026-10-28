<?php
session_start();
include "../controller/conecta.php";
$sql = "DELETE FROM responsavel WHERE arquivado = 1";
$resultado = mysqli_query($conn, $sql);
header("Location: ../pages/lixeira.php");