<?php
session_start();
$id = $_SESSION['id'];
include "../controller/conecta.php";

//configurações

$ultimoDia = date('t');
//90% feito à mão
$mesAtual = date('m');
$anoAtual = date('Y');
$qtdMensalidades = 0;
$sqlMensalidades = "SELECT COUNT(id) AS idsMensalidades, SUM(valor_pago) AS somaMensalidades FROM mensalidade WHERE arquivado = 0 
AND MONTH(mensalidade.data_pagamento) = '$mesAtual' 
AND YEAR(mensalidade.data_pagamento) = '$anoAtual'";
$resultadoMensal = mysqli_query($conn, $sqlMensalidades); 

$mensalidades = mysqli_fetch_assoc($resultadoMensal); //pelo o que eu vi, se não existir nada no banco, o COUNT retorna NULL ou algo semelhante. Com isso, o sistema conta como 1
//pra evitar esse problema, coloquei -1 na variável

//variável que conta quantos alunos existem para por nas informações do mês
$sqlAlunosQTD = "SELECT COUNT(id) AS qtdAlunos FROM aluno WHERE arquivado = 0";
$resultadoAlunosQTD = mysqli_query($conn, $sqlAlunosQTD); 

$quantiaAlunos = mysqli_fetch_assoc($resultadoAlunosQTD);


function converterMesTexto($data) {
	//pra separar a data
    $data2 = explode('-', $data);
    
    $mes = $data2[1];
    
    if($mes == 1){$mesPorExtenso = "Janeiro";}
    else if($mes == 2){$mesPorExtenso = "Fevereiro";}
    else if($mes == 3){$mesPorExtenso = "Março";}
    else if($mes == 4){$mesPorExtenso = "Abril";}
    else if($mes == 5){$mesPorExtenso = "Maio";}
    else if($mes == 6){$mesPorExtenso = "Junho";}
    else if($mes == 7){$mesPorExtenso = "Julho";}
    else if($mes == 8){$mesPorExtenso = "Agosto";}
    else if($mes == 9){$mesPorExtenso = "Setembro";}
    else if($mes == 10){$mesPorExtenso = "Outubro";}
    else if($mes == 11){$mesPorExtenso = "Novembro";}
    else if($mes == 12){$mesPorExtenso = "Dezembro";}
    //casa 2 do vetor porque a data no sql guardada é ANO-MES-DIA
    return $data2[2] . " de " . $mesPorExtenso . " de " . $data2[0];
}


//fim das configurações
?>
<!DOCTYPE html>
<html lang="en">
<script src="F_rolarTelaPraLista.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensalidades</title>
    <?php
    include "../source/verStyle.php";
    $tema = buscarTema($id);
    ?>
    <link rel="stylesheet" href="../styles/style_CLOUDE.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../images/logoCoter.png" type="image/x-icon">
</head>
    
    
<!-- colocando o dialog aqui em cima pra eu poder usar variáveis dele no resto da página -->    
    
