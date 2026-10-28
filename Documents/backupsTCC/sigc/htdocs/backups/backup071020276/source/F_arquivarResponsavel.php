<?php
session_start();
$id = intval($_GET['idResp']);
include "../controller/conecta.php";
$sql = "UPDATE responsavel SET arquivado = 1 WHERE id='$id'";
$resultado = mysqli_query($conn, $sql);
//header("Location: ../pages/listarResponsaveis.php");
if (mysqli_affected_rows($conn) > 0) {
   echo "<script>alert('Responsável arquivado com sucesso!'); window.location.href = ' ../pages/listarResponsaveis.php';</script>";
} else {
     echo "<script>alert('Não possível concluir a ação. Isso pode ter ocorrido por algum problema interno, problema de conexão externo ou algum motivo válido, como exemplo, tentativa de cadastro duplicado. 
     Tente novamente. Se persistir, recarregue a página.'); window.location.href = '../pages/listarAlunos.php';</script>";
}