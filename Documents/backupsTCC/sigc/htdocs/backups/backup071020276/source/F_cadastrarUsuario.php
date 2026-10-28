<?php
$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$senha = password_hash($senha, PASSWORD_DEFAULT);
include "../controller/conecta.php";
$sql = "INSERT INTO administrador (usuario, senha, nome) VALUES ('$email', '$senha', '$nome')";
mysqli_query($conn, $sql);
if ($resultado && mysqli_affected_rows($conn) > 0) {
   echo "<script>alert('Usuário registrado com sucesso!'); window.location.href='../pages/listarUsuarios.php';</script>";
} else {
    echo "<script>alert('Houve um erro...'); window.location.href='../pages/listarUsuarios.php';</script>";
}
