<?php
    include "../controller/conecta.php";
    session_start();
    $id = $_SESSION['id'];
    $tema = $_POST['tema'];
    $sql = "UPDATE administrador SET tema = '$tema' WHERE id = '$id'";
    $resultado = mysqli_query($conn, $sql);
    header('Location: ../pages/configuracoesUser.php');