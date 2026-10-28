<?php
include "../controller/conecta.php";
session_start();
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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGC - Dashboard</title>
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
        <h1>Anotações</h1>
    </header>

    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>

    <div class="main-wrapper">
        <div class="card">
            <div class="card-header">Pesquisa</div>
            <div class="card-body">
                <form method="POST" action="">
                    <p><select name="pesquisa">
                        <option value="">Selecione o autor</option>
                        <?php
                        $sqlAutores = "SELECT DISTINCT autor FROM anotacao ORDER BY autor"; //alterar tudo depois
                        $resultadoAutores = mysqli_query($conn, $sqlAutores);
                        while ($autor = mysqli_fetch_assoc($resultadoAutores)) {
                            echo "<option value='{$autor['autor']}'>{$autor['autor']}</option>";//ai
                        }
                        ?>
                    </select></p>
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
                    <?php
                    if ($_POST) {
                        if (isset($_POST['pesquisa'])) {
                            $pesquisa = $_POST['pesquisa'];
                            $sqlLista = "SELECT * FROM anotacao WHERE autor LIKE '%$pesquisa%' ORDER BY data_criacao";
                        } else {
                            $sqlLista = "SELECT * FROM anotacao ORDER BY data_criacao";
                            $pesquisa = "";
                        }
                        $resultado = mysqli_query($conn, $sqlLista);

                        if (mysqli_num_rows($resultado) > 0) {
                            $numResultados = 0;
                            if ($pesquisa != "") {
                                while ($resPesquisa = mysqli_fetch_assoc($resultado)) {
                                    $numResultados++;
                                    ?>

                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
        <hr>


        <?php
        $sqlAnotacoes = "SELECT * FROM anotacao ORDER BY data_criacao DESC";
        $resultadoAnotacoes = mysqli_query($conn, $sqlAnotacoes); //também mudar tudo depois
        while ($dados = mysqli_fetch_assoc($resultadoAnotacoes)) { ?>

            <div class="card">
                <div class="card-header"><?php echo $dados['titulo']; ?></div>
                <div class="card-header"><?php echo $dados['autor']; ?></div>
                <div class="card-header"><?php echo $dados['data_criacao']; ?></div>
                <div class="card-body" style="text-align: center;">
                    <p><?php echo $dados['texto']; ?></p>
                </div>
                <div class="card-header">
                    <button disabled onclick="location.href=''">Editar Anotação</button>
                    <button disabled onclick="location.href=''">Excluir Anotação</button>
                </div>
            </div>
            <hr>
        <?php } ?>



    <!-- </div> -->

</body>

</html>