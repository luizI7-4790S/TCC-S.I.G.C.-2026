<?php

$msgEmailIncorreto = false;
$msgSenhaIncorreta = false;

if (isset($_GET['emailIncorreto'])) {
    $emailIncorreto = $_GET['emailIncorreto'];

    if ($emailIncorreto == 1) {
        $msgEmailIncorreto = true;
    } else {
        $msgEmailIncorreto = false;
    }
}

if (isset($_GET['senhaIncorreta'])) {
    $senhaIncorreta = $_GET['senhaIncorreta'];

    if ($senhaIncorreta == 1) {
        $msgSenhaIncorreta = true;
    } else {
        $msgSenhaIncorreta = false;
    }
}

if ($_POST) {
    include "../controller/conecta.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM administrador WHERE usuario = '$email'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $dados = mysqli_fetch_assoc($res);
    } else {
        header("Location:login.php?emailIncorreto=1");
        exit;
    }

    if (password_verify($senha, $dados['senha'])) {
        session_start();

        $_SESSION['id'] = $dados['id'];

        header("Location: inicio.php");
        exit;
    } else {
        header("Location:login.php?senhaIncorreta=1");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Boas-vindas!</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="icon" href="../images/logoCoter.png?v=3" type="image/x-icon">

    <link rel="stylesheet" href="../styles/styleLogin.css">

    <style>
        /* Pequeno ajuste para celulares */
        @media (max-width: 600px) {

            body {
                padding-bottom: 25px;
            }

            footer {
                margin-bottom: -15px;
            }

        }
    </style>

</head>

<body>

    <form action="" method="POST">

        <div class="login-container">

            <div class="left-side">

                <div class="login-form">
                    
                    <h2>Bem-vindo(a)!</h2>

                    <input
                        type="text"
                        name="email"
                        placeholder="Usuário"
                        required
                    >

                    <?php

                    if ($msgEmailIncorreto == TRUE) {

                        echo '
                        <p style="
                            color: red;
                            border: 1px solid red;
                            border-radius: 5px;
                            padding: 1%;
                        ">
                            E-mail ou Usuário incorreto!
                        </p>';

                    }

                    ?>

                    <input
                        type="password"
                        name="senha"
                        placeholder="Senha"
                        required
                    >

                    <?php

                    if ($msgSenhaIncorreta == TRUE) {

                        echo '
                        <p style="
                            color: red;
                            border: 1px solid red;
                            border-radius: 5px;
                            padding: 1%;
                        ">
                            Senha incorreta!
                        </p>';

                    }

                    ?>

                    <button type="submit">
                        Entrar
                    </button>

                </div>

            </div>

            <div class="right-side">

                <div class="logo-container">

                    <img
                        class="logoCoter"
                        src="../images/logoCoter.png"
                    >

                </div>

            </div>

        </div>

    </form>


    <!-- FOOTER -->

    <footer style="
        width: 100%;
        box-sizing: border-box;
        padding: 18px 20px 20px;
        margin-top: 18px;
        text-align: center;
        color: #7d8992;
        font-size: 11px;
        line-height: 1.7;
        border-top: 1px solid rgba(255,255,255,0.08);
    ">
        <div style="
            font-weight: 600;
            color: #9ba6ae;
            margin-bottom: 2px;
        ">
            Centro Operacional de Treinamento de Esportes Radicais
        </div>

        <div>
            Uruguaiana - RS | 2026 - <?php echo date('Y'); ?>
        </div>

        <div style="
            margin-top: 3px;
            opacity: 0.75;
        ">
            Desenvolvido por Luiz Felipe Leges
        </div>
    </footer>

</body>

</html>