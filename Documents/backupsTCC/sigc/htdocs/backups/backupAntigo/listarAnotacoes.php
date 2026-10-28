<?php
include "conecta.php";
session_start(); // descobri depois de um tempo que precisa chamar session_start() em todos arquivos
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
    <title>SIGC - Dashboard</title>
    <?php
    if ($_SESSION['tema'] == 'verdeEscuro') { //VERDE ESCURO
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
    } else { // PADRÃO
        echo '<link rel="stylesheet" href="styleVerdeClaro.css">';
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <li><a class="active" href="listarAnotacoes.php"><i class="fa-solid fa-note-sticky"></i> Anotações</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Configurações</span></div>
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <li><a href="pageAjuda.php"><i class="fa-solid fa-book-open"></i> Manual do Sistema</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>

    <div class="main-wrapper">
        <div class="card">
            <div class="card-header">Pesquisa</div>
            <div class="card-body">
                <form method="POST" action="">
                    <p><select name="pesquisa">
                        <option value="">Selecione o autor</option>
                        <?php
                        $sqlAutores = "SELECT DISTINCT autor FROM anotacao ORDER BY autor";
                        $resultadoAutores = mysqli_query($conn, $sqlAutores);
                        while ($autor = mysqli_fetch_assoc($resultadoAutores)) {
                            echo "<option value='{$autor['autor']}'>{$autor['autor']}</option>";//ai
                        }
                        ?>
                    </select></p>
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                    <?php
                    if ($_POST) {
                        if (isset($_POST['pesquisa'])) {
                            $pesquisa = $_POST['pesquisa'];
                            $sqlLista = "SELECT * FROM anotacao WHERE autor LIKE '%$pesquisa%' ORDER BY data_criacao";
                        } else {
                            $sqlLista = "SELECT * FROM anotacao ORDER BY data_criacao";
                            $pesquisa = "";
                        }
                        $resultado = mysqli_query($conn, $sqlLista);

                        if (mysqli_num_rows($resultado) > 0) {
                            $numResultados = 0;
                            if ($pesquisa != "") {
                                while ($resPesquisa = mysqli_fetch_assoc($resultado)) {
                                    $numResultados++;
                                    ?>

                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
        <hr>


        <?php
        $sqlAnotacoes = "SELECT * FROM anotacao ORDER BY data_criacao DESC";
        $resultadoAnotacoes = mysqli_query($conn, $sqlAnotacoes);
        while ($dados = mysqli_fetch_assoc($resultadoAnotacoes)) { ?>

            <div class="card">
                <div class="card-header"><?php echo $dados['titulo']; ?></div>
                <div class="card-header"><?php echo $dados['autor']; ?></div>
                <div class="card-header"><?php echo $dados['data_criacao']; ?></div>
                <div class="card-body" style="text-align: center;">
                    <p><?php echo $dados['texto']; ?></p>
                </div>
                <div class="card-header">
                    <button disabled onclick="location.href=''">Editar Anotação</button>
                    <button disabled onclick="location.href=''">Excluir Anotação</button>
                </div>
            </div>
            <hr>
        <?php } ?>



    <!-- </div> -->

</body>

</html>