<dialog id="modalNaoPagou" style="max-width:1300px;width:90%;">
    <div class="card-header" style="border-radius: 5px;">Alunos que não acertaram a mensalidade de <?php echo date('m-Y'); ?>
        <br><br>
        <button type="button" id="fecharNaoPagou"><i class="fa-solid fa-circle-xmark"></i> Fechar Lista </button>
        <label>
            <a href="../source/F_gerarPDF.php?qualPdf=listaDevedores">
                <button type="button" id="abrirPerguntaArquivarTudo">
                    <i class="fa-solid fa-file-pdf"></i>Baixar lista
                </button>
            </a>
        </label>
    </div>
    <div class="card-body">
        <?php
        include "../controller/conecta.php"; // gemini deu uma dica: usar LEFT JOIN no resp e pelotão para: caso o aluno não tiver um resp
        // ou um pelotão, mostrar mesmo assim!
        $mesAtual = date('m');
        $anoAtual = date('Y');
        $sqlNaopagou = "SELECT aluno.id AS aluno_id, aluno.nome, responsavel.nome AS responsavel_nome, responsavel.telefone AS respTelefone,
                pelotao.id AS pelotao_id 
                                FROM aluno
                                LEFT JOIN responsavel ON responsavel.id_aluno = aluno.id
                                LEFT JOIN pelotao ON pelotao.id = aluno.id_pelotao
                                LEFT JOIN mensalidade ON mensalidade.id_aluno = aluno.id 
                                    AND MONTH(mensalidade.data_pagamento) = $mesAtual 
                                    AND YEAR(mensalidade.data_pagamento) = $anoAtual 
                                    AND mensalidade.arquivado = 0 
                                WHERE mensalidade.id IS NULL AND aluno.arquivado = 0 
                                ORDER BY aluno.nome;";
        $resultadoNaopago = mysqli_query($conn, $sqlNaopagou);
        if (mysqli_num_rows($resultadoNaopago) > 0) {
            echo '<table>
                        <th>Aluno</th>
                        <th>Pelotão</th>
                        <th>Responsável</th>
                        <th>Telefone Resp</th>';
            // <!-- ===================================================== -->
            $quantidadeDevedores = 0; //variável pra eu por no botão de devedores e nas informações do mês
            while ($pesquisaNaoPagou = mysqli_fetch_assoc($resultadoNaopago)) {
                $quantidadeDevedores++;
                
                //descobri uma forma de formatar string de telefone em número:
                $numeroProLinkWhats = preg_replace('/\D/', '', $pesquisaNaoPagou['respTelefone']);
        ?>
        <tr>
            <td><?php echo $pesquisaNaoPagou['nome']; ?></td>
            <td><?php if($pesquisaNaoPagou['pelotao_id'] == 1){echo "Cobra";}else if($pesquisaNaoPagou['pelotao_id'] == 2){echo "Águia";}
                else if($pesquisaNaoPagou['pelotao_id'] == 3){echo "Tigre";}else if($pesquisaNaoPagou['pelotao_id'] == 4){echo "Leão";}else if($pesquisaNaoPagou['pelotao_id'] == 5){echo "Falcão";}; ?></td>
            <td><?php echo $pesquisaNaoPagou['responsavel_nome']; ?></td>
            <td><?php echo '<a target="blank" href="https://wa.me/' . $numeroProLinkWhats . '">' . $pesquisaNaoPagou['respTelefone'] . '</a>'; ?></td>
        </tr>
        <?php } ?>
        </table>
    <?php } else { ?>
    <h2 class="h2Dialog">Lista vazia! <i class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146);"></i>
    </h2>
    <h4 class="pDialog">Nenhum pagamento está pendente!🙏</h4>
    <?php }
    ?>
    </div>
