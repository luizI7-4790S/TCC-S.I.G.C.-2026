<?php
$id = $_SESSION['id'];
include "../controller/conecta.php";
session_start(); // descobri depois de um tempo que precisa chamar session_start() em todos arquivos
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
$msg = '';
if ($_POST) {
    $nome = $_POST['nome'];
    $nome_guerra = $_POST['nome_guerra'];
    $numero = $_POST['numero'];
    $graduacao = $_POST['graduacao'];
    $id_pelotao = $_POST['id_pelotao'];
    $estagiando = $_POST['estagiando'];
    $monitor = $_POST['monitor'];

    $sql = "INSERT INTO aluno (nome, nome_guerra, numero, graduacao, id_pelotao, estagiando, monitor) VALUES ('$nome', '$nome_guerra', $numero, '$graduacao', '$id_pelotao', '$estagiando', '$monitor')";
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
    <title>Cadastro de Aluno</title>
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

    <form method="POST" action="">
        <div class="main-wrapper">
            <div class="content">
                <?php echo $msg; ?>
                <div class="card">
                    <div class="card-header">Informe as credenciais do novo Aluno</div>
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
                                    <option value="3">Tigre</option>
                                    <option value="4">Leão</option>
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