<?php
session_start();
$id = $_SESSION['id'];
include "conecta.php"; 

$msg = '';
if ($_POST) {
    $nome = $_POST['nome'];
    $nome_guerra = $_POST['nome_guerra'];
    $numero = $_POST['numero'];
    $graduacao = $_POST['graduacao'];
    $id_pelotao = $_POST['id_pelotao'];
    $estagiando = $_POST['estagiando'];
    $monitor = $_POST['monitor'];

    $sql = "INSERT INTO aluno (nome, nome_guerra, numero, graduacao, id_pelotao, estagiando, monitor) VALUES ('$nome', '$nome_guerra', '$numero', '$graduacao', '$id_pelotao', '$estagiando', '$monitor')";
    $resultados = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $msg = "<div class='bloco-nota'>
                    <h3>Sucesso!</h3>
                    <p>Cadastro efetuado com sucesso.</p>
                </div>";
    } else {
        $msg = "<div class='bloco-nota' style='border-left-color: #d32f2f;'>
                    <h3 style='color: #d32f2f;'>Erro</h3>
                    <p style='color: #ef5350;'>Falha ao cadastrar. Tente novamente.</p>
                    <p style='color: #ef5350;'>Se persistir, tente recarregar a página.</p>
                </div>";
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
                <?php echo $msg; ?>
                <div class="card">
                    <div class="card-header">Informe as credenciais do novo Aluno</div>
                    <div class="card-body">
                        <label>
                            <p>Nome completo: <span style="color:red;">*</span><br><input type="text" name="nome" required></p>
                        </label>
                        <label>
                            <p>Nome de Guerra: <span style="color:red;">*</span><br><input type="text" name="nome_guerra" required></p>
                        </label>
                        <label>
                            <p>Número: <span style="color:red;">*</span><br><input type="text" name="numero" required></p>
                        </label>
                        <label>
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
                        </label>
                        <label>
                            <p>Pelotão:<br>
                                <select name="id_pelotao" required>
                                    <option value="" disabled selected></option>
                                    <option value="1">Cobra</option>
                                    <option value="2">Aguia</option>
                                    <option value="3">Leão</option>
                                    <option value="4">Tigre</option>
                                    <option value="5">Falcão</option>
                                </select>
                            </p>
                        </label>
                        <label>
                            <p>Em estágio?<br>
                            <fieldset class="radio-group">
                                <label class="radio-label" required>
                                    <input type="radio" name="estagiando" value="1" class="radio-input"> Sim
                                </label>
                                <label class="radio-label" required>
                                    <input type="radio" name="estagiando" value="0" class="radio-input"> Não
                                </label>
                            </fieldset>
                            </p>
                        </label>
                        <label>
                            <p>Formado Monitor?<br>
                            <fieldset class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="monitor" value="1" class="radio-input"> Sim
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="monitor" value="0" class="radio-input"> Não
                                </label>
                            </fieldset>
                        </label>
                        <hr>
                        <input type="submit" value="Cadastrar">
                        <br>
                    </div>
                </div>
            </div>
            </div>
    </form>

</body>

</html>