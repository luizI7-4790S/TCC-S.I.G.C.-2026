<?php
session_start();

$id = $_SESSION['id'];
include "../controller/conecta.php";

$sql = "SELECT * FROM arrecadacao ORDER BY mes DESC";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrecadação</title>
    <?php
	include "../source/verStyle.php";
    echo buscarTema($id);
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../images/logoCoter.png" type="image/x-icon">
</head>

<body>
    <!-- 1. OBRIGATÓRIO: O controle do menu fica no topo do body para o CSS funcionar -->
    <input type="checkbox" id="menu-toggle" style="display: none;">

    <header>
        <!-- 2. O label aponta para o ID do input acima -->
        <label for="menu-toggle" class="hamburger">&#9776;</label>
        <h1>Arrecadação</h1>
    </header>
    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>

    <div class="main-wrapper">
        <div class="content">

            <div class="card">
                <div class="card-header">Pesquisa</div>
                <div class="card-body">
                    <form method="POST" action="">
                        <p><input type="text" name="pesquisa" placeholder="Digite o ano"></p>
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        <?php
                        if ($_POST) {
                            if (isset($_POST['pesquisa'])) {
                                $pesquisa = $_POST['pesquisa'];
                                $sql = "SELECT * FROM arrecadacao WHERE ano = '$pesquisa' ORDER BY mes DESC";
                            } else {
                                $sql = "SELECT * FROM arrecadacao ORDER BY mes DESC";
                                $pesquisa = "";
                            }
                            $resultado = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($resultado) > 0) {
                                $numResultados = 0;
                                if ($pesquisa != "") {
                                    echo '<h3>Resultados encontrados para: <span>"' . $pesquisa . '"</span></h3>';
                                    echo '<table>
                                            <tr>
                                                <th>Ano</th>
                                                <th>Mês</th>
                                                <th>Valor total</th>
                                                <th>Mensalidades</th>
                                                <th>Ações</th>
                                            </tr>';
                                    while ($resPesquisa = mysqli_fetch_assoc($resultado)) {
                                        $numResultados++;
                        ?>
                                        <tr>
                                            <td>
                                                <?php $msgNum = ($resPesquisa['ano']) ? $resPesquisa['ano'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>
                                            <td>
                                                <?php $msgNum = ($resPesquisa['mes']) ? $resPesquisa['mes'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>
                                            <td>
                                                <?php $msgNum = ($resPesquisa['valor']) ? $resPesquisa['valor'] : '<span style="color:red;">Não informado</span>';
                                                echo 'R$ ' . number_format($msgNum, 2, ',', '.') . ' Reais'; ?>
                                            </td>
                                            <td>
                                                <?php $msgNum = ($resPesquisa['qtd_mensalidades']) ? $resPesquisa['qtd_mensalidades'] : '<span style="color:red;">Não informado</span>';
                                                echo $msgNum; ?>
                                            </td>

                                            <td class="acoes">
                                                <a class="botaoTable" href="editarResponsavel.php?id_resp=<?php echo $resPesquisa['id']; ?>">
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


            <?php if (mysqli_num_rows($resultado) > 0) { ?>
                <div class="card">
                    <div class="card-header">Lista de Arrecadações </div>
                    <div class="card-header"><label><a href="cadastrarMensalidade.php"><button> <i class="fa-solid fa-user-tie"></i> Alterar valores atuais </button></a></label></div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <th>Ano</th>
                                <th>Mês</th>
                                <th>Valor total</th>
                                <th>Mensalidades</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            $numLinhasImpressas = 0;
                            while ($resPesquisa = mysqli_fetch_assoc($resultado)) {
                                $numLinhasImpressas++;
                            ?>
                                <tr>
                                    <td>
                                        <?php $msgNum = ($resPesquisa['ano']) ? $resPesquisa['ano'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>
                                    <td>
                                        <?php $msgNum = ($resPesquisa['mes']) ? $resPesquisa['mes'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>
                                    <td>
                                        <?php $msgNum = ($resPesquisa['valor']) ? $resPesquisa['valor'] : '<span style="color:red;">Não informado</span>';
                                        echo 'R$ ' . number_format($msgNum, 2, ',', '.') . ' Reais'; ?>
                                    </td>
                                    <td>
                                        <?php $msgNum = ($resPesquisa['qtd_mensalidades']) ? $resPesquisa['qtd_mensalidades'] : '<span style="color:red;">Não informado</span>';
                                        echo $msgNum; ?>
                                    </td>

                                    <td class="acoes">
                                        <a class="botaoTable" href="editarResponsavel.php?id_resp=<?php echo $resPesquisa['id']; ?>">
                                            <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            if ($numLinhasImpressas == 0) {
                            ?>
                                <h3 style="color: red;">Não existem alunos cadastrados no sistema!</h3>
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
                        <h2 class="h2Dialog">Nenhum registro encontrado! <i class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146);"></i></h2>
                        <h4 class="pDialog">O mês começou e não há moedas no cofrinho!</h4>
                        <h4 class="pDialog">Vá para a página de cadastro de Mensalidades e registre um novo pagamento. Depois, volte aqui e a arrecadação total até o momento será contabilizada e incrementada.</h4>
                        <div class="botoesDialog">
                            <a href="listarMensalidades.php"><button class="botaoDialog">Cadastrar um novo pagamento</button></a>
                            <a href="index.php"><button class="botaoDialog">Voltar para a página inicial</button></a>
                        </div>
                    <?php } ?>
                    </div>

</body>

</html>