</dialog>
    
    
    
    
<body data-theme='<?php echo $tema ?>'>
    <!-- 1. OBRIGATÓRIO: O controle do menu fica no topo do body para o CSS funcionar -->
    <input type="checkbox" id="menu-toggle" style="display: none;">

    <header>
        <!-- 2. O label aponta para o ID do input acima -->
        <h1>Mensalidades</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>
    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>
    <div class="main-wrapper">
        <div class="card-header" style="border-radius:5px;">
            <button type="button" id="abrirCadastro">
                <i class="fa-solid fa-id-card"></i>Cadastrar Mensalidade
            </button>

            <button type="button" id="abrirNaoPagou">
                <i class="fa-solid fa-user-slash"></i>Lista de devedores (<?php echo $quantidadeDevedores; ?>)
            </button>
        </div>
        <hr>
        
        <div class="bloco-nota" style="border-radius:5px;">
            <h2 class="h2Dialog">Informações do mês</h2>
            <ul> <!-- 100% na mão -->
            	<li>Pagamentos registrados: <strong><?php echo $mensalidades['idsMensalidades'] ?? 0; ?></strong></li>
                <li>Valor arrecadado: <strong>R$<?php echo $mensalidades['somaMensalidades'] ?? 0; ?></strong></li>
                <li>Pagamentos restantes: <strong><?php echo $quantidadeDevedores . "/" . $quantiaAlunos['qtdAlunos']; ?></strong></li>
            </ul>
        </div>
        <br>
        
        <!-- dialog do form de cadastro -->
        <dialog id="modalCadastro" style="max-width:900px;width:90%;">

            <div class="card-header" style="border-radius: 5px;">
                <button type="button" id="fecharCadastro">
                    Fechar Formulário
                </button>
            </div>

            <div class="card-body">

                <div class="card-body">
                    <form action="../source/F_cadastrarMensalidade.php" method="POST">

                        <?php
                        $mesAtual = date('Y-m-d');
                        $segundoSabadoDesseMes = date('d-m-Y', strtotime('second saturday of ' . $mesAtual));
                        $exatamenteHoje = date('d');
						$somar10NoValor = false; //se passou o segundo sábado, dá um acréscimo de 10 pila no autocomplete do campo valor
                        if ($exatamenteHoje > $segundoSabadoDesseMes) { 
                        	$somar10NoValor = true;
                        ?>
                            <div class="bloco-msgAlerta">
                                <p>O segundo sábado já passou (<?php echo $segundoSabadoDesseMes; ?>)!</p>
                                <p>Mensalidades cadastradas serão consideradas <strong>ATRASADAS</strong>.</p>
                                <hr>
                                <p>Adicionado <strong>acréscimo de R$10</strong>. Você pode alterar no campo abaixo</p>

                            </div>
                        <?php } else { ?>
                            <div class="bloco-msgBoa">
                                <p>Viva, ainda dá tempo de receber descontos!</p>
                                <p>Mensalidades cadastradas antes de <?php echo $segundoSabadoDesseMes; ?> serão
                                    consideradas
                                    <strong>EM DIA</strong>.
                                </p>
                            </div>
                        <?php } ?>

                        <label>
                            <p>Efetuado em:</p>
                            <input type="date" name="data" value="<?php echo date('Y-m-d'); ?>" required>
                        </label>
                        <?php
                        include '../controller/conecta.php';
                        $podeMostrarRecomendacao = false;
                        $sql = "SELECT valorPadraoMensalidade FROM definicoes";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $dados = mysqli_fetch_assoc($result);
                            $valorPadrao = $dados['valorPadraoMensalidade'];
                            if($valorPadrao == 0) { //coloquei pra mostrar a dica quando nuna se foi configurado e também quando foi definido 0
                                $podeMostrarRecomendacao = true;
                            }
                            
                        } else {
                            $valorPadrao = "0";
                            $podeMostrarRecomendacao = true;
                        }

                        if ($podeMostrarRecomendacao) { ?>
                            <div class="bloco-nota">
                                <h3>Dica:</h3>
                                <p>Percebe-se que não configurou ainda. Você pode definir um valor para preencher
                                    automaticamente o valor da mensalidade.</p>
                                <br>
                                <label><a href="configuracoesUser.php"><button type="button">Definir valor</button></a></label>
                            </div>
                        <?php } ?>
                        <label>
                            <p>Valor:</p>
                            <input type="number" name="valor" value="<?php if($somar10NoValor == true) {echo $valorPadrao + 10;} else {echo $valorPadrao;} ?>" step="0.01" required>
                        </label>
                        <label>
                            <p>Aluno:</p>
                            <select name="aluno" required>
                                <option value="" disabled selected>Selecione um aluno</option>
                                <?php
                                include '../controller/conecta.php';
                                $sql = "SELECT * FROM aluno WHERE arquivado = 0 ORDER BY nome";
                                $result = mysqli_query($conn, $sql);
                                while ($dadosAluno = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $dadosAluno['id'] . '">'. $dadosAluno['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </label>

                        <label>
                            <p>Metodo de pagamento:<p>
                            <fieldset class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="metodo_pagamento" value="Dinheiro" class="radio-input">
                                    Dinheiro
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="metodo_pagamento" value="Pix" class="radio-input"> Pix
                                </label>
                            </fieldset>
                        </label>


                        <label>
                            <p>Observação:</p>
                            <textarea name="observacao" rows="6" cols="50"
                                placeholder='Deixe uma mensagem nesse pagamento. Exemplo: "Pago no pix por Fulano"..'></textarea>
                        </label>
                        <hr>
                        <input type="submit" value="Registrar" class="btn-salvar">
                    </form>
                </div>

            </div>
        </dialog>


        <details open>
            <summary>Abrir/Fechar PESQUISA</summary>
            	<br>
                <form action="" method="POST">
                            <input type="date" name="dataPesquisaMensalidades" value='<?php echo date("Y-m-d"); ?>'>
                            <br><br>
                            <select name="filtroPesquisaMensalidades">
                                <option value="mostrar_tudo">Todas</option>
                                <option value="normal">Em dia</option>
                                <option value="atrasado">Atrasadas</option>
                            </select>
                            <br>
                            <fieldset class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="formaPagamento" value="PIX">PIX</label>
                            <label class="radio-label">
                                <input type="radio" name="formaPagamento" value="Dinheiro">Dinheiro</label>
                            <label class="radio-label">
                                <input type="radio" name="formaPagamento" value="mostrarTudo">Ambos</label>
                            </fieldset>
                    	<input type="submit" value="Filtrar"> <label><a href="listarMensalidades.php"><button>Limpar</button></a></label>
                </form>
            </details>
        
        <br>
        
        <div class="card">
            <div class="card-header">LISTA DE MENSALIDADES</div>
                <div class="card-body">
                    <?php
                    include '../controller/conecta.php';

                    $dataPesquisa = $_POST['dataPesquisaMensalidades'] ?? date('Y-m-d'); // essas ?? são pra, se for postado, atribui, se não pega a data atual
                    $filtro = $_POST['filtroPesquisaMensalidades'] ?? 'mostrar_tudo'; //foi bizu do chat
                    $formaPagamento = $_POST['formaPagamento'] ?? "mostrarTudo";

                    $mesPesquisa = date('m', strtotime($dataPesquisa));
                    $anoPesquisa = date('Y', strtotime($dataPesquisa));
                    if ($filtro == 'mostrar_tudo' AND $formaPagamento == "mostrarTudo") {

                        $sql = "SELECT 
                                    mensalidade.id,
                                    mensalidade.data_pagamento,
                                    mensalidade.valor_pago,
                                    mensalidade.observacao,
                                    mensalidade.id_aluno,
                                    mensalidade.metodo_pagamento,
                                    aluno.nome
                                FROM mensalidade
                                INNER JOIN aluno 
                                    ON aluno.id = mensalidade.id_aluno
                                WHERE mensalidade.arquivado = 0
                                AND MONTH(mensalidade.data_pagamento) = '$mesPesquisa'
                                AND YEAR(mensalidade.data_pagamento) = '$anoPesquisa'
                                ORDER BY mensalidade.data_pagamento DESC";
                        
                    } else if ($filtro == 'normal' AND $formaPagamento == "mostrarTudo") {

                        // Pagamentos realizados dentro do prazo
                        $sql = "SELECT 
                                    mensalidade.id,
                                    mensalidade.data_pagamento,
                                    mensalidade.valor_pago,
                                    mensalidade.observacao,
                                    mensalidade.id_aluno,
                                    mensalidade.metodo_pagamento,
                                    aluno.nome
                                FROM mensalidade
                                INNER JOIN aluno 
                                    ON aluno.id = mensalidade.id_aluno
                                WHERE mensalidade.atrasado = 0
                                AND mensalidade.arquivado = 0
                                AND MONTH(mensalidade.data_pagamento) = '$mesPesquisa'
                                AND YEAR(mensalidade.data_pagamento) = '$anoPesquisa'
                                ORDER BY mensalidade.data_pagamento DESC";
                    } else if ($filtro == 'atrasado' AND $formaPagamento == "mostrarTudo") {

                        // Pagamentos realizados depois do prazo
                        $sql = "SELECT 
                                    mensalidade.id,
                                    mensalidade.data_pagamento,
                                    mensalidade.valor_pago,
                                    mensalidade.observacao,
                                    mensalidade.id_aluno,
                                    mensalidade.metodo_pagamento,
                                    aluno.nome
                                FROM mensalidade
                                INNER JOIN aluno 
                                    ON aluno.id = mensalidade.id_aluno
                                WHERE mensalidade.atrasado = 1
                                AND mensalidade.arquivado = 0
                                AND MONTH(mensalidade.data_pagamento) = '$mesPesquisa'
                                AND YEAR(mensalidade.data_pagamento) = '$anoPesquisa'
                                ORDER BY mensalidade.data_pagamento DESC";
                    }
                    
                    //aqui são os casos de filtro por método
                    
                    else if ($filtro == 'mostrar_tudo' AND $formaPagamento == "PIX" OR $filtro == 'mostrar_tudo' AND $formaPagamento == "Dinheiro") {
			
                        // Pagamentos realizados depois do prazo
                        $sql = "SELECT 
                                    mensalidade.id,
                                    mensalidade.data_pagamento,
                                    mensalidade.valor_pago,
                                    mensalidade.observacao,
                                    mensalidade.id_aluno,
                                    mensalidade.metodo_pagamento,
                                    aluno.nome
                                FROM mensalidade
                                INNER JOIN aluno 
                                    ON aluno.id = mensalidade.id_aluno
                                WHERE mensalidade.atrasado = 0
                                AND mensalidade.arquivado = 0
                                AND MONTH(mensalidade.data_pagamento) = '$mesPesquisa'
                                AND YEAR(mensalidade.data_pagamento) = '$anoPesquisa'
                                AND mensalidade.metodo_pagamento = '$formaPagamento' 
                                ORDER BY mensalidade.data_pagamento DESC";
                    } else if ($filtro == 'normal' AND $formaPagamento == "PIX" OR $filtro == 'normal' AND $formaPagamento == "Dinheiro") {
			
                        // Pagamentos realizados depois do prazo
                        $sql = "SELECT 
                                    mensalidade.id,
                                    mensalidade.data_pagamento,
                                    mensalidade.valor_pago,
                                    mensalidade.observacao,
                                    mensalidade.id_aluno,
                                    mensalidade.metodo_pagamento,
                                    aluno.nome
                                FROM mensalidade
                                INNER JOIN aluno 
                                    ON aluno.id = mensalidade.id_aluno
                                WHERE mensalidade.atrasado = 0
                                AND mensalidade.arquivado = 0
                                AND MONTH(mensalidade.data_pagamento) = '$mesPesquisa'
                                AND YEAR(mensalidade.data_pagamento) = '$anoPesquisa'
                                AND mensalidade.metodo_pagamento = '$formaPagamento' 
                                ORDER BY mensalidade.data_pagamento DESC";
                    } else if ($filtro == 'atrasado' AND $formaPagamento == "PIX" OR $filtro == 'atrasado' AND $formaPagamento == "Dinheiro") {

                        // Pagamentos realizados depois do prazo
                        $sql = "SELECT 
                                    mensalidade.id,
                                    mensalidade.data_pagamento,
                                    mensalidade.valor_pago,
                                    mensalidade.observacao,
                                    mensalidade.id_aluno,
                                    mensalidade.metodo_pagamento,
                                    aluno.nome
                                FROM mensalidade
                                INNER JOIN aluno 
                                    ON aluno.id = mensalidade.id_aluno
                                WHERE mensalidade.atrasado = 1
                                AND mensalidade.arquivado = 0
                                AND MONTH(mensalidade.data_pagamento) = '$mesPesquisa'
                                AND YEAR(mensalidade.data_pagamento) = '$anoPesquisa'
                                AND mensalidade.metodo_pagamento = '$formaPagamento' 
                                ORDER BY mensalidade.data_pagamento DESC";
                    }

                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("houve um erro interno...: " . mysqli_error($conn));
                    }
                    

					if(mysqli_num_rows($result) > 0) {
                    echo '<table>';
                    echo '<tr><th>Data</th><th>Valor</th><th>Aluno</th><th>Método</th><th>Observação</th><th>Ações</th></tr>';
                    while ($dadosMensalidade = mysqli_fetch_assoc($result)) {

                        //(ideia do chat) isso aqui é só pra 
                        if ($dadosMensalidade['data_pagamento'] == NULL) {
                            $data_pagamento = '<span style="color: red;">Erro: não informado</span>';
                        } else {
                            $data_pagamento = $dadosMensalidade["data_pagamento"];
                            $dataConvertida = converterMesTexto($data_pagamento);
                        }


                        $valor = number_format($dadosMensalidade['valor_pago'], 2, ',', '.');
                        $id_aluno = $dadosMensalidade['id_aluno'];

                        $sqlAluno = "SELECT nome FROM aluno WHERE id = '$id_aluno'";
                        $resultAluno = mysqli_query($conn, $sqlAluno);
                        $dadosAluno = mysqli_fetch_assoc($resultAluno);
                    ?>
                        <tr>
                            <td><?php echo $dataConvertida; ?></td>
                            <td>R$ <?php echo $valor ? $valor : '<span style="color:red;">Erro: não informado</span>'; ?></td>
                            <td><?php echo $dadosAluno ? $dadosAluno['nome'] : '<span style="color:red;">Nenhum aluno (erro inesperado)</span>'; ?>
                            </td>
                            <td><?php echo $dadosMensalidade ? $dadosMensalidade['metodo_pagamento'] : '<span style="color:red;">Erro: não informado</span>'; ?>
                            </td>
                            <td><?php echo ($dadosMensalidade['observacao'] != '') ? $dadosMensalidade['observacao'] : 'N/A'; ?>
                            </td>
                            <td class="acoes">
                                <a class="botaoTable"
                                    href="editarMensalidade.php?id_mensalidade=<?php echo $dadosMensalidade['id']; ?>">
                                    <button type="button" class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </a>
                                <button type="button" class="botaoTable_excluir botaoAbrir" data-id="<?php echo $dadosMensalidade['id']; ?>">
                                    Arquivar <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    <?php }
                    echo '</table>
                    	</div>
                        </form>';
                    } else { ?>
                                <h2 class="h2Dialog">Nenhum cadastro encontrado! <i class="fa-solid fa-triangle-exclamation"
                                        style="color: rgb(0, 107, 146);"></i></h2>
                                <h4 class="pDialog">Não há nada no cofrinho, ainda..!</h4>
                                <h4 class="pDialog">Registre um novo pagamento de mensalidade e, após isso, você poderá
                                    visualizá-lo aqui.</h4>
                            
                    <?php } ?>
                    
                    
        </div>
                      
		
    </div>

    </div>


    <!-- CAIXA DE ALERTA AO CLICAR NO BOTÃO DE EXCLUIR -->
    <!-- odeio mexer nisso -->
    <dialog id="modal">
        <h2 class="h2Dialog">Mover? <i class="fa-solid fa-triangle-exclamation"
                style="color: rgb(0, 107, 146);"></i></h2>
        <h4 class="pDialog">A mensalidade selecionada será enviada à Lixeira. Você pode reverter essa ação.</h4>
        <div class="botoesDialog">
            <button id="cancelar">Cancelar</button>
            <button id="excluir">Enviar à Lixeira</button>
        </div>
    </dialog>


<!-- LISTA DE QUEM AINDA NÃO PAGOU  -->




</body>
<script>
    // nunca mais quero mexer nisso
    const modal = document.getElementById('modal');
    const cancelar = document.getElementById('cancelar');
    const excluir = document.getElementById('excluir');

    let idMensalidade = null;

    document.querySelectorAll('.botaoAbrir').forEach(botao => {

        botao.addEventListener('click', () => {
            idMensalidade = botao.dataset.id;

            modal.showModal();
        });

    });

    cancelar.addEventListener('click', () => {
        modal.close();
    });

    excluir.addEventListener('click', () => {

        modal.close();

        window.location.href = "../source/F_arquivarMensalidade.php?idMensalidade=" + idMensalidade;

    });


    const modalCadastro = document.getElementById("modalCadastro"); //abrri popup do formulário

    document.getElementById("abrirCadastro").addEventListener("click", () => {
        modalCadastro.showModal();
    });

    document.getElementById("fecharCadastro").addEventListener("click", () => {
        modalCadastro.close();
    });


    const modalNaoPagou = document.getElementById("modalNaoPagou"); //abrir popup de quem não pagou ainda

    document.getElementById("abrirNaoPagou").addEventListener("click", () => {
        modalNaoPagou.showModal();
    });

    document.getElementById("fecharNaoPagou").addEventListener("click", () => {
        modalNaoPagou.close();
    });
</script>

</html>