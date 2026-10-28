<?php
session_start();
$id = $_SESSION['id'];
include "conecta.php";

$sql = "SELECT * FROM responsavel ORDER BY nome";
$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsáveis</title>
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
    <script src="msgExcluirResp.js"></script>
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
        <li><a class="active" href="listarResponsaveis.php"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
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
                        <p><input type="text" name="pesquisa" placeholder="Digite o nome do responsável"></p>
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        <?php
                        if ($_POST) {
                            if (isset($_POST['pesquisa'])) {
                                $pesquisa = $_POST['pesquisa'];
                                $sql = "SELECT * FROM responsavel WHERE nome LIKE '%$pesquisa%' ORDER BY nome";
                            } else {
                                $sql = "SELECT * FROM responsavel ORDER BY nome";
                                $pesquisa = "";
                            }
                            $resultado = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($resultado) > 0) {
                                $numResultados = 0;
                                if ($pesquisa != "") {
                                    echo '<h3>Resultados encontrados para: <span>"' . $pesquisa . '"</span></h3>';
                                    echo '<table>';
                                    while ($resPesquisa = mysqli_fetch_assoc($resultado)) {
                                        $numResultados++;
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $resPesquisa['nome']; ?>
                                            </td>
                                            <td>
                                                <?php echo $resPesquisa['telefone']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $idAluno = "SELECT nome FROM aluno WHERE id =" . $resPesquisa['id_aluno'];
                                                $buscaAluno = mysqli_query($conn, $idAluno);
                                                if (mysqli_num_rows($buscaAluno) > 0) {
                                                    $nomeAluno = mysqli_fetch_assoc($buscaAluno);
                                                    echo $nomeAluno['nome'];
                                                } else {
                                                    echo '<span style="color:red;">Nenhum aluno associado!</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $resPesquisa['id']; ?>
                                            </td>
                                            <td class="acoes">
                                                <a class="botaoTable"
                                                    href="editarResponsavel.php?id_resp=<?php echo $resPesquisa['id']; ?>">
                                                    <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <button class="botaoTable_excluir botaoAbrir"
                                                    data-id="<?php echo $resPesquisa['id']; ?>">
                                                    Excluir <i class="fa-solid fa-trash-can"></i>
                                                </button>
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

            <?php if (mysqli_num_rows($resultado) > 0) { ?>
                <div class="card" id="divListagem">
                    <div class="card-header">LISTA DE RESPONSÁVEIS</div>
                    <div class="card-header"><label><a href="cadastrarResponsavel.php"><button><i
                                        class="fa-solid fa-user-tie"></i> Cadastrar um novo responsável</button></a></label>
                    </div>

                    <div class="card-body">
                        <table border="1">
                            <tr>
                                <th>Nome Completo</th>
                                <th>Número (WhatsApp)</th>
                                <th>Aluno associado</th>
                                <th>Identificador</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            $numLinhasImpressas = 0;
                            while ($dados = mysqli_fetch_assoc($resultado)) {
                                $numLinhasImpressas++;
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $dados['nome']; ?>
                                    </td>
                                    <td>
                                        <?php echo $dados['telefone']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $idAluno = "SELECT nome FROM aluno WHERE id =" . $dados['id_aluno'];
                                        $buscaAluno = mysqli_query($conn, $idAluno);
                                        if (mysqli_num_rows($buscaAluno) > 0) {
                                            $nomeAluno = mysqli_fetch_assoc($buscaAluno);
                                            echo $nomeAluno['nome'];
                                        } else {
                                            echo '<span style="color:red;">Nenhum aluno associado!</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $dados['id']; ?>
                                    </td>
                                    <td class="acoes">
                                        <a class="botaoTable" href="editarResponsavel.php?id_resp=<?php echo $dados['id']; ?>">
                                            <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <button class="botaoTable_excluir botaoAbrir" data-id="<?php echo $dados['id']; ?>">
                                            Excluir <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            if ($numLinhasImpressas == 0) {
                                ?>
                                <h3 style="color: red;">Não existem responsáveis cadastrados no sistema!</h3>
                                <?php
                            }
                            ?>
                        </table>
                    </div>

                </div>
            <?php } else { ?>
                <div class="card">
                    <div class="card-header">Opa!</div>
                    <div class="card-body">
                        <h2 class="h2Dialog">Nenhum cadastro encontrado! <i class="fa-solid fa-triangle-exclamation"
                                style="color: rgb(0, 107, 146);"></i></h2>
                        <h4 class="pDialog">Vamos começar registrando um novo responsável!</h4>
                        <h4 class="pDialog">Vá para a página de cadastro de responsáveis e registre um novo responsável.
                            Depois, volte
                            aqui e o(s) responsável(s) cadastrado(s) aparecerá(ão) na lista.</h4>
                        <div class="botoesDialog">
                            <a href="cadastrarResponsavel.php"><button class="botaoDialog">Cadastrar um novo
                                    responsável</button></a>
                            <a href="index.php"><button class="botaoDialog">Voltar para a página inicial</button></a>
                        </div>
                        </div>
                </div>  
                    <?php } ?>
                    <!-- CAIXA DE ALERTA AO CLICAR NO BOTÃO DE EXCLUIR -->
                    <!-- odeio mexer nisso -->
                    <dialog id="modal">
                        <h2 class="h2Dialog">Atente-se! <i class="fa-solid fa-triangle-exclamation"
                                style="color: rgb(0, 107, 146);"></i></h2>
                        <h4 class="pDialog">O responsável selecionado será excluido. Esta ação não possui volta!</h4>
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

    let idResp = null;

    document.querySelectorAll('.botaoAbrir').forEach(botao => {

        botao.addEventListener('click', () => {
            idResp = botao.dataset.id;

            modal.showModal();
        });

    });

    cancelar.addEventListener('click', () => {
        modal.close();
    });

    excluir.addEventListener('click', () => {

        modal.close();

        window.location.href = "F_excluirResponsavel.php?idResp=" + idResp;

    });
</script>

</html>