<?php
include "../controller/conecta.php";
$id = $_GET['id'];
$oQueE = $_GET['tipo'];
$sql = 1; //atribui qualquer coisa pois, na função mysqli_query, tava sublinhada em amarelo
if ($oQueE == "responsavel") {
    $sql = "UPDATE responsavel SET arquivado = 0 WHERE id = '$id'";
} else if ($oQueE == "aluno") {
    $sql = "UPDATE aluno SET arquivado = 0 WHERE id = '$id'";
} else if ($oQueE == "mensalidade") {
    $sql = "UPDATE mensalidade SET arquivado = 0 WHERE id = '$id'";
}
$resultado = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Restaurado com sucesso!'); window.location.href = '../pages/lixeira.php';</script>";
} else {
    echo "<script>alert('Houve um erro...'); window.location.href = '../pages/lixeira.php';</script>";
}

