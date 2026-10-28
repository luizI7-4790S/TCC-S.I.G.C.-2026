<?php
include "conecta.php";
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGC - Dashboard</title>
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
    <link rel="icon" href="logoCoter.png" type="image/x-icon">

</head>

<body>

    <header>
        <h1>S.I.G.C[...]</h1>
    </header>

    <ul class="sidenav">
        <li><a class="active" href="index.php"><i class="fa-solid fa-house"></i> Início</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Pessoas</span></div>
        <li><a href="listarAlunos.php"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a href="listarResponsaveis.php"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
        <li><a href="listarEstagiario.php"><i class="fa-solid fa-user"></i> Estagiários</a></li>
        <li><a href="cadastrarUsuario.php"><i class="fa-solid fa-user-shield"></i> Usuários</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Valores</span></div>

        <li><a href="listarMensalidades.php" class="emManutencao"><i class="fa-solid fa-piggy-bank"></i> Mensalidades</a></li>
        <li><a href="arrecadacao.php" class="emManutencao"><i class="fa-solid fa-hand-holding-dollar"></i> Arrecadação</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Gestão</span></div>
        <li><a href="relatorios.php"><i class="fa-regular fa-clipboard"></i> Relatórios</a></li>
        <li><a href="listarAnotacoes.php"><i class="fa-solid fa-note-sticky"></i> Anotações </a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Configurações</span></div>
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <li><a href="pageAjuda.php"><i class="fa-solid fa-book-open"></i> Manual do Sistema</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>

    <div class="main-wrapper">
        <div class="welcome-section">
            <h2>Olá, <span><?php echo $dadosAdmin['nome']; ?></span>!</h2>
            <p>Aqui está o resumo do sistema hoje.</p>
            <?php
            if ($dadosAdmin['id'] == 1) { //pequeno aviso para caso o usuer logado seja o padrão do banco.
                echo '<div class="bloco-nota" style="border: 2px solid #ffc107; background-color: #fffbeb; padding: 15px; border-radius: 5px; margin: 15px 0; font-family: sans-serif;">
                        <h3 style="color: #d97706; margin-top: 0; margin-bottom: 10px;">Lembrete:</h3>
                        <p style="color: #333333; margin: 5px 0;">
                        Você está conectado como <span style="font-weight: bold; color: #d97706;">usuário padrão</span>.
                        </p>
                        <p style="color: #555555; margin: 5px 0;">
                        Para maior segurança, use esta conta preferencialmente para recuperação de senha.
                        </p>
                        <p style="color: #555555; margin: 5px 0;">
                        Acesse a página de <a href="cadastrarUsuario.php" style="color: #b45309; font-weight: bold; text-decoration: underline;">Usuários</a> para registrar uma nova conta de uso diário.
                        </p>
                    </div>';
            }
            ?>
        </div>

        <!-- <div class="dashboard-grid"> tirei essa div que ajusta as outras uma ao lado da outra. -->

<div class="card" style="border: 1px solid #ff9800; box-shadow: 0 4px 20px rgba(255, 152, 0, 0.2); background-color: #1e1e1e;">
    <!-- Cabeçalho Principal -->
    <div class="card-header" style="background-color: #2b2118; border-bottom: 1px solid #ff9800; padding: 15px 20px;">
        <h3 style="margin: 0; color: #ffb74d; display: flex; align-items: center; gap: 8px;">
            Aviso
        </h3>
    </div>
    
    <!-- Metadados do Autor -->
    <div style="background-color: #252525; padding: 8px 20px; font-size: 0.85rem; color: #ffb74d; border-bottom: 1px dashed #444444; display: flex; justify-content: space-between; flex-wrap: wrap;">
        <span><strong>Luiz Felipe</strong> </span>
        <span><strong>Criado em:</strong> 12/07/2026</span>
    </div>
    
    <!-- Corpo do Card -->
    <div class="card-body" style="padding: 20px; color: #e0e0e0;">
        <h4 style="color: #ffe0b2; margin-top: 0; line-height: 1.4; text-align: center;">
            <span style="color: #ffb74d;">O sistema está em desenvolvimento, então algumas funções podem não estar funcionando corretamente.</span><br>
            Vou deixar aqui alguns pontos que estão, teoricamente, 100%:
        </h4>
        
        <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
            <li>Cadastrar, excluir, editar, listar e pesquisar ALUNOS</li>
            <li>Cadastrar, excluir, editar, listar e pesquisar RESPONSÁVEIS</li>
            <li>Cadastrar, excluir, editar, listar e pesquisar ESTAGIÁRIOS</li>
            <li>Cadastrar, excluir e listar USUÁRIOS</li>
            <li>Alterar a cor e tema do sistema</li>
            <li>O sistema sabe qual segundo sábado do mês atual</li>
            <li>Depois de fazer login, pode fechar e reabrir a página várias vezes sem precisar logar de novo, enquanto o navegador estiver aberto</li>
        </ul>
        
        <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens que ainda estão pendentes:</h4>
        <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
            <li>Cadastrar, excluir, editar, listar e pesquisar MENSALIDADES</li>
            <li>Cadastrar, excluir, editar, listar e pesquisar ARRECADAÇÕES MENSAIS</li>
            <li>Cadastrar, excluir, editar, listar e pesquisar ANOTAÇÕES</li>
            <li>Configurar o valor padrão de mensalidade</li>
            <li>Verificar se o aluno está em dia com as mensalidades</li>
            <li>Filtros de pesquisa (pesquisar por pelotão, graduação, etc.)</li>
            <li>Terminar a página Manual do Sistema</li>
            <li>Formulário de cadastro de mensalidade</li>
        </ul>
        
        <h4 style="color: #ffb74d; margin-top: 25px;">Lista de planos futuros:</h4>
        <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
            <li>Decidir a melhor forma do gerenciamento dos meses para registrar a arrecadação</li>
            <li>Ajeitar o layout da página quando acessada pelo celular (tá tudo bugado 🤨)</li>
            <li>Fazer uma página pública tipo marketing</li>
        </ul>
    </div>
</div>
<hr>

        <div class="card">
            <div class="card-header">Atalhos de Funções</div>
            <div class="card-body" style="text-align: center;">

                <label>
                    <button onclick="location.href='cadastrarResponsavel.php'">
                        <!-- Usa-se o "onclick" ao invés de <button> dentro de <a> porque, supostamente, é uma prática inválida -->
                        <i class="fa-solid fa-user-tie"></i> Cadastrar Responsável
                    </button>
                </label>

                <label>
                    <button onclick="location.href='cadastrarAluno.php'">
                        <i class="fa-solid fa-user-graduate"></i> Cadastrar Aluno
                    </button>
                </label>

                <label>
                    <button onclick="location.href='listarMensalidades.php'">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Cadastrar Mensalidade
                    </button>
                </label>

                <label>
                    <button onclick="location.href='cadastrarAnotacao.php'">
                        <i class="fa-solid fa-sticky-note"></i> Criar Anotação
                    </button>
                </label>

            </div>
        </div>
        <hr>


        <div class="card">
            <?php
            $sql = "SELECT * FROM arrecadacao";
            $resultadoArrecadacao = mysqli_query($conn, $sql);
            $totalArrecadacao = 0;
            $totalArrecadacaoMesAtual = 0;
            $quantiaMensalidades = 0;
            while ($dados = mysqli_fetch_assoc($resultadoArrecadacao)) {
                $totalArrecadacao = $totalArrecadacao + $dados['valor'];

                if ($dados['mes'] == date('M') && $dados['ano'] == date('Y')) {
                    $totalArrecadacaoMesAtual = $dados['valor'];
                    $quantiaMensalidades = $dados['qtd_mensalidades'];
                }

            }

            ?>
            <div class="card-header">Fundos e Arrecadação</div>
            <div class="card-body">
                <div class="stat-row"><span>Total Arrecadado ao longo do tempo:</span> <strong>R$
                        <?php echo number_format($totalArrecadacao, 2, ',', '.'); ?></strong></div>
                <div class="stat-row"><span>Valor arrecadado em <?php echo date('M/Y'); ?>:</span> <strong>R$
                        <?php echo number_format($totalArrecadacaoMesAtual, 2, ',', '.'); ?></strong></div>
                <div class="stat-row"><span>Total de mensalidades registradas em <?php echo date('M/Y'); ?>:</span>
                    <strong><?php echo $quantiaMensalidades; ?></strong>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <?php
            $sqlMensalidas = "SELECT * FROM mensalidade LIMIT 5";
            $resultadoMensalidades = mysqli_query($conn, $sqlMensalidas);

            //puxar info dos alunos pelo ID
            
            ?>
            <div class="card-header">Ultimas mensalidades registradas</div>
            <div class="card-body">
                <?php
                while ($dados = mysqli_fetch_assoc($resultadoMensalidades)) {
                    $sqlAluno = "SELECT * FROM aluno WHERE id = '" . $dados['id_aluno'] . "'";
                    $resultadoInfoDoAluno = mysqli_query($conn, $sqlAluno);
                    $dadosAluno = mysqli_fetch_assoc($resultadoInfoDoAluno);
                    echo '<div class="list-item">Aluno: ' . $dadosAluno['nome'] . '<span> Pago em: ' . $dados['dia_referencia'] . '/ ' . $dados['mes_referencia'] . '/' . $dados['ano_referencia'] . '</span></div>';
                } ?>
            </div>
        </div>
    </div>
    <!-- </div> -->

</body>

</html>