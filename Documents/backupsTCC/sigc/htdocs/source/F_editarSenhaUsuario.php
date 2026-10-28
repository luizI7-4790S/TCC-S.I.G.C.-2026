<?php
include '../controller/conecta.php';

$idUsuario = $_GET['idUsuario'];
$novaSenha = $_GET['novaSenha'];

$senhaSegura = mysqli_real_escape_string($conn, $novaSenha);
$senhaHash = password_hash($senhaSegura, PASSWORD_DEFAULT);

$sql = "UPDATE administrador SET senha = '$senhaHash' WHERE id = '$idUsuario'";
$resultado = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Senha alterada com sucesso!');</script>";
    echo '<script>window.location.href="../pages/listarUsuarios.php";</script>';
} else {
    echo "<script>alert('Houve um problema interno... Tente novamente...');</script>";
    echo '<script>window.location.href="../pages/listarUsuarios.php;"</script>';
}
/*
echo '<a href="../pages/listarUsuarios.php">voltar</a><br>';
echo 'id ' . $idUsuario . "<br>";
echo 'senha ' . $novaSenha;
// header("Location: ../pages/listarUsuarios.php");
?>
*/