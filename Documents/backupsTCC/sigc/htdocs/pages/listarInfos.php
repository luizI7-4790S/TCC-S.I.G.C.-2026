<?php
session_start();
$id = $_SESSION['id'];
include "conecta.php";

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

$sqlLista = "SELECT a.*, r.nome as nome_Resp, r.arquivado as respArquivado FROM aluno a INNER JOIN responsavel r ON a.id = r.id_aluno WHERE a.arquivado = 0 ORDER BY a.nome;";
//WHERE a.arquivado = 0 AND r.arquivado = 0 

$resultadoLista = mysqli_query($conn, $sqlLista);
?>

<!DOCTYPE html>
<html lang="pt-br">

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
        <label for="menu-toggle" class="hamburger">&#9776;</label>
        <h1>Alunos</h1>
    </header>
    <?php include "imprimirSidebar.php";
    echo imprimirSidebar(); ?>

    
    <!-- responsável -->
    <?php
    	$idResp = $_GET['idResp'];
    	$sqlLista = "SELECT * FROM responsavel WHERE id = '$idResp'";
    	$resultadoResp = mysqli_query($conn, $sql);
    	
    	if(mysqli_num_rows($resultadoLista) > 0) { 
    		$dadosResp = mysqli_fetch_assoc($resultadoResp);
            $nomeResp = explode(" ", $dadosResp['nome']);
    ?>
            <div class="main-wrapper">
                <div class="card">
                    <div class="card-header"> Informações de <?php echo $nomeResp[0]; ?> </div>
                    <div class="card-body">
                        <fieldset>
                            <h3>Nome completo: <?php echo $dadosResp['nome']; ?></h3>
                            <br>
                            <h3>Número (WhatsApp): <?php echo $dadosResp['telefone']; ?></h3>
                        </fieldset>
                    </div>
                </div>
            </div>
       <?php } else { echo "aaaa<hr>aaaa<hr>aaaa<hr>aaaa<hr>aaaa<hr>aaaa<hr>aaaa<hr>"; ?>
            
       <?php } ?>
    

<!-- aluno 
        <?php
    	$idResp = $_GET['idResp'];
    	$sqlLista = "SELECT * FROM responsavel WHERE id = '$idResp'";
    	$resultadoResp = mysqli_query($conn, $sql);
    	if(mysqli_num_rows($resultadoLista) > 0) { ?>
            <div class="main-wrapper">
                <div class="card">
                    <div class="card-header"> Informações de  </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
       <?php } else { ?>
            
       <?php } ?>

    -->
    
    
    
    
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

        window.location.href = "F_arquivarAluno.php?idAluno=" + idAluno;

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
        window.location.href = "F_arquivarTudo.php?tipo=alunos&acao=1";

    });
</script>
</html>