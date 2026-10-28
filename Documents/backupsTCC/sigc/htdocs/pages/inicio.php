<?php
include "../controller/conecta.php";
include "../source/F_frasesAleatorias.php";
session_start();

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

//verificar se tá na última semana, aí mostra o alerta na tela pra não esquecer de baixar a lista - 100% eu
$mostrarAvisoPdfPagamentos = false;
$ultimoDia = date('t');
$hoje = date('d');
if($hoje == $ultimoDia OR ($ultimoDia - $hoje) <= 7){
    $mostrarAvisoPdfPagamentos = true;
} else {
    $mostrarAvisoPdfPagamentos = false;
}


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


$fraseEscolhida = escolherFrase();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGC - Dashboard</title>
    <?php
    include "../source/verStyle.php";
    $tema = buscarTema($id);
    ?>
    <link rel="stylesheet" href="../styles/style_CLOUDE.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../images/logoCoter.png" type="image/x-icon">
</head>

<body data-theme='<?php echo $tema ?>'>
    <input type="checkbox" id="menu-toggle" style="display: none;">

    <header>
        <h1>Sistema Integrado de Gestão COTER - S.I.G.C</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>

    <?php 
    include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); 
    ?>

    <label for="menu-toggle" class="menu-overlay"></label>

    <div class="main-wrapper">
        <div class="welcome-section">
            <h2>Olá, <span><?php echo htmlspecialchars($dadosAdmin['nome']); ?></span>!</h2>
            <p><?php echo $fraseEscolhida; ?></p>
        </div>
        

        <div class="card">
            <div class="card-header" style="text-align: center;">
            	<button onclick="location.href='cadastrarResponsavel.php'">
                    <i class="fa-solid fa-user-tie"></i><span class="anderlineInvisivel">_</span>Cadastrar Responsável
                </button>

                <button onclick="location.href='cadastrarAluno.php'">
                    <i class="fa-solid fa-user-graduate"></i><span class="anderlineInvisivel">_</span>Cadastrar Aluno
                </button>

                <button onclick="location.href='listarMensalidades.php?abrirJanelaCadastro=sim'">
                    <i class="fa-solid fa-file-invoice-dollar"></i><span class="anderlineInvisivel">_</span>Cadastrar Mensalidade
                </button>
            </div>
        </div>
        <hr>
        
        
        <?php 
        	
       	//if(true) {
        if($mostrarAvisoPdfPagamentos) {
        $faltamDias = $ultimoDia - $hoje;
        ?>
        <br>
        <div class="card">
            <div class="card-header  texto-animado">Faltam apenas <?php echo $faltamDias; ?> dias para fechar o mês!</div>
            <div class="card-body" style="text-align: center;">

                <h3 class="h2Dialog">Baixe a lista de Devedores!</h3>
                
                <div style="text-align: left;">
                    <p>O SIGC não consegue "acordar" ao virar o mês e baixar automaticamente.</p>
                    <p>Salve as informações dos devedores pois, diferente dos pagamentos atrasados, o sistema ainda não consegue saber quem não pagou nos meses anteriores!</p>
                </div>
                <hr>
                <label>
                    <a href="../source/F_gerarPDF.php?qualPdf=listaDevedores">
                		<button><i class="fa-solid fa-user-tie"></i><span class="anderlineInvisivel">_</span>Gerar lista de pendências</button>
                    </a>
                </label>
            </div>
        </div>            
        <?php } ?>

        
        <?php
        	include "conecta.php";
        	$sql2 = "SELECT * FROM aluno WHERE estagiando = 1 AND id_pelotao != 1 AND arquivado = 0";
        	$resultado2 = mysqli_query($conn, $sql2);
        	if(mysqli_num_rows($resultado2) > 0) { ?>
        		<br>
                <div class="card">
                    <div class="card-header">Farçante!</div>
                    <div class="card-body" style="text-align: center;">
                        <h3 class="h2Dialog">Há uma incoerência na lista de estagiários:</h3>
                        <p>O(s) seguinte(s) aluno(s) listado(s) abaixo está(ão) em estágio enquanto NÃO faz(em) parte do pelotão COBRA (TCM)! <br>
                            <a style="color: rgb(31, 136, 223)" href="listarEstagiario.php">Clique aqui para ir corrigir</a>.</p>
                        <br>
                        <fieldset class="radio-group">
                        <?php 
                			echo "<ul>";
                			while($alunosIncoerentes = mysqli_fetch_assoc($resultado2)) {
                                echo '<li>'. $alunosIncoerentes['nome'] .'</li>';
                            }
                			echo "</ul>";
                		?>
                        </fieldset>
                    </div>
                </div>
		<?php } ?>
        
        <?php 
            if ($podeMostrarRecomendacao) { ?>
        <br>
        	<div class="card">
                <div class="card-header">
                	Configurações iniciais
                </div>
                <div class="card-body">
                    <div class="bloco-nota">
                        <h3>Não quer digitar o valor da mensalidade sempre? Deixe que o sistema faça isso sozinho! </h3>
                        <p>Clique em "Definir Valor" e configure o valor atual da mensalidade do COTER.</div>
                        <br>
                        <label><a href="configuracoesUser.php"><button type="button">Definir valor</button></a></label>
                    </div>
                </div>
            </div>
            <?php } ?>

    </div>

</body>

</html>