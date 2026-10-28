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

$id_resp = $_GET['id_resp'];

$sql = "SELECT * FROM responsavel WHERE id='$id_resp'";
$resultado = mysqli_query($conn, $sql);
$dadosResp = mysqli_fetch_assoc($resultado);


$sqlAlunos = "SELECT * FROM aluno WHERE arquivado = 0 ORDER BY nome";
$resultadoAlunos = mysqli_query($conn, $sqlAlunos);

$idAlunoAssociado = $dadosResp['id_aluno'];
$sqlAlunoAssociado = "SELECT nome FROM aluno WHERE id='$idAlunoAssociado'";
$resultadoAlunoAssociado = mysqli_query($conn, $sqlAlunoAssociado);
$nomeAlunoAssociado = mysqli_fetch_assoc($resultadoAlunoAssociado);

if ($_POST) {
    include "../controllerconecta.php";
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $alunoSubordinado = $_POST['alunoSubordinado'];

    $sql = "UPDATE responsavel SET nome = '$nome', telefone = '$telefone', id_aluno = '$alunoSubordinado' WHERE id = '$id_resp'";
    $resultados = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0) {
        header("Location:../pages/listarResponsaveis.php");
    } else {
        echo "<dialog open>Houve um erro interno...</dialog>";
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
        <div class="content">
            <div class="card">
                <div class="card-header">Altere os dados atuais:</div>
                <div class="card-body">
                    <form method="POST" action="">
                        <label>
                            <p>Nome completo: <span style="color:red;">*</span><br><input type="text" name="nome"
                                    value="<?php echo $dadosResp['nome']; ?>" required></p>
                        </label>
                        <label>
                            <p>Número de telefone (WhatsApp): <span style="color:red;">*</span><br><input type="text"
                                    id="whatsapp" placeholder="(00) 90000-0000" maxlength="15" name="telefone" value="<?php echo $dadosResp['telefone']; ?>" required></p>
                        </label>
                        <label>
                            <p>Aluno subordinado:<br>
                                <select name="alunoSubordinado">
                                    <?php


                                        if($dadosResp['id_aluno'] != 0) {
                                            echo '<option value='. $dadosResp['id_aluno'] . '>'. $nomeAlunoAssociado['nome'].'</option>';
                                        } else {
                                            echo '<option value=0>Não associar a nenhum aluno</option>';
                                        }
                                    ?>
                                    <option value=0> >>>>> Não associar a nenhum aluno <<<<< </option>
                                        <?php
                                        while ($dadosAluno = mysqli_fetch_assoc($resultadoAlunos)) {
                                            echo '<option value=' . $dadosAluno['id'] . '>' . $dadosAluno['nome'] . '</option>';
                                        }
                                        ?>
                                </select>
                            </p>
                        </label>
                        <input type="submit" value="Alterar informações">
                        <label><a href="../pages/listarResponsaveis.php"><button type="button">Voltar</button></a></label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>

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