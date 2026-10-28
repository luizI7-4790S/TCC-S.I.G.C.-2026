<?php
$valor = $_POST["valorPadraoMensalidade"];
include "../controller/conecta.php";
$sql = "UPDATE definicoes SET valorPadraoMensalidade = '$valor'";
$result = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Valor definido com sucesso!'); window.location.href = '../pages/configuracoesUser.php';</script>";
    die();
}
$sql2Tentativa = "INSERT INTO definicoes (valorPadraoMensalidade) VALUES ('$valor')"; //se não existir um registro prévio, ele tenta denovo:
$result2Tentantiva = mysqli_query($conn, $sql2Tentativa);
if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Valor definido com sucesso!'); window.location.href = '../pages/configuracoesUser.php';</script>";
    die();
} else {
    echo "<script>alert('Houve um erro...'); window.location.href = '../pages/configuracoesUser.php';</script>";
}

//tlk esse eu fiz 101%
//saiu um padrão funcionando de primeira