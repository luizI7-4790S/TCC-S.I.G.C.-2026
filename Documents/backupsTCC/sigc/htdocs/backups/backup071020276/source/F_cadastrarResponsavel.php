<?php
include "../controller/conecta.php";
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$alunoSubordinado = $_POST['alunoSubordinado'];

$sql = "INSERT INTO responsavel (nome, telefone, id_aluno) VALUES ('$nome', '$telefone', '$alunoSubordinado')";
$resultados = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) > 0) {
   echo "<script>alert('Responsável registrado com sucesso!'); window.location.href='../pages/listarResponsaveis.php';</script>";
} else {
    echo "<script>alert('Houve um erro...'); window.location.href='../pages/listarResponsaveis.php';</script>";
}
