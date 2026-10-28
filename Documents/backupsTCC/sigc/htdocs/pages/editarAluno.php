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


// Captura do ID via GET ou POST
$id_aluno = isset($_GET['id_aluno']) ? $_GET['id_aluno'] : (isset($_POST['id_aluno']) ? $_POST['id_aluno'] : null);

if ($_POST) {
    $nome        = mysqli_real_escape_string($conn, $_POST['nome']);
    $nome_guerra = mysqli_real_escape_string($conn, $_POST['nome_guerra']);
    $numero      = mysqli_real_escape_string($conn, $_POST['numero']);
    $graduacao   = mysqli_real_escape_string($conn, $_POST['graduacao']);
    $id_pelotao  = mysqli_real_escape_string($conn, $_POST['id_pelotao']);
    $estagiando  = mysqli_real_escape_string($conn, $_POST['estagiando']);
    $monitor     = mysqli_real_escape_string($conn, $_POST['monitor']);
    $id_aluno    = mysqli_real_escape_string($conn, $_POST['id_aluno']);

    $sql = "UPDATE aluno SET 
                nome = '$nome', 
                nome_guerra = '$nome_guerra', 
                numero = '$numero', 
                graduacao = '$graduacao', 
                id_pelotao = '$id_pelotao', 
                estagiando = '$estagiando', 
                monitor = '$monitor' 
            WHERE id = '$id_aluno'";

    $res = mysqli_query($conn, $sql);

    // CORREÇÃO: Testa se a consulta funcionou (mesmo se nada tiver sido alterado)
    if ($res) {
        header('Location: listarAlunos.php');
        exit();
    } else {
        echo "<script>alert('Erro no banco: " . mysqli_error($conn) . "');</script>";
    }
}

// Busca os dados atualizados para carregar no form
if ($id_aluno) {
    $sqlAlunos  = "SELECT * FROM aluno WHERE id = '$id_aluno'";
    $dadosAluno = mysqli_fetch_assoc(mysqli_query($conn, $sqlAlunos));
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
    <input type="checkbox" id="menu-toggle" style="display: none;">

    <header>
        <h1>Alunos</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>
    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>

    <form method="POST" action="">
        <div class="main-wrapper">
            <div class="content">
                <div class="card">
                    <div class="card-header">Editar informações do Aluno</div>
                    <div class="card-body">
                        <input type="hidden" name="id_aluno" value="<?php echo $id_aluno; ?>">

                        <label>
                            <p>Nome completo: <span style="color:red;">*</span><br>
                                <input type="text" name="nome" value="<?php echo $dadosAluno['nome'] ?? ''; ?>" required>
                            </p>
                        </label>

                        <label>
                            <p>Nome de Guerra: <span style="color:red;">*</span><br>
                                <input type="text" name="nome_guerra" value="<?php echo $dadosAluno['nome_guerra'] ?? ''; ?>" required>
                            </p>
                        </label>

                        <label>
                            <p>Número: <span style="color:red;">*</span><br>
                                <input type="number" max="9999" name="numero" value="<?php echo $dadosAluno['numero'] ?? ''; ?>" required>
                            </p>
                        </label>

                        <label>
                            <p>Graduação:
                                <select name="graduacao" required>
                                    <option value="<?php echo $dadosAluno['graduacao'] ?? ''; ?>" selected><?php echo $dadosAluno['graduacao'] ?? 'Selecione'; ?></option>
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
                            <?php
                            $pelotao = 'Selecione';
                            switch ($dadosAluno['id_pelotao'] ?? null) {
                                case 1:
                                    $pelotao = "Cobra";
                                    break;
                                case 2:
                                    $pelotao = "Águia";
                                    break;
                                case 3:
                                    $pelotao = "Tigre";
                                    break;
                                case 4:
                                    $pelotao = "Leão";
                                    break;
                                case 5:
                                    $pelotao = "Falcão";
                                    break;
                            } ?>
                            <p>Pelotão:
                                <select name="id_pelotao" required>
                                    <!-- CORREÇÃO no value da option abaixo -->
                                    <option value="<?php echo $dadosAluno['id_pelotao'] ?? ''; ?>" selected><?php echo $pelotao; ?></option>
                                    <option value="1">Cobra</option>
                                    <option value="2">Águia</option>
                                    <option value="3">Tigre</option>
                                    <option value="4">Leão</option>
                                    <option value="5">Falcão</option>
                                </select>
                            </p>
                        </label>

                        <label>
                            <p>Em estágio?
                                <?php
                                $simEstagiando = ($dadosAluno['estagiando'] ?? '') == "1" ? "checked" : "";
                                $naoEstagiando = ($dadosAluno['estagiando'] ?? '') == "0" ? "checked" : "";
                                ?>
                            <fieldset class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" <?php echo $simEstagiando; ?> name="estagiando" value="1" class="radio-input" required> Sim
                                </label>
                                <label class="radio-label">
                                    <input type="radio" <?php echo $naoEstagiando; ?> name="estagiando" value="0" class="radio-input"> Não
                                </label>
                            </fieldset>
                            </p>
                        </label>

                        <label>
                            <p>Formado Monitor?
                                <?php
                                $simFormadoMonitor = ($dadosAluno['monitor'] ?? '') == "1" ? "checked" : "";
                                $naoFormadoMonitor = ($dadosAluno['monitor'] ?? '') == "0" ? "checked" : "";
                                ?>
                            <fieldset class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" <?php echo $simFormadoMonitor; ?> name="monitor" value="1" class="radio-input" required> Sim
                                </label>
                                <label class="radio-label">
                                    <input type="radio" <?php echo $naoFormadoMonitor; ?> name="monitor" value="0" class="radio-input"> Não
                                </label>
                            </fieldset>
                            </p>
                        </label>

                        <hr>
                        <input type="submit" value="Alterar informações">
                        <a href="listarAlunos.php"><button type="button">Voltar</button></a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>