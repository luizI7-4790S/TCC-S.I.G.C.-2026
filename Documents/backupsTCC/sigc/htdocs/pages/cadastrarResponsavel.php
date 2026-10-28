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

$sqlAlunos = "SELECT * FROM aluno WHERE arquivado = 0 ORDER BY nome";
$resultadoAlunos = mysqli_query($conn, $sqlAlunos);
if (mysqli_num_rows($resultadoAlunos) == 0) {
    echo '<h1 style="color:red;">Nenhum aluno cadastrado!</h1>';
} else {
    print "Houve um erro interno... :(";
}

if ($_POST) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $alunoSubordinado = $_POST['alunoSubordinado'];

    $sql = "INSERT INTO responsavel (nome, telefone, id_aluno) VALUES ('$nome', '$telefone', '$alunoSubordinado')";
    $resultados = mysqli_query($conn, $sql);

    header("Location:listarResponsaveis.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S.I.G.C.</title>
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

    <form method="POST" action="">
        <div class="main-wrapper">
            <div class="content">
                <div class="card">
                    <div class="card-header">Informe as credenciais do novo Responsável</div>
                    <div class="card-body">
                        <label>
                            <p>Nome completo:<br><input type="text" name="nome" required></p>
                        </label>
                        <label>
                            <p>Número de telefone (WhatsApp): <br><input type="text" name="telefone" required></p>
                        </label>
                        <label>
                            <p>Aluno subordinado:<br>
                                <select name="alunoSubordinado">
                                    <option> Selecione </option>
                                    <?php
                                    while ($dadosAluno = mysqli_fetch_assoc($resultadoAlunos)) {
                                        echo '<option value=' . $dadosAluno['id'] . '> ' . $dadosAluno['nome'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </p>
                        </label>
                        <input type="submit" value="Cadastrar">
                        <br>
                    </div>
                </div>
            </div>
    </form>

</body>

</html>