<?php
if (isset($_GET['sessaoExpirada'])) { //se o index lá retornar sessaoExpirada=1, deixa como true pra mostrar erro na tela de login,
    $mensagemSessao = $_GET['sessaoExpirada'];
    if ($mensagemSessao == 1) {
        $mostrarMsgSessao = true;
    } else {
        $mostrarMsgSessao = false;
    }
} else {
    $mostrarMsgSessao = false;
}




if (isset($_GET['mensagemErroId'])) { //aqui é pro caso raro do index ser acessado mas não receber o ID do admin, aí buga tudo e joga pro login.php
    $mensagemErroId = $_GET['mensagemErroId'];
    if ($mensagemErroId == 1) {
        $mostrarMsgErroId = true;
    } else {
        $mostrarMsgErroId = false;
    }
} else {
    $mostrarMsgErroId = false;
}





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
    include "conecta.php";
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM administrador WHERE usuario = '$email'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) { //tenta conectar. Se der erro, o email tá errado
        $dados = mysqli_fetch_assoc($res);
    } else {
        header("Location:login.php?emailIncorreto=1"); //meio estranho, mas vai recarregar a página e mostrar mensagem de erro
        exit;
    }

    if (password_verify($senha, $dados['senha'])) {
        session_start(); //se a senha for correta, aí já cria a sessão pra não ficar logando toda vez enquanto não fechar o navegador
        //antes era feito com cookies
        $_SESSION['id'] = $dados['id']; // já manda o id pela sessão mesmo
        header("Location:index.php");
        exit;
    } else {
        //denovo, se a senha for incorreta, recarrega a página e já mostra mensagem de erro
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
    <link rel="stylesheet" href="styleLogin.css">
</head>

<body>
    <form action="" method="POST">
        <div class="login-container">
            <div class="left-side">
                <div class="login-form">
                    <h2>Bem-vindo(a)!</h2>
                    <input type="text" name="email" placeholder="Usuário" required>
                    <?php
                    if ($msgEmailIncorreto == TRUE) {
                        echo '<p style="color: red; border: 1px solid red; border-radius: 5px; padding: 1%;">
                            E-mail ou Usuário incorreto!
                            </p>';
                    }
                    ?>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <?php
                    if ($msgSenhaIncorreta == TRUE) {
                        echo '<p style="color: red; border: 1px solid red; border-radius: 5px; padding: 1%;">
                            Senha incorreta!
                            </p>';
                    }
                    ?>
                    <button type="submit">Entrar</button>
                </div>
            </div>
            <div class="right-side">
                <div class="logo-container">
                    <img class="logoCoter" src="logoCoter.png">
                </div>
            </div>
        </div>
</body>
</form>

</html>