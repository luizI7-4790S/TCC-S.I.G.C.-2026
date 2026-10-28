<?php
include "../controller/conecta.php";
$idMen = $_GET['idMensalidade'];
$sql = "UPDATE mensalidade SET arquivado = 1 WHERE id = '$idMen'";
$resutado = mysqli_query($conn, $sql);
 if (mysqli_affected_rows($conn) > 0) {
     echo "<script>alert('Mensalidade arquivada com sucesso!'); window.location.href = '../pages/listarMensalidades.php';</script>";
 } else {
     echo "<script>alert('Não possível concluir a ação. Isso pode ter ocorrido por algum problema interno, problema de conexão externo ou algum motivo válido, como exemplo, tentativa de cadastro duplicado. 
     Tente novamente. Se persistir, recarregue a página.'); window.location.href = '../pages/listarMensalidades.php';</script>";
 }