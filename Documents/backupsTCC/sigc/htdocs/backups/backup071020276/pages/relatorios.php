<?php
session_start();
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
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
        <h1>Relatórios</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>
    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>
    <div class="main-wrapper">
        
        <details>
            <summary>Informações</summary>
            <div class="card-body">
                        <h2 class="h2Dialog">Seção Relatórios mensais</h2>
                        <div class="bloco-nota">
                            <h3>Relatórios:</h3>
                            <p>Aqui ficam armazenados os arquivos em PDF gerados.</p>
                            <p>Ao baixar a lista de devedores do mês em PDF, o sistema salva no Banco de Dados.</p>
                            <p>Essa seção exibe todos os relatórios já gerados automaticamente.</p>
                            <hr>
                            <p>O sistema gera esses relatórios pois na tabela de devedores (<a style="color: rgb(31, 136, 223)" href="listarMensalidades.php">Mensalidades</a> > Lista de Devedores)
                                apenas mostra quem ainda não efetuou o pagamento do mês atual.</p>
                        </div>
                    </div>
        </details>
        
    </div>
</body>

</html>