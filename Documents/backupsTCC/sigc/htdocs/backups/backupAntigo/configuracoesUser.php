<?php
include "conecta.php";
session_start();// descobri depois de um tempo que precisa chamar session_start() em todos arquivos
//de cara já verifica se tem sessão existente
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sqlAdmin = "SELECT * FROM administrador WHERE id= '$id'";
    $resAdmin = mysqli_query($conn, $sqlAdmin);
    $dadosAdmin = mysqli_fetch_assoc($resAdmin);
    $_SESSION["tema"] = $dadosAdmin["tema"];
} else {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    <?php
    if($_SESSION['tema'] == 'verdeEscuro') { //VERDE ESCURO
        echo '<link rel="stylesheet" href="styleVerdeEscuro.css">';
    } else if ($_SESSION['tema'] == 'verdeClaro') { // VERDE CLARO
        echo '<link rel="stylesheet" href="styleVerdeClaro.css">';
    } else if ($_SESSION['tema'] == 'azulEscuro') { // AZUL ESCURO
        echo '<link rel="stylesheet" href="styleAzulEscuro.css">';
    } else if ($_SESSION['tema'] == 'azulClaro') { // AZUL CLARO
        echo '<link rel="stylesheet" href="styleAzulClaro.css">';
    } else if ($_SESSION['tema'] == 'rosaEscuro') { // ROSA ESCURO
        echo '<link rel="stylesheet" href="styleRosaEscuro.css">';
    } else if ($_SESSION['tema'] == 'rosaClaro') { // ROSA CLARO
        echo '<link rel="stylesheet" href="styleRosaClaro.css">';
    } else if ($_SESSION['tema'] == 'vermelhoEscuro') { // VERMELHO ESCURO
        echo '<link rel="stylesheet" href="styleVermelhoEscuro.css">';
    } else if ($_SESSION['tema'] == 'vermelhoClaro') { // VERMELHO CLARO
        echo '<link rel="stylesheet" href="styleVermelhoClaro.css">';
    } else if ($_SESSION['tema'] == 'amareloEscuro') { // AMARELO ESCURO
        echo '<link rel="stylesheet" href="styleAmareloEscuro.css">';
    } else if ($_SESSION['tema'] == 'amareloClaro') {// AMARELO CLARO
        echo '<link rel="stylesheet" href="styleAmareloClaro.css">';
    } else {// PADRÃO
        echo '<link rel="stylesheet" href="styleVerdeClaro.css">';
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href=".png">
</head>

<body>

    <header>
        <h1>S.I.G.C[...]</h1>
    </header>

    <ul class="sidenav">
        <li><a href="index.php"><i class="fa-solid fa-house"></i> Início</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Pessoas</span></div>
        <li><a href="listarAlunos.php"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a href="listarResponsaveis.php"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
        <li><a href="listarEstagiario.php"><i class="fa-solid fa-user"></i> Estagiários</a></li>
        <li><a href="cadastrarUsuario.php"><i class="fa-solid fa-user-shield"></i> Usuários</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Valores</span></div>
        <li><a href="listarMensalidades.php"><i class="fa-solid fa-piggy-bank"></i> Mensalidades</a></li>
        <li><a href="arrecadacao.php"><i class="fa-solid fa-hand-holding-dollar"></i> Arrecadação</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Gestão</span></div>
        <li><a href="relatorios.php"><i class="fa-regular fa-clipboard"></i> Relatórios</a></li>
        <li><a href="listarAnotacoes.php"><i class="fa-solid fa-note-sticky"></i> Anotações</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Configurações</span></div>
        <li><a class="active" href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <li><a href="pageAjuda.php"><i class="fa-solid fa-book-open"></i> Manual do Sistema</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>

    <div class="main-wrapper">
        <div class="card">
            <div class="card-header"> Configurações </div>

            <div class="card-body">
                <div class="bloco-nota">
                    <h3>Nota:</h3>
                    <p>Essas configurações são alteradas apenas para você. Outro usuário não verá suas escolhas.</p>
                </div>
                <hr>    
                <form action="salvarConfiguracoes.php" method="POST">
                <label>
                    <p>Tema: <i class="fa-solid fa-sun" style="color: rgb(223, 208, 1);"></i> / <i class="fa-solid fa-moon" style="color: rgb(91, 175, 201);"></i></p>
                    <select name="tema">
                        <option value="verdeClaro">Cor: VERDE / Tema: CLARO </option>                        
                        <option value="verdeEscuro">Cor: VERDE / Tema: ESCURO</option>                        
                        <option value="azulClaro">Cor: AZUL / Tema: CLARO</option>                        
                        <option value="azulEscuro">Cor: AZUL / Tema: ESCURO</option>                        
                        <option value="rosaClaro">Cor: ROSA / Tema: CLARO</option>                        
                        <option value="rosaEscuro">Cor: ROSA / Tema: ESCURO</option>
                    </select>
                    <br><br>
                    <input type="submit" value="Salvar" class="btn-salvar">
                </label>
                </form>
            </div>
        </div>
    </div>
</body>
</html>