<?php
session_start();
$id = $_SESSION['id'];
include "../controller/conecta.php";

$sqlLista = "SELECT a.*, r.nome as nome_Resp, r.arquivado as respArquivado FROM aluno a LEFT JOIN responsavel r ON a.id = r.id_aluno WHERE a.arquivado = 0 ORDER BY a.nome;";
//WHERE a.arquivado = 0 AND r.arquivado = 0 

$resultadoLista = mysqli_query($conn, $sqlLista);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar alunos</title>
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
        <h1>Alunos</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>
    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>

    <div class="main-wrapper">
        <div class="card">
            <div class="card-header">
                <button type="button" id="abrirCadastro">
                    <i class="fa-solid fa-id-card"></i>Cadastrar Aluno
                </button>
                <button type="button" id="abrirPerguntaArquivarTudo">
                    <i class="fa-solid fa-folder-plus"></i>Arquivar tudo
                </button>
                <label><a href="../source/F_gerarPDF.php?qualPdf=listaAlunos">
                    <button><i class="fa-solid fa-file-pdf"></i>Baixar lista</button>
                </a></label>
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
            <div class="card-body">
                <form method="POST" action="../source/F_cadastrarAluno.php">
                    <div class="card-body">
                        <label>
                            <p>Nome completo: <br><input type="text" name="nome" required></p>
                        </label>
                        <label>
                            <p>Nome de Guerra: <br><input type="text" name="nome_guerra" required></p>
                        </label>
                        <label>
                            <p>Número: <br><input type="text" name="numero" required></p>
                        </label>
                            <p>Graduação:<br>
                                <select name="graduacao" required>
                                    <option value="" disabled selected></option>
                                    <option value="Coronel"> Coronel </option>
                                    <option value="Tenente-Coronel"> Tenente-Coronel </option>
                                    <option value="Major"> Major </option>
                                    <option value="Capitão"> Capitão </option>
                                    <option value="1º Tenente"> 1º Tenente </option>
                                    <option value="2º Tenente"> 2º Tenente </option>
                                    <option value="1º Sargento"> 1º Sargento </option>
                                    <option value="2º Sargento"> 2º Sargento </option>
                                    <option value="3º Sargento"> 3º Sargento </option>
                                    <option value="Cabo"> Cabo </option>
                                    <option value="Soldado"> Soldado </option>
                                </select>
                            </p>
                            <p>Pelotão:<br>
                                <select name="id_pelotao" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">Cobra</option>
                                    <option value="2">Aguia</option>
                                    <option value="3">Tigre</option>
                                    <option value="4">Leão</option>
                                    <option value="5">Falcão</option>
                                </select>
                            </p>
                        <fieldset class="radio-group">
                            <legend>Em estágio?</legend>
                                <label class="radio-label">
                                    <input type="radio" name="estagiando" value="1" class="radio-input" required> Sim
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="estagiando" value="0" class="radio-input" required> Não
                                </label>
                            </fieldset>
                        <fieldset class="radio-group">
                            <legend>Formado Monitor?</legend>
                                <label class="radio-label">
                                    <input type="radio" name="monitor" value="1" class="radio-input" required> Sim
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="monitor" value="0" class="radio-input" required> Não
                                </label>
                            </fieldset>
                        <hr>
                        <input type="submit" value="Cadastrar">
                        <br>
                    </div>
                </form>
            </div>
        </dialog>

        <div class="content">

            <details open> 
                <summary> Abrir/Fechar PESQUISA </summary>
                    <form method="POST" action="">
                        <p><input type="text" name="pesquisa" placeholder="Pesquise por NOME, NÚMERO ou NOME de GUERRA"></p>
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                    </form>
                    <?php
                    if ($_POST) {
                        if (isset($_POST['pesquisa'])) {
                            $pesquisa = $_POST['pesquisa'];
                            $sql = "SELECT aluno.*, responsavel.nome as nome_Resp 
                                    FROM aluno 
                                    LEFT JOIN responsavel ON responsavel.id_aluno = aluno.id
                                    WHERE (aluno.nome LIKE '%$pesquisa%' 
                                    OR aluno.nome_guerra LIKE '%$pesquisa%'
                                    OR aluno.numero LIKE '%$pesquisa%') 
                                    AND aluno.arquivado = 0 
                                    ORDER BY aluno.nome";
                        } else {
                            $pesquisa = "";
                        }
                        $resultado = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($resultado) > 0) {
                            $numResultados = 0;
                            if ($pesquisa != "") {
                                echo '<br><br>Resultados encontrados para: <span>"' . $pesquisa . '"</span>';
                                echo '<table>
                                            <tr>
                                                <th>Nome Completo</th>
                                                <th>Nome de guerra</th>
                                                <th>Número de guerra</th>
                                                <th>Responsável</th>
                                                <th>Estagiando</th>
                                                <th>Monitor</th>
                                                <th>Graduação</th>
                                                <th>Pelotão</th>
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
                                                $nomeResp = '<span style="color: #red;">Não informado</span>';
                                                if($dados['nome_Resp'] != NULL) {
                                                    if ($dados['respArquivado'] == 1) {
                                                        $nomeResp = '<span style="color: #FF7A2A;">' . $dados['nome_Resp'] . '</span>';
                                                    } else {
                                                        $nomeResp = $dados['nome_Resp'];
                                                    }
                                                }
                                                echo $nomeResp;
                                            ?>                                            
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
                                                echo 'Cobra';
                                            } else if ($dados['id_pelotao'] == 2) {
                                                echo 'Águia';
                                            } else if ($dados['id_pelotao'] == 3) {
                                                echo 'Tigre';
                                            } else if ($dados['id_pelotao'] == 4) {
                                                echo 'Leão';
                                            } else if ($dados['id_pelotao'] == 5) {
                                                echo 'Falcão';
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
            </details>

            
<!-- LISTA PELOTÃO COBRA COBRA COBRS -->
            <?php
            $sqlListaCOBRA = "SELECT a.*, r.nome as nome_Resp, r.arquivado as respArquivado FROM aluno a LEFT JOIN responsavel r ON a.id = r.id_aluno WHERE a.arquivado = 0 AND id_pelotao = 1 ORDER BY a.nome";
            $resultadoListaCOBRA = mysqli_query($conn, $sqlListaCOBRA);
            if (mysqli_num_rows($resultadoListaCOBRA) > 0) { ?>
                <details>
                    <summary>Pelotão COBRA</summary>
                        <table>
                            <tr>
                                <th>Nome Completo</th>
                                <th>Nome de guerra</th>
                                <th>Responsável</th>
                                <th>Número de guerra</th>
                                <th>Estagiando</th>
                                <th>Monitor</th>
                                <th>Graduação</th>
                                <th>Pelotão</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            while ($dados = mysqli_fetch_assoc($resultadoListaCOBRA)) {
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
                                        <?php 
                                            $nomeResp = '<span style="color: red;">Não informado</span>';
                                            if($dados['nome_Resp'] != NULL) {
                                                if ($dados['respArquivado'] == 1) {
                                                    $nomeResp = '<span style="color: #FF7A2A;">' . $dados['nome_Resp'] . '</span>';
                                                } else {
                                                    $nomeResp = $dados['nome_Resp'];
                                                }
                                            }
                                            echo $nomeResp;
                                        ?>                                            
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
                                            echo 'Cobra';
                                        } else if ($dados['id_pelotao'] == 2) {
                                            echo 'Águia';
                                        } else if ($dados['id_pelotao'] == 3) {
                                            echo 'Tigre';
                                        } else if ($dados['id_pelotao'] == 4) {
                                            echo 'Leão';
                                        } else if ($dados['id_pelotao'] == 5) {
                                            echo 'Falcão';
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
                                        <button class="botaoTable_excluir botaoAbrir" data-id="<?php echo $dados['id']; ?>"> Arquivar <i class="fa-solid fa-box-archive"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                </details>
            <?php } else { ?>
                <details>
                    <summary>Pelotão COBRA</summary>
                        <h2 class="h2Dialog">Nenhum aluno associado ao pelotão COBRA! <i class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146);"></i></h2>
                        <h4 class="pDialog">Vá para a página de cadastro de alunos e registre um novo aluno. Depois, volte aqui e o(s) aluno(s) cadastrado(s) aparecerá(ão) na lista.</h4>
                        <div class="botoesDialog">
                            <a href="cadastrarAluno.php"><button class="botaoDialog">Cadastrar um novo aluno</button></a>
                        </div>
                </details>
            <?php } ?>
            
            

            <?php 
            $sqlListaAGUIA = "SELECT a.*, r.nome as nome_Resp, r.arquivado as respArquivado FROM aluno a LEFT JOIN responsavel r ON a.id = r.id_aluno WHERE a.arquivado = 0 AND id_pelotao = 2 ORDER BY a.nome";
            $resultadoListaAGUIA = mysqli_query($conn, $sqlListaAGUIA);
            if (mysqli_num_rows($resultadoListaAGUIA) > 0) { ?>
                <details>
                    <summary>Pelotão ÁGUIA</summary>
                        <table>
                            <tr>
                                <th>Nome Completo</th>
                                <th>Nome de guerra</th>
                                <th>Responsável</th>
                                <th>Número de guerra</th>
                                <th>Estagiando</th>
                                <th>Monitor</th>
                                <th>Graduação</th>
                                <th>Pelotão</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            while ($dados = mysqli_fetch_assoc($resultadoListaAGUIA)) {
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
                                        <?php 
                                            $nomeResp = '<span style="color: red;">Não informado</span>';
                                            if($dados['nome_Resp'] != NULL) {
                                                if ($dados['respArquivado'] == 1) {
                                                    $nomeResp = '<span style="color: #FF7A2A;">' . $dados['nome_Resp'] . '</span>';
                                                } else {
                                                    $nomeResp = $dados['nome_Resp'];
                                                }
                                            }
                                            echo $nomeResp;
                                        ?>                                            
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
                                            echo 'Cobra';
                                        } else if ($dados['id_pelotao'] == 2) {
                                            echo 'Águia';
                                        } else if ($dados['id_pelotao'] == 3) {
                                            echo 'Tigre';
                                        } else if ($dados['id_pelotao'] == 4) {
                                            echo 'Leão';
                                        } else if ($dados['id_pelotao'] == 5) {
                                            echo 'Falcão';
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
                                        <button class="botaoTable_excluir botaoAbrir" data-id="<?php echo $dados['id']; ?>"> Arquivar <i class="fa-solid fa-box-archive"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                </details>
            <?php } else { ?>
                <details>
                    <summary>Pelotão ÁGUIA</summary>
                        <h2 class="h2Dialog">Nenhum aluno associado ao pelotão ÁGUIA! <i class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146);"></i></h2>
                        <h4 class="pDialog">Vá para a página de cadastro de alunos e registre um novo aluno. Depois, volte aqui e o(s) aluno(s) cadastrado(s) aparecerá(ão) na lista.</h4>
                        <div class="botoesDialog">
                            <a href="cadastrarAluno.php"><button class="botaoDialog">Cadastrar um novo aluno</button></a>
                        </div>
                </details>
            <?php } ?>
            
            
            

            <?php 
            $sqlListaTIGRE = "SELECT a.*, r.nome as nome_Resp, r.arquivado as respArquivado FROM aluno a LEFT JOIN responsavel r ON a.id = r.id_aluno WHERE a.arquivado = 0 AND id_pelotao = 3 ORDER BY a.nome";
            $resultadoListaTIGRE = mysqli_query($conn, $sqlListaTIGRE);
            if (mysqli_num_rows($resultadoListaTIGRE) > 0) { ?>
                <details>
                    <summary>Pelotão TIGRE</summary>
                        <table>
                            <tr>
                                <th>Nome Completo</th>
                                <th>Nome de guerra</th>
                                <th>Responsável</th>
                                <th>Número de guerra</th>
                                <th>Estagiando</th>
                                <th>Monitor</th>
                                <th>Graduação</th>
                                <th>Pelotão</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            while ($dados = mysqli_fetch_assoc($resultadoListaTIGRE)) {
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
                                        <?php 
                                            $nomeResp = '<span style="color: red;">Não informado</span>';
                                            if($dados['nome_Resp'] != NULL) {
                                                if ($dados['respArquivado'] == 1) {
                                                    $nomeResp = '<span style="color: #FF7A2A;">' . $dados['nome_Resp'] . '</span>';
                                                } else {
                                                    $nomeResp = $dados['nome_Resp'];
                                                }
                                            }
                                            echo $nomeResp;
                                        ?>                                            
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
                                            echo 'Cobra';
                                        } else if ($dados['id_pelotao'] == 2) {
                                            echo 'Águia';
                                        } else if ($dados['id_pelotao'] == 3) {
                                            echo 'Tigre';
                                        } else if ($dados['id_pelotao'] == 4) {
                                            echo 'Leão';
                                        } else if ($dados['id_pelotao'] == 5) {
                                            echo 'Falcão';
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
                                        <button class="botaoTable_excluir botaoAbrir" data-id="<?php echo $dados['id']; ?>"> Arquivar <i class="fa-solid fa-box-archive"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </details>
            <?php } else { ?>
                <details>
                    <summary>Pelotão TIGRE</summary>
                        <h2 class="h2Dialog">Nenhum aluno associado ao pelotão TIGRE! <i class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146);"></i></h2>
                        <h4 class="pDialog">Vá para a página de cadastro de alunos e registre um novo aluno. Depois, volte aqui e o(s) aluno(s) cadastrado(s) aparecerá(ão) na lista.</h4>
                        <div class="botoesDialog">
                            <a href="cadastrarAluno.php"><button class="botaoDialog">Cadastrar um novo aluno</button></a>
                        </div>
                </details>
            <?php } ?>
            
            
                        
            <?php 
            $sqlListaLEAO = "SELECT a.*, r.nome as nome_Resp, r.arquivado as respArquivado FROM aluno a LEFT JOIN responsavel r ON a.id = r.id_aluno WHERE a.arquivado = 0 AND id_pelotao = 4 ORDER BY a.nome";
			$resultadoListaLEAO = mysqli_query($conn, $sqlListaLEAO);
            if (mysqli_num_rows($resultadoListaLEAO) > 0) { ?>
                <details>
                    <summary>Pelotão LEÃO</summary>
                        <table>
                            <tr>
                                <th>Nome Completo</th>
                                <th>Nome de guerra</th>
                                <th>Responsável</th>
                                <th>Número de guerra</th>
                                <th>Estagiando</th>
                                <th>Monitor</th>
                                <th>Graduação</th>
                                <th>Pelotão</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            while ($dados = mysqli_fetch_assoc($resultadoListaLEAO)) {
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
                                        <?php 
                                            $nomeResp = '<span style="color: red;">Não informado</span>';
                                            if($dados['nome_Resp'] != NULL) {
                                                if ($dados['respArquivado'] == 1) {
                                                    $nomeResp = '<span style="color: #FF7A2A;">' . $dados['nome_Resp'] . '</span>';
                                                } else {
                                                    $nomeResp = $dados['nome_Resp'];
                                                }
                                            }
                                            echo $nomeResp;
                                        ?>                                            
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
                                            echo 'Cobra';
                                        } else if ($dados['id_pelotao'] == 2) {
                                            echo 'Águia';
                                        } else if ($dados['id_pelotao'] == 3) {
                                            echo 'Tigre';
                                        } else if ($dados['id_pelotao'] == 4) {
                                            echo 'Leão';
                                        } else if ($dados['id_pelotao'] == 5) {
                                            echo 'Falcão';
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
                                        <button class="botaoTable_excluir botaoAbrir" data-id="<?php echo $dados['id']; ?>"> Arquivar <i class="fa-solid fa-box-archive"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </details>
            <?php } else { ?>
                <details>
                    <summary>Pelotão LEÃO</summary>
                        <h2 class="h2Dialog">Nenhum aluno associado ao pelotão LEÃO! <i class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146);"></i></h2>
                        <h4 class="pDialog">Vá para a página de cadastro de alunos e registre um novo aluno. Depois, volte aqui e o(s) aluno(s) cadastrado(s) aparecerá(ão) na lista.</h4>
                        <div class="botoesDialog">
                            <a href="cadastrarAluno.php"><button class="botaoDialog">Cadastrar um novo aluno</button></a>
                        </div>
                </details>
            <?php } ?>
            
            

            <?php 
            $sqlListaFALCAO = "SELECT a.*, r.nome as nome_Resp, r.arquivado as respArquivado FROM aluno a LEFT JOIN responsavel r ON a.id = r.id_aluno WHERE a.arquivado = 0 AND id_pelotao = 5 ORDER BY a.nome";
			$resultadoListaFALCAO = mysqli_query($conn, $sqlListaFALCAO);
    		if (mysqli_num_rows($resultadoListaFALCAO) > 0) { ?>
                <details>
                    <summary>Pelotão FALCÃO</summary>
                        <table>
                            <tr>
                                <th>Nome Completo</th>
                                <th>Nome de guerra</th>
                                <th>Responsável</th>
                                <th>Número de guerra</th>
                                <th>Estagiando</th>
                                <th>Monitor</th>
                                <th>Graduação</th>
                                <th>Pelotão</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            while ($dados = mysqli_fetch_assoc($resultadoListaFALCAO)) {
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
                                        <?php 
                                            $nomeResp = '<span style="color: red;">Não informado</span>';
                                            if($dados['nome_Resp'] != NULL) {
                                                if ($dados['respArquivado'] == 1) {
                                                    $nomeResp = '<span style="color: #FF7A2A;">' . $dados['nome_Resp'] . '</span>';
                                                } else {
                                                    $nomeResp = $dados['nome_Resp'];
                                                }
                                            }
                                            echo $nomeResp;
                                        ?>                                            
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
                                            echo 'Cobra';
                                        } else if ($dados['id_pelotao'] == 2) {
                                            echo 'Águia';
                                        } else if ($dados['id_pelotao'] == 3) {
                                            echo 'Tigre';
                                        } else if ($dados['id_pelotao'] == 4) {
                                            echo 'Leão';
                                        } else if ($dados['id_pelotao'] == 5) {
                                            echo 'Falcão';
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
                                        <button class="botaoTable_excluir botaoAbrir" data-id="<?php echo $dados['id']; ?>"> Arquivar <i class="fa-solid fa-box-archive"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </details>
            <?php } else { ?>
                <details>
                    <summary>Pelotão FALCÃO</summary>
                        <h2 class="h2Dialog">Nenhum aluno associado ao pelotão FALCÃO! <i class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146);"></i></h2>
                        <h4 class="pDialog">Vá para a página de cadastro de alunos e registre um novo aluno. Depois, volte aqui e o(s) aluno(s) cadastrado(s) aparecerá(ão) na lista.</h4>
                        <div class="botoesDialog">
                            <a href="cadastrarAluno.php"><button class="botaoDialog">Cadastrar um novo aluno</button></a>
                        </div>
                </details>
            <?php } ?>
            
            <!-- CAIXA DE ALERTA AO CLICAR NO BOTÃO DE EXCLUIR -->
            <dialog id="modal">
                <h2 class="h2Dialog">Enviar à Lixeira?</h2>
                <h4 class="pDialog">O Aluno selecionado será mandado para a Lixeira. Você pode reverter essa ação.</h4>
                <h4 class="pDialog">Tem certeza?</h4>
                <div class="botoesDialog">
                    <button id="cancelar">Cancelar</button>
                    <button id="excluir">Arquivar</button>
                </div>
            </dialog>

            <dialog id="modalArquivarTudo">
                <h2 class="h2Dialog">Enviar TODOS à Lixeira?</h2>
                <h4 class="pDialog">Todos os Alunos cadastrados serão enviados à Lixeira. Você pode reverter essa ação.</h4>
                <h4 class="pDialog">Tem certeza?</h4>
                <div class="botoesDialog">
                    <button id="fecharPerguntaArquivarTudo">Cancelar</button>
                    <button class="botaoTable_excluir" id="arquivarTudo">Arquivar tudo</button>
                </div>
            </dialog>
        </div>
    </div>
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

        window.location.href = "../source/F_arquivarAluno.php?idAluno=" + idAluno;

    });


    const modalCadastro = document.getElementById("modalCadastro"); //abrri popup do formulário

    document.getElementById("abrirCadastro").addEventListener("click", () => {
        modalCadastro.showModal();
    });

    document.getElementById("fecharCadastro").addEventListener("click", () => {
        modalCadastro.close();
    });



    const modalArquivarTudo = document.getElementById("modalArquivarTudo"); //abrri popup do formulário

    document.getElementById("abrirPerguntaArquivarTudo").addEventListener("click", () => {
        modalArquivarTudo.showModal();
    });

    document.getElementById("fecharPerguntaArquivarTudo").addEventListener("click", () => {
        modalArquivarTudo.close();
    });

    arquivarTudo.addEventListener('click', () => {
        modalArquivarTudo.close();
        window.location.href = "../source/F_arquivarTudo.php?tipo=alunos&acao=1";

    });
</script>
</html>