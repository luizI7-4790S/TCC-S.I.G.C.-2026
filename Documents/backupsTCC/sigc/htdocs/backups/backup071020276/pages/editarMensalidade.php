<?php
session_start();
$id = $_SESSION['id'];
$idMensalidade = $_GET['id_mensalidade'];

if ($_POST) {
    include '../controller/conecta.php';

    $data = isset($_POST['data']) ? $_POST['data'] : '';
    $valor = isset($_POST['valor']) ? $_POST['valor'] : '';
    $aluno = isset($_POST['aluno']) ? $_POST['aluno'] : '';
    $metodo = isset($_POST['metodo_pagamento']) ? $_POST['metodo_pagamento'] : '';
    $observacao = isset($_POST['observacao']) ? $_POST['observacao'] : '';

    $sqlValorbase = "SELECT * FROM definicoes";
    $resultadoValorbase = mysqli_query($conn, $sqlValorbase);
    $dados = mysqli_fetch_assoc($resultadoValorbase);
    $valor_base = $dados['valorPadraoMensalidade'];

    $atrasado = false;
    $segundoSabado = date('Y-m-d', strtotime('second Saturday of ' . $data));

    if ($data > $segundoSabado) {
        $atrasado = true;
    }

    // 3. Segurança: Proteção contra SQL Injection (Escapando dados) -- by: assistente do google (não sabia dessa função)
    $data_sql = mysqli_real_escape_string($conn, $data);
    $valor_sql = mysqli_real_escape_string($conn, $valor);
    $valor_base_sql = mysqli_real_escape_string($conn, $valor_base);
    $aluno_sql = mysqli_real_escape_string($conn, $aluno);
    $metodo_sql = mysqli_real_escape_string($conn, $metodo);
    $observacao_sql = mysqli_real_escape_string($conn, $observacao);
    $atrasado_sql = $atrasado ? 1 : 0;

    $sql = "UPDATE mensalidade SET data_pagamento = '$data_sql', valor_pago = '$valor_sql', valor_base = '$valor_base_sql', id_aluno = '$aluno_sql',
        metodo_pagamento = '$metodo_sql', observacao = '$observacao_sql', atrasado = '$atrasado_sql'
        WHERE id = '$idMensalidade'";

    $resultado = mysqli_query($conn, $sql);


    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Mensalidade editada com sucesso!'); window.location.href='../pages/listarMensalidades.php';</script>";
    } else {
        echo "<script>alert('Houve um erro...'); window.location.href='../pages/listarMensalidades.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de dados</title>
    <?php
    include "../source/verStyle.php";
    $tema = buscarTema($id);
    ?>
    <link rel="stylesheet" href="../styles/style_CLOUDE.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../images/logoCoter.png" type="image/x-icon">
</head>

<body data-theme='<?php echo $tema ?>'>
    <!-- 1. OBRIGATÓRIO: O controle do menu fica no topo do body para o CSS funcionar - by: gemini -->
    <input type="checkbox" id="menu-toggle" style="display: none;">

    <header>
        <!-- 2. O label aponta para o ID do input acima - by: gemini -->
        <h1>Mensalidades</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>
    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>

    <div class="main-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header">Altere os dados atuais:</div>
                <div class="card-body">
                    <form action="" method="POST">
                        <?php
                        include '../controller/conecta.php';
                        $idMensalidade = $_GET['id_mensalidade'];
                        $sql = "SELECT * FROM mensalidade WHERE id='$idMensalidade'";
                        $result = mysqli_query($conn, $sql);
                        $dados = mysqli_fetch_assoc($result);
                        ?>


                        <label>
                            <p>Efetuado em:</p>
                            <input type="date" name="data" value="<?php echo $dados['data_pagamento']; ?>" required>
                        </label>

                        <label>
                            <p>Valor:</p>
                            <input type="number" name="valor" value="<?php echo $dados['valor_pago']; ?>" step="0.01" required>
                        </label>
                        <label>
                            <p>Aluno:</p>
                            <?php
                            include "../controller/conecta.php";
                            $idDoAluno = $dados['id_aluno'];
                            $sqlNomeAluno = "SELECT nome FROM aluno WHERE id = '$idDoAluno'";
                            $resultadoNomeAluno = mysqli_query($conn, $sqlNomeAluno);
                            if (mysqli_affected_rows($conn) > 0) {
                                $dadosAluno = mysqli_fetch_assoc($resultadoNomeAluno);
                                $nomeAluno = $dadosAluno['nome'];
                            } else {
                                $nomeAluno = "Selecione um aluno";
                            }
                            ?>
                            <select name="aluno" required>
                                <option value="<?php echo $idDoAluno; ?>" selected>Aluno registrado: <?php echo $nomeAluno; ?></option>
                                <?php
                                include '../controller/conecta.php';
                                $sql = "SELECT * FROM aluno ORDER BY nome";
                                $result = mysqli_query($conn, $sql);
                                while ($dadosAluno = mysqli_fetch_assoc($result)) {
                                    if ($dadosAluno['nome'] != $nomeAluno) {
                                        echo '<option value="' . $dadosAluno['id'] . '">' . $dadosAluno['nome'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </label>

                        <label>
                            <p>Metodo de pagamento:<br>
                                <?php if ($dados['metodo_pagamento'] == "Dinheiro") {
                                    $selecionarDinheiro = "checked";
                                } else {
                                    $selecionarDinheiro = "";
                                }
                                if ($dados['metodo_pagamento'] == "PIX") {
                                    $selecionarPIX = "checked";
                                } else {
                                    $selecionarPIX = "";
                                } ?>
                            <fieldset class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" <?php echo $selecionarDinheiro; ?> name="metodo_pagamento" value="Dinheiro" class="radio-input">
                                    Dinheiro
                                </label>
                                <label class="radio-label">
                                    <input type="radio" <?php echo $selecionarPIX; ?> name="metodo_pagamento" value="Pix" class="radio-input"> Pix
                                </label>
                            </fieldset>
                        </label>


                        <label>
                            <p>Observação:</p>
                            <textarea name="observacao" rows="6" cols="50"><?php echo htmlspecialchars($dados['observacao'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                        </label>

                        <hr>
                        <input type="submit" value="Registrar" class="btn-salvar">
                        <label><a href="../pages/listarMensalidades.php"><button type="button">Voltar</button></a></label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>