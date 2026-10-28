<?php
session_start();
$id = $_SESSION['id'];
include "conecta.php";

$sqlLista = "SELECT * FROM aluno WHERE estagiando = 1 ORDER BY nome";
$resultadoLista = mysqli_query($conn, $sqlLista);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar estagiários</title>
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
        <nav>

        </nav>
    </header>
    <ul class="sidenav">
        <li><a href="index.php"><i class="fa-solid fa-house"></i> Início</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Pessoas</span></div>
        <li><a href="listarAlunos.php"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a href="listarResponsaveis.php"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
        <li><a class="active" href="listarEstagiario.php"><i class="fa-solid fa-user"></i> Estagiários</a></li>
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
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <li><a href="pageAjuda.php"><i class="fa-solid fa-book-open"></i> Manual do Sistema</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>

    <div class="main-wrapper">
        <div class="content">

            <div class="card">
                <div class="card-header">Pesquisa</div>
                <div class="card-body">
                    <form method="POST" action="">
                        <p><input type="text" name="pesquisa" placeholder="Digite o nome do aluno em estágio"></p>
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        <?php
                        if ($_POST) {
                            if (isset($_POST['pesquisa'])) {
                                $pesquisa = $_POST['pesquisa'];
                                $sqlLista = "SELECT * FROM aluno WHERE nome LIKE '%$pesquisa%' AND estagiando = 1 ORDER BY nome";
                            } else {
                                $sqlLista = "SELECT * FROM aluno WHERE estagiando = 1 ORDER BY nome";
                                $pesquisa = "";
                            }
                            $resultado = mysqli_query($conn, $sqlLista);

                            if (mysqli_num_rows($resultado) > 0) {
                                $numResultados = 0;
                                if ($pesquisa != "") {
                                    echo '<h3>Resultados encontrados para: <span>"' . $pesquisa . '"</span></h3>';
                                    echo '<table border="1">
                                            <tr>
                                                <th>Nome Completo</th>
                                                <th>Nome de guerra</th>
                                                <th>Número de guerra</th>
                                                <th>Estagiando</th>
                                                <th>Monitor</th>
                                                <th>Graduação</th>
                                                <th>Pelotão</th>
                                                <th>Ações</th>
                                            </tr>';
                                    while ($resPesquisa = mysqli_fetch_assoc($resultado)) {
                                        $numResultados++;
                                        ?>
                                        <tr>
                                            <td>
                                                <?php $msgNum = ($resPesquisa['nome']) ? $resPesquisa['nome'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>
                                            <td>
                                                <?php $msgNum = ($resPesquisa['nome_guerra']) ? $resPesquisa['nome_guerra'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>
                                            <td>
                                                <?php $msgNum = ($resPesquisa['numero']) ? $resPesquisa['numero'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($resPesquisa['estagiando'] == 1) {
                                                    echo '<span style="color:green; text-decoration: bold;">Sim</span>';
                                                } else {
                                                    echo '<span style="color:red;">Não</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($resPesquisa['monitor'] == 1) {
                                                    echo '<span style="color:green;">Sim</span>';
                                                } else {
                                                    echo '<span style="color:red;">Não</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php $msgNum = ($resPesquisa['graduacao']) ? $resPesquisa['graduacao'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($resPesquisa['id_pelotao'] == 1) {
                                                    echo 'Águia';
                                                } else if ($resPesquisa['id_pelotao'] == 2) {
                                                    echo 'Falcão';
                                                } else if ($resPesquisa['id_pelotao'] == 3) {
                                                    echo 'Tigre';
                                                } else if ($resPesquisa['id_pelotao'] == 4) {
                                                    echo 'Leão';
                                                } else if ($resPesquisa['id_pelotao'] == 5) {
                                                    echo 'Cobra';
                                                } else {
                                                    echo '<span style="color:red;">Não informado</span>';
                                                }
                                                ?>
                                            </td>

                                            <td class="acoes">
                                                <a class="botaoTable"
                                                    href="editarResponsavel.php?id_resp=<?php echo $resPesquisa['id']; ?>">
                                                    <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a class="botaoTable"
                                                    href="msgExcluirResp.php?nome=<?php echo urlencode($resPesquisa['nome']); ?>&id=<?php echo $resPesquisa['id']; ?>">
                                                    <button class="botaoTable_excluir"> Excluir <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    echo '</table>';
                                    echo '<p><strong>Total de resultados encontrados: ' . $numResultados . '</strong></p>';
                                }
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>


            <hr>



            <?php if (mysqli_num_rows($resultadoLista) > 0) { ?>
                <div class="card">
                    <div class="card-header">LISTA DE ESTAGIÁRIOS</div>
                    <div class="card-header"><label><a href="cadastrarAluno.php"><button> <i
                                        class="fa-solid fa-user-tie"></i> Cadastrar um novo Aluno</button></a></label></div>
                    <div class="card-body">
                        <table border="1">
                            <tr>
                                <th>Nome Completo</th>
                                <th>Nome de guerra</th>
                                <th>Número de guerra</th>
                                <th>Estagiando</th>
                                <th>Monitor</th>
                                <th>Graduação</th>
                                <th>Pelotão</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            $numLinhasImpressas = 0;
                            while ($resPesquisa = mysqli_fetch_assoc($resultadoLista)) {
                                $numLinhasImpressas++;
                                ?>
                                <tr>
                                    <td>
                                        <?php $msgNum = ($resPesquisa['nome']) ? $resPesquisa['nome'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>
                                    <td>
                                        <?php $msgNum = ($resPesquisa['nome_guerra']) ? $resPesquisa['nome_guerra'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>
                                    <td>
                                        <?php $msgNum = ($resPesquisa['numero']) ? $resPesquisa['numero'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($resPesquisa['estagiando'] == 1) {
                                            echo '<span style="color:green; text-decoration: bold;">Sim</span>';
                                        } else {
                                            echo '<span style="color:red;">Não</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($resPesquisa['monitor'] == 1) {
                                            echo '<span style="color:green;">Sim</span>';
                                        } else {
                                            echo '<span style="color:red;">Não</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php $msgNum = ($resPesquisa['graduacao']) ? $resPesquisa['graduacao'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($resPesquisa['id_pelotao'] == 1) {
                                            echo 'Águia';
                                        } else if ($resPesquisa['id_pelotao'] == 2) {
                                            echo 'Falcão';
                                        } else if ($resPesquisa['id_pelotao'] == 3) {
                                            echo 'Tigre';
                                        } else if ($resPesquisa['id_pelotao'] == 4) {
                                            echo 'Leão';
                                        } else if ($resPesquisa['id_pelotao'] == 5) {
                                            echo 'Cobra';
                                        } else {
                                            echo '<span style="color:red;">Não informado</span>';
                                        }
                                        ?>
                                    </td>

                                    <td class="acoes">
                                        <a class="botaoTable"
                                            href="editarAluno.php?id_aluno=<?php echo $resPesquisa['id']; ?>">
                                            <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
            } else { ?>
                            <div class="card">
                                <div class="card-header">Opa!</div>
                                <div class="card-body">
                                    <h2 class="h2Dialog">Nenhum cadastro encontrado! <i
                                            class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146);"></i>
                                    </h2>
                                    <h4 class="pDialog">Parece que não há ninguém em estágio!</h4>
                                    <h4 class="pDialog">Vá para a página de alunos e edite o cadastro de um aluno para que ele apareça na lista de estagiários.</h4>
                                    <h4 class="pDialog">Depois, volte aqui e o(s) aluno(s) estagiário(s) aparecerá(ão) na lista.</h4>
                                    <div class="botoesDialog">
                                        <a href="listarAlunos.php"><button class="botaoDialog">Ver alunos</button></a>
                                        <a href="index.php"><button class="botaoDialog">Voltar para a página inicial</button></a>
                                    </div>
                                <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>