<?php
session_start();
$id = $_SESSION['id'];
include "conecta.php";

$sqlLista = "SELECT * FROM aluno ORDER BY nome";
$resultadoLista = mysqli_query($conn, $sqlLista);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar alunos</title>
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
        <li><a class="active" href="listarAlunos.php"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
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
                        <p><input type="text" name="pesquisa" placeholder="Digite o nome do aluno"></p>
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        </form>
                        <?php
                        if ($_POST) {
                            if (isset($_POST['pesquisa'])) {
                                $pesquisa = $_POST['pesquisa'];
                                $sql = "SELECT * FROM aluno WHERE nome LIKE '%$pesquisa%' ORDER BY nome";
                            } else {
                                $sql = "SELECT * FROM aluno ORDER BY nome";
                                $pesquisa = "";
                            }
                            $resultado = mysqli_query($conn, $sql);

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
                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        $numResultados++;
                        ?>
                                        <tr>
                                            <td>
                                                <?php $msgNum = ($dados['nome']) ? $dados['nome'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>
                                            <td>
                                                <?php $msgNum = ($dados['nome_guerra']) ? $dados['nome_guerra'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>
                                            <td>
                                                <?php $msgNum = ($dados['numero']) ? $dados['numero'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($dados['estagiando'] == 1) {
                                                    echo '<span style="color:green;">Sim</span>';
                                                } else {
                                                    echo '<span style="color:red;">Não</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($dados['monitor'] == 1) {
                                                    echo '<span style="color:green;">Sim</span>';
                                                } else {
                                                    echo '<span style="color:red;">Não</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $dados['graduacao']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($dados['id_pelotao'] == 1) {
                                                    echo 'Águia';
                                                } else if ($dados['id_pelotao'] == 2) {
                                                    echo 'Falcão';
                                                } else if ($dados['id_pelotao'] == 3) {
                                                    echo 'Tigre';
                                                } else if ($dados['id_pelotao'] == 4) {
                                                    echo 'Leão';
                                                } else if ($dados['id_pelotao'] == 5) {
                                                    echo 'Cobra';
                                                } else {
                                                    echo '<span style="color:red;">Não informado</span>';
                                                }
                                                ?>
                                            </td>

                                            <td class="acoes">
                                                <a class="botaoTable" href="editarAluno.php?id_aluno=<?php echo $dados['id']; ?>">
                                                    <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a class="botaoTable"
                                                    href="msgExcluirAluno.php?nome=<?php echo urlencode($dados['nome']); ?>&id=<?php echo $dados['id']; ?>">
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
                </div>
            </div>


            <hr>


            <?php if (mysqli_num_rows($resultadoLista) > 0) { ?>
                <div class="card">
                    <div class="card-header">Lista de alunos</div>
                    <div class="card-header"><label><a href="cadastrarAluno.php"><button> <i class="fa-solid fa-user-tie"></i> Cadastrar um novo Aluno</button></a></label></div>
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

                            while ($dados = mysqli_fetch_assoc($resultadoLista)) {

                            ?>
                                <tr>
                                    <td>
                                        <?php $msgNum = ($dados['nome']) ? $dados['nome'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>
                                    <td>
                                        <?php $msgNum = ($dados['nome_guerra']) ? $dados['nome_guerra'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>
                                    <td>
                                        <?php $msgNum = ($dados['numero']) ? $dados['numero'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($dados['estagiando'] == 1) {
                                            echo '<span style="color:green;">Sim</span>';
                                        } else {
                                            echo '<span style="color:red;">Não</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($dados['monitor'] == 1) {
                                            echo '<span style="color:green;">Sim</span>';
                                        } else {
                                            echo '<span style="color:red;">Não</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $dados['graduacao']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($dados['id_pelotao'] == 1) {
                                            echo 'Águia';
                                        } else if ($dados['id_pelotao'] == 2) {
                                            echo 'Falcão';
                                        } else if ($dados['id_pelotao'] == 3) {
                                            echo 'Tigre';
                                        } else if ($dados['id_pelotao'] == 4) {
                                            echo 'Leão';
                                        } else if ($dados['id_pelotao'] == 5) {
                                            echo 'Cobra';
                                        } else {
                                            echo '<span style="color:red;">Não informado</span>';
                                        }
                                        ?>
                                    </td>

                                    <td class="acoes">
                                        <a class="botaoTable" href="editarAluno.php?id_aluno=<?php echo $dados['id']; ?>">
                                            <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                            <button class="botaoTable_excluir botaoAbrir" data-id="<?php echo $dados['id']; ?>"> Excluir <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else { ?>
                            <div class="card">
                                <div class="card-header">Opa!</div>
                                <div class="card-body">
                                    <h2 class="h2Dialog">Nenhum cadastro encontrado! <i class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146);"></i></h2>
                                    <h4 class="pDialog">Vamos começar registrando um novo aluno!</h4>
                                    <h4 class="pDialog">Vá para a página de cadastro de alunos e registre um novo aluno. Depois, volte aqui e o(s) aluno(s) cadastrado(s) aparecerá(ão) na lista.</h4>
                                    <div class="botoesDialog">
                                        <a href="cadastrarAluno.php"><button class="botaoDialog">Cadastrar um novo aluno</button></a>
                                        <a href="index.php"><button class="botaoDialog">Voltar para a página inicial</button></a>
                                    </div>
                                <?php } ?>
                        </table>
                    </div>
                </div>
        </div>
            <!-- CAIXA DE ALERTA AO CLICAR NO BOTÃO DE EXCLUIR -->
            <!-- odeio mexer nisso -->
            <dialog id="modal">
                <h2 class="h2Dialog">Atente-se! <i class="fa-solid fa-triangle-exclamation"
                        style="color: rgb(0, 107, 146);"></i></h2>
                <h4 class="pDialog">O aluno selecionado será excluido. Esta ação não possui volta!</h4>
                <h4 class="pDialog">Tem certeza?</h4>
                <div class="botoesDialog">
                    <button id="cancelar">Cancelar sem exclusão</button>
                    <button id="excluir">Sim, excluir</button>
                </div>
            </dialog>
</body>
<script>
    // nunca mais quero mexer nisso
    const modal = document.getElementById('modal');
    const cancelar = document.getElementById('cancelar');
    const excluir = document.getElementById('excluir');

    let idAluno = null;

    document.querySelectorAll('.botaoAbrir').forEach(botao => {

        botao.addEventListener('click', () => {
            idAluno = botao.dataset.id;

            modal.showModal();
        });

    });

    cancelar.addEventListener('click', () => {
        modal.close();
    });

    excluir.addEventListener('click', () => {

        modal.close();

        window.location.href = "F_excluirAluno.php?idAluno=" + idAluno;

    });
</script>
</html>