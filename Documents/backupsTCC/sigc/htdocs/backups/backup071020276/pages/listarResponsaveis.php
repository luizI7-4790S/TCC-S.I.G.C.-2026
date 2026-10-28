<?php
session_start();
$id = $_SESSION['id'];
include "../controller/conecta.php";

$sql = "SELECT * FROM responsavel WHERE arquivado = 0 ORDER BY nome";
$resultadoLista = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsáveis</title>
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
        <h1>Responsáveis</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>
    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>
    <div class="main-wrapper">


        <div class="card">
            <div class="card-header">
                <button type="button" id="abrirCadastro">
                    <i class="fa-solid fa-id-card"></i>Cadastrar Responsável
                </button>
                <button type="button" id="abrirPerguntaArquivarTudo">
                    <i class="fa-solid fa-folder-plus"></i>Arquivar tudo
                </button>
                 <label><a href="../source/F_gerarPDF.php?qualPdf=listaResponsaveis">
                    <button type="button"><i class="fa-solid fa-file-pdf"></i>Baixar lista</button>
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

            <form method="POST" action="../source/F_cadastrarResponsavel.php">
                <div class="card-body">
                    <label>
                        <p>Nome completo:<br><input type="text" name="nome" required></p>
                    </label>
                    <label>
                        <p>Número de telefone (WhatsApp):<br><input type="text" id="whatsapp" placeholder="(00) 90000-0000" maxlength="15" name="telefone" required></p>
                    </label>
                    <label>
                        <p>Aluno subordinado:<br>
                            <select name="alunoSubordinado">
                                <option> Selecione </option>
                                <?php
                                $sqlAlunos = "SELECT * FROM aluno WHERE arquivado = 0 ORDER BY nome";
                                $resultadoAlunos = mysqli_query($conn, $sqlAlunos);
                                while ($dadosAluno = mysqli_fetch_assoc($resultadoAlunos)) {
                                    echo '<option value=' . $dadosAluno['id'] . '> ' . $dadosAluno['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </p>
                    </label>
                    <input type="submit" value="Cadastrar">

            </form>
        </dialog>


        <div class="content">
            <details open> 
                <summary> Abrir/Fechar PESQUISA </summary>
                    <form method="POST" action="">
                        <p><input type="text" name="pesquisa" placeholder="Pesquise por NOME ou TELEFONE"></p>
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                        <?php
                        if ($_POST) {
                            if (isset($_POST['pesquisa'])) {
                                $pesquisa = $_POST['pesquisa'];
                                $sql = "SELECT * FROM responsavel WHERE
                                nome LIKE '%$pesquisa%' OR
                                telefone LIKE '%$pesquisa%'
                                AND arquivado = 0
                                ORDER BY nome";
                            } else {
                                $sql = "SELECT * FROM responsavel WHERE arquivado = 0 ORDER BY nome";
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
                                                <th>Número (WhatsApp)</th>
                                                <th>Aluno associado</th>
                                            </tr>';
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
                    <div class="card-header">LISTA DE RESPONSÁVEIS</div>
                        <table>
                            <tr>
                                <th>Nome Completo</th>
                                <th>Número (WhatsApp)</th>
                                <th>Aluno associado</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            while ($dados = mysqli_fetch_assoc($resultadoLista)) {
                                $numLinhasImpressas++;
                                $telefoneProWhats = preg_replace('/\D/', '', $dados['telefone']);
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $dados['nome']; ?>
                                    </td>
                                    <td><?php echo '<a target="blank" href="https://wa.me/' . $telefoneProWhats . '">' . $dados['telefone'] . '</a>'; ?></td>
                                    <td>
                                        <?php //ficou um padrão
                                        $idAluno = "SELECT nome, arquivado FROM aluno WHERE id =" . $dados['id_aluno'];
                                        $buscaAluno = mysqli_query($conn, $idAluno);
                                        if (mysqli_num_rows($buscaAluno) > 0) {
                                            $dadosAluno = mysqli_fetch_assoc($buscaAluno);
                                		if($dadosAluno['arquivado'] == 1) {
                                            $nomeAluno = '<span style="color: #FF7A2A;">' . $dadosAluno['nome'] . '</span>';
                                        } else {
                                            $nomeAluno = $dadosAluno['nome'];
                                        }
                                		
                                		echo $nomeAluno;                                            
                                        } else {
                                            echo '<span style="color:red;">Nenhum aluno associado!</span>';
                                        }
                                

                                        ?>
                                    </td>
                                    <td class="acoes">
                                        <a class="botaoTable" href="editarResponsavel.php?id_resp=<?php echo $dados['id']; ?>">
                                            <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <button class="botaoTable_excluir botaoAbrir" data-id="<?php echo $dados['id']; ?>"> Arquivar <i class="fa-solid fa-box-archive"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </table>

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
                            <a href="inicio.php"><button class="botaoDialog">Voltar para a página inicial</button></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- CAIXA DE ALERTA AO CLICAR NO BOTÃO DE EXCLUIR -->
            <!-- odeio mexer nisso -->
            <dialog id="modal">
                <h2 class="h2Dialog">Enviar à Lixeira?</h2>
                <h4 class="pDialog">O Responsável selecionado será enviado à Lixeira. Você pode reverter essa ação.</h4>
                <h4 class="pDialog">Tem certeza?</h4>
                <div class="botoesDialog">
                    <button id="cancelar">Cancelar</button>
                    <button id="excluir">Arquivar</button>
                </div>
            </dialog>

            <!-- confirma se quer realmente mandar tudo pra lixeira -->
            <dialog id="modalArquivarTudo">
                <h2 class="h2Dialog">Enviar TODOS à Lixeira?</h2>
                <h4 class="pDialog">Todos os Responsáveis cadastrados serão enviados à Lixeira. Você pode reverter essa ação.</h4>
                <h4 class="pDialog">Tem certeza?</h4>
                <div class="botoesDialog">
                    <button id="fecharPerguntaArquivarTudo">Cancelar</button>
                    <button class="botaoTable_excluir" id="arquivarTudo">Arquivar tudo</button>
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

        window.location.href = "../source/F_arquivarResponsavel.php?idResp=" + idResp;

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
        window.location.href = "../source/F_arquivarTudo.php?tipo=responsaveis&acao=1";

    });

  const input = document.getElementById('whatsapp');

  input.addEventListener('input', function (e) {
    let valor = e.target.value.replace(/\D/g, ''); // Remove tudo que não for dígito
    
    if (valor.length > 11) {
      valor = valor.slice(0, 11); // Limita a 11 dígitos máximos
    }

    // Aplica a formatação do WhatsApp (XX) 9XXXX-XXXX
    if (valor.length > 10) {
      // Celular com 9 dígitos: (XX) 9XXXX-XXXX
      valor = valor.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
    } else if (valor.length > 5) {
      // Formatação parcial enquanto digita
      valor = valor.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
    } else if (valor.length > 2) {
      valor = valor.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
    } else if (valor.length > 0) {
      valor = valor.replace(/^(\d*)/, '($1');
    }

    e.target.value = valor;
  });
</script>

</html>