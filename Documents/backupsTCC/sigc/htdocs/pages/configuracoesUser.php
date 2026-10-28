<?php
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
    header('Location: login.php');
    exit;
}

$temaEscolhido = $dadosAdmin['tema'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
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
        <h1>Preferências</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>

    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>

    <div class="main-wrapper">
        <div class="card">
            <div class="card-header"> Tema e Cor </div>
            <div class="card-body">
                <div class="bloco-nota">
                    <p>A cor dominante e o tema da página são alterados apenas para você. Outro usuário não verá suas
                        escolhas.</p>
                </div>
                <form action="../source/F_salvarConfiguracoes.php" method="POST">
                    <label>
                        <p>Tema: </p>
                        <?php
                        switch ($dadosAdmin['tema']) {
                            case "verdeClaro":
                                $cor = "Cor: VERDE / Tema: CLARO";
                                break;
                            case "verdeEscuro":
                                $cor = "Cor: VERDE / Tema: ESCURO";
                                break;
                            case "azulClaro":
                                $cor = "Cor: AZUL / Tema: CLARO";
                                break;
                            case "azulEscuro":
                                $cor = "Cor: AZUL / Tema: ESCURO";
                                break;
                            case "rosaClaro":
                                $cor = "Cor: ROSA / Tema: CLARO";
                                break;
                            case "rosaEscuro":
                                $cor = "Cor: ROSA / Tema: ESCURO";
                                break;
                        }
                        ?>
                        
                        <select name="tema">
                            <?php echo '<option value=' . $temaEscolhido . '> Atual -> ' . $cor . '</option>';?>
                            <option value="verdeClaro">Cor: VERDE / Tema: CLARO </option>
                            <option value="verdeEscuro">Cor: VERDE / Tema: ESCURO</option>
                            <option value="azulClaro">Cor: AZUL / Tema: CLARO</option>
                            <option value="azulEscuro">Cor: AZUL / Tema: ESCURO</option>
                            <option value="rosaClaro">Cor: ROSA / Tema: CLARO</option>
                            <option value="rosaEscuro">Cor: ROSA / Tema: ESCURO</option>
                        </select>
                        <br><br>
                        <input type="submit" value="Alterar tema e cor" class="btn-salvar">
                    </label>
                </form>
            </div>
        </div>


        <hr>
        <div class="card">
            <?php
            $sql = "SELECT valorPadraoMensalidade FROM definicoes";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                $dados = mysqli_fetch_assoc($res);
                $valorPadrao = $dados["valorPadraoMensalidade"];
            } else {
                $valorPadrao = "0";
            }
            ?>
            <div class="card-header"> Valor Mensalidades </div>
            <div class="card-body">
                <form action="../source/F_salvarValorPadrao.php" method="POST">
                    <div class="bloco-nota">
                        <p>Altera o valor padrão que aparece previamente no campo "Valor" no formulário de mensalidade.
                        </p>
                    </div>
                    <label>
                        <p>Valor padrão da mensalidade:</p>
                        <input type="number" name="valorPadraoMensalidade" value="<?php echo $valorPadrao; ?>">
                        <br><br>
                        <input type="submit" value="Definir valor" class="btn-salvar">
                    </label>
                </form>
            </div>
        </div>

    </div>
    </div>
    </div>
</body>

</html>