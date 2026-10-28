<?php
session_start();
$id = $_SESSION['id'];
include "conecta.php";

$sql = "SELECT id, nome FROM responsavel ORDER BY nome";
$resultado = mysqli_query($conn, $sql);
$naoHaDados = FALSE;

if (mysqli_affected_rows($conn) > 0) {
    $dados = mysqli_fetch_assoc($resultado);
} else {
    $naoHaDados = TRUE;
}

$ano = date('Y');
$mes = date('m');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamentos</title>
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
    <link rel="icon" href="logoCoter.png" type="image/x-icon">
</head>

<body>
    <!-- 1. OBRIGATÓRIO: O controle do menu fica no topo do body para o CSS funcionar -->
    <input type="checkbox" id="menu-toggle" style="display: none;">
    
    <header>
        <!-- 2. O label aponta para o ID do input acima -->
        <label for="menu-toggle" class="hamburger">&#9776;</label>
        <h1>S.I.G.C[...]</h1>
    </header>
    <?php include "imprimirSidebar.php";
    echo imprimirSidebar(); ?>

    <form method="POST" action="">
        <div class="main-wrapper">
            <div class="content">
                <div
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 200px; padding: 30px; margin: 20px auto; max-width: 500px; background-color: #dbffcd; border: 1px solid #ffeeba; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center; font-family: sans-serif;">
                    <i class="fa-solid fa-triangle-exclamation" style="color: rgb(0, 107, 146); width: 20px;"></i>

                    <h3 style="margin: 0 0 10px 0; color: #1a8504; font-size: 1.4rem;">
                        Setor em manutenção!
                    </h3>

                    <p style="margin: 0; color: #1a8504; font-size: 1rem; line-height: 1.5;">
                        Aguarde essa funcionalidade ser lançada. Pode ser que demore... <br> pegue um café!
                    </p>
                </div>

                <!--<div class="formCadastro">
                <label>Ano: <input type="number" name="ano" value="<?php echo $ano; ?>"></label><br><br>

                <label>Mês: <input type="number" name="mes" value="<?php echo $mes; ?>"></label><br><br>

                <label>Responsável:
                    <?php
                    if ($naoHaDados == FALSE) {
                        echo '<select name="responsavel">';
                        echo '<option></option>';
                        while ($dados = mysqli_fetch_assoc($resultado)) {
                            echo '<option value="' . $dados['id'] . '">' . $dados['nome'] . '</option>';
                        }
                        echo '</select>';
                    } else {
                        echo '<select><option>Não há registros no sistema. Cadastre um responsável ou contate o suporte!</option></select>';
                    }
                    ?>
                </label><br><br>

                <label>Valor: <input type="number" name="valor"></label>
                <br>
                <br><input type="submit" value="Cadastrar">
            </div>

        </div>-->
    </form>
    </div>
</body>

</html>

<?php
function segundoSabado($ano, $mes)
{
    // essa função retorna uma data quando fornecemos mktime(hora, minuto, segundo, mês, dia, ano) e retorna em date, é pra pegar
    // do form o ano e mês em número e transformar em date.
    // dessa forma, vem bonitinho formatado em dd/mm/aaaa
    $primeiroDia = mktime(0, 0, 0, $mes, 1, $ano);

    // função date() com 'w' retorna o dia da semana de acordco com a variável em número: (0 = domingo, 6 = sábado)
    $diaSemana = date('w', $primeiroDia);

    // calcula quantos dias faltam até o primeiro sábado
    if ($diaSemana == 6) {
        $diasAteSabado = 0;
    } else {
        $diasAteSabado = 6 - $diaSemana;
    }

    // dia do primeiro sábado
    $primeiroSabado = 1 + $diasAteSabado;

    // aqui é só adicionar mais 7 de um sábado pro outro👍
    $segundoSabado = $primeiroSabado + 7;

    // retorna no formato YYYY-MM-DD
    return date('Y-m-d', mktime(0, 0, 0, $mes, $segundoSabado, $ano));
}

if ($_POST) {
    $idResponsavel = $_POST['responsavel'];
}
?>