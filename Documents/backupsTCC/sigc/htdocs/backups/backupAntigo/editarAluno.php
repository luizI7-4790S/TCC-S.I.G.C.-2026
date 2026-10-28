<?php
session_start();
$id = $_SESSION['id'];
include "conecta.php";
$id_aluno = $_GET['id_aluno'];
$sqlAlunos = "SELECT * FROM aluno WHERE id = '$id_aluno'";
$dadosAluno = mysqli_query($conn, $sqlAlunos);
$resultado = mysqli_fetch_array($dadosAluno);
if (mysqli_num_rows($dadosAluno) == 0) {
    die('<h1 style="color:red;">Aluno não encontrado!</h1>');
}

if ($_POST) {
    $nome = $_POST['nome'];
    $nome_guerra = $_POST['nome_guerra'];
    $numero = $_POST['numero'];
    $graduacao = $_POST['graduacao'];
    $id_pelotao = $_POST['id_pelotao'];
    $estagiando = $_POST['estagiando'];
    $monitor = $_POST['monitor'];
    $id_aluno = $_POST['id_aluno'];

    $sql = "UPDATE aluno SET nome = '$nome', nome_guerra = '$nome_guerra', numero = '$numero', graduacao = '$graduacao', id_pelotao = '$id_pelotao', estagiando = '$estagiando', monitor = '$monitor' WHERE id = '$id_aluno'";

    $resultados = mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn) > 0) {
        header('Location: listarAlunos.php');   
    } else {
        echo "<alert>Houve um erro interno......</alert>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.I.G.C.</title>
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
    } else if ($_SESSION['tema'] == 'amareloClaro') { // AMARELO CLARO
        echo '<link rel="stylesheet" href="styleAmareloClaro.css">';
    } else { // PADRÃO
        echo '<link rel="stylesheet" href="styleVerdeClaro.css">';
    }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header>
        <h1>S.I.G.C</h1>
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

    <form method="POST" action="">
        <div class="main-wrapper">
            <div class="content">
                <div class="card">
                    <div class="card-header">Informe as credenciais do novo Aluno</div>
                    <div class="card-body">
                        <input type="hidden" name="id_aluno" value="<?php echo $id_aluno; ?>">
                        <label>
                            <p>Nome completo: <span style="color:red;">*</span><br><input type="text" name="nome" value="<?php echo $resultado['nome']; ?>" required></p>
                        </label>
                        <label>
                            <p>Nome de Guerra: <span style="color:red;">*</span><br><input type="text" name="nome_guerra" value="<?php echo $resultado['nome_guerra']; ?>" required></p>
                        </label>
                        <label>
                            <p>Número: <span style="color:red;">*</span><br><input type="number" name="numero" value="<?php echo $resultado['numero']; ?>" required></p>
                        </label>
                        <label>
                            <p>Graduação: (Graduação atual: "<span style="font-weight: bold;"><?php echo $resultado['graduacao']; ?></span>")<br>
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
                        </label>
                        <label>
                            <p>Pelotão: (Pelotão atual: "<span style="font-weight: bold;"><?php
                                    switch($resultado['id_pelotao']) {
                                        case 1: echo "Cobra";break;
                                        case 2: echo "Aguia";break;
                                        case 3: echo "Tigre";break;
                                        case 4: echo "Leão";break;
                                        case 5: echo "Falcão";break;
                                    }
                                ?>
                                </span>")<br>
                                <select name="id_pelotao" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">Cobra</option>
                                    <option value="2">Aguia</option>
                                    <option value="4">Leão</option>
                                    <option value="3">Tigre</option>
                                    <option value="5">Falcão</option>
                                </select>
                            </p>
                        </label>
                        <label>
                            <p>Em estágio? (Atualmente: "<span style="font-weight: bold;"><?php if($resultado['estagiando'] == 1){echo '<span>Sim</span>';} else {echo '<span>Não</span>';} ?></span>")<br>
                            <fieldset class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="estagiando" value="1" class="radio-input" required> Sim
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="estagiando" value="0" class="radio-input" required> Não
                                </label>
                            </fieldset>
                            </p>
                        </label>
                        <label>
                            <p>Formado Monitor? (Atualmente: "<span style="font-weight: bold;"><?php if($resultado['monitor'] == 1){echo '<span>Sim</span>';} else {echo '<span>Não</span>';} ?></span>")<br>
                            <fieldset class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="monitor" value="1" class="radio-input" required> Sim
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="monitor" value="0" class="radio-input" required> Não
                                </label>
                            </fieldset>
                        </label>
                        <hr>
                        <input type="submit" value="Alterar informações">
                        <label><a href="listarAlunos.php"><button type="button">Voltar</button></a></label>
                        <br>
                    </div>
                </div>
            </div>
    </form>

</body>

</html>