<?php
session_start();
$id = $_SESSION['id'];
include "../controller/conecta.php";

//de cara já verifica se tem sessão existente
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sqlAdmin = "SELECT * FROM administrador WHERE id= '$id'";
    $resAdmin = mysqli_query($conn, $sqlAdmin);
    $dadosAdmin = mysqli_fetch_assoc($resAdmin);
    $_SESSION["tema"] = $dadosAdmin["tema"];
} else {
    header('Location:login.php');
    exit;
}

$sqlLista = "SELECT * FROM aluno WHERE arquivado = 0 AND estagiando = 1 ORDER BY nome";
$resultadoLista = mysqli_query($conn, $sqlLista);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar estagiários</title>
    <?php
    include "../source/verStyle.php";
    $tema = buscarTema($id);
    ?>
    <link rel="stylesheet" href="../styles/style_CLOUDE.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../images/logoCoter.png" type="image/x-icon">
</head>

<body data-theme='<?php echo $tema ?>'>
    <!-- 1. OBRIGATÓRIO: O controle do menu fica no topo do body para o CSS funcionar -->
    <input type="checkbox" id="menu-toggle" style="display: none;">

    <header>
        <!-- 2. O label aponta para o ID do input acima -->
        <h1>Estagiários</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>
    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>
    <div class="main-wrapper">
                <div class="card">
            <div class="card-header">
                <button type="button" id="abrirCadastro">
                    <i class="fa-solid fa-square-check"></i><span class="anderlineInvisivel">_</span>Atribuir estágio 
                </button>
                <label>
                    <a href="../source/F_gerarPDF.php?qualPdf=listaEstagio">
                        <button type="button">
                            <i class="fa-solid fa-file-pdf"></i><span class="anderlineInvisivel">_</span>Baixar lista
                        </button>
                    </a>
                </label>
            </div>
        </div>
        <br>
        
        
        
        
        <!-- formulário de cadastrar aluno -->
        <dialog id="modalCadastro" style="max-width:900px;width:90%;">

            <div class="card-header" style="border-radius: 5px;">
                <button type="button" id="fecharCadastro">
                    Fechar Formulário
                </button>
            </div>

            <form method="POST" action="../source/F_atribuirEstagio.php">
                <div class="card-body">
                        <p>Selecione os Alunos do pelotão COBRA que serão estagiários<br>
                            <fieldset class="radio-group">
                                <?php
                                $sqlAlunos = "SELECT * FROM aluno WHERE arquivado = 0 AND id_pelotao = 1 AND estagiando = 0 ORDER BY nome";
                                $resultadoAlunos = mysqli_query($conn, $sqlAlunos);
                                while ($dadosAluno = mysqli_fetch_assoc($resultadoAlunos)) {
                                    echo '<label><input type="checkbox" name="alunos[]" value="'. $dadosAluno['id'] .'">
                                    		' . $dadosAluno['nome'] . '<label><br>';
                                }
                                ?>
                            </fieldset>
                        </p>
                    <input type="submit" value="Atribuir Estágio">
            </form>
        </dialog>

        
        <div class="content">

            <details open>
                <summary>PESQUISA</summary>
                    <form method="POST" action="">
                        <p><input type="text" name="pesquisa" placeholder="Digite o nome do aluno em estágio"></p>
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i><span class="anderlineInvisivel">_</span>Pesquisar</button>
                        <label><a href="listarEstagiario.php"><button>Limpar</button></a></label>
                        <?php
                        if ($_POST) {
                            if (isset($_POST['pesquisa'])) {
                                $pesquisa = $_POST['pesquisa'];
                                $sqlLista = "SELECT * FROM aluno WHERE arquivado = 0 AND nome LIKE '%$pesquisa%' AND estagiando = 1 ORDER BY nome";
                            } else {
                                $sqlLista = "SELECT * FROM aluno WHERE arquivado = 0 AND estagiando = 1 ORDER BY nome";
                                $pesquisa = "";
                            }
                            $resultado = mysqli_query($conn, $sqlLista);

                            if (mysqli_num_rows($resultado) > 0) {
                                $numResultados = 0;
                                if ($pesquisa != "") {
                                    echo '<p>Resultados encontrados para: "' . $pesquisa . '"</p>';
                                    echo '<table>
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
                                                    echo 'Cobra';
                                                } else if ($resPesquisa['id_pelotao'] == 2) {
                                                    echo '<span style="color:red;">Águia</span>';
                                                } else if ($resPesquisa['id_pelotao'] == 3) {
                                                    echo '<span style="color:red;">Tigre</span>';
                                                } else if ($resPesquisa['id_pelotao'] == 4) {
                                                    echo '<span style="color:red;">Leão</span>';
                                                } else if ($resPesquisa['id_pelotao'] == 5) {
                                                    echo '<span style="color:red;">Falcão</span>';
                                                } else {
                                                    echo '<span style="color:red;">Não informado</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                        <?php
                                    }
                                    echo '</table>';
                                }
                            }
                        }
                        ?>
                    </form>
            </details>


            <hr>



            <?php if (mysqli_num_rows($resultadoLista) > 0) { ?>
                <div class="card">
                    <div class="card-header">LISTA DE ESTAGIÁRIOS</div>
                        <table>
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
                                            echo 'Cobra';
                                        } else if ($resPesquisa['id_pelotao'] == 2) {
                                                    echo '<span style="color:orange;">Águia</span>';
                                                } else if ($resPesquisa['id_pelotao'] == 3) {
                                                    echo '<span style="color:orange;">Tigre</span>';
                                                } else if ($resPesquisa['id_pelotao'] == 4) {
                                                    echo '<span style="color:orange;">Leão</span>';
                                                } else if ($resPesquisa['id_pelotao'] == 5) {
                                                    echo '<span style="color:orange;">Falcão</span>';
                                                } else {
                                                    echo '<span style="color:red;">Não informado</span>';
                                                }
                                        ?>
                                    </td>

                                    <td class="acoes">
                                        <a class="botaoTable"
                                            href="editarAluno.php?id_aluno=<?php echo $resPesquisa['id']; ?>">
                                            <button class=""> <i class="fa-solid fa-pen-to-square"></i>
                                                <span class="anderlineInvisivel">_</span>Editar 
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

</body>
<script>
    const modalCadastro = document.getElementById("modalCadastro"); //abrri popup do formulário

    document.getElementById("abrirCadastro").addEventListener("click", () => {
        modalCadastro.showModal();
    });

    document.getElementById("fecharCadastro").addEventListener("click", () => {
        modalCadastro.close();
    });    
</script>
</html>