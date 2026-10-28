<?php
include "../controller/conecta.php";
$nome = $_POST['nome'] ?? "semNome";
$nome_guerra = $_POST['nome_guerra'] ?? "semNomeGuerra";
$numero = $_POST['numero'] ?? 99;
$graduacao = $_POST['graduacao'] ?? "Soldado";
$id_pelotao = $_POST['id_pelotao'] ?? 1;
$estagiando = $_POST['estagiando'] ?? 0;
$monitor = $_POST['monitor'] ?? 0;

$sql = "INSERT INTO aluno (nome, nome_guerra, numero, graduacao, id_pelotao, estagiando, monitor) VALUES ('$nome', '$nome_guerra', $numero, '$graduacao', '$id_pelotao', '$estagiando', '$monitor')";
$resultado = mysqli_query($conn, $sql);
if ($resultado AND mysqli_affected_rows($conn) > 0) {
   echo "<script>alert('Aluno registrado com sucesso!'); window.location.href='../pages/listarAlunos.php';</script>";
} else {
   echo "<script>alert('Houve um erro...'); window.location.href='../pages/listarAlunos.php';</script>";
}
