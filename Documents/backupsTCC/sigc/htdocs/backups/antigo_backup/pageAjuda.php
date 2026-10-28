<?php
session_start();
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual do Sistema</title>
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
</head>

<body>
    <header>
        <h1>S.I.G.C[...]</h1>
        <nav>

        </nav>
    </header>
    <ul class="sidenav">
        <li><a href="index.php"><i class="fa-solid fa-house"></i> Início</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Pessoas</span></div>
        <li><a href="listarAlunos.php"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a href="listarResponsaveis.php"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
        <li><a href="listarEstagiario.php"><i class="fa-solid fa-user"></i> Estagiários</a></li>
        <li><a href="cadastrarUsuario.php"><i class="fa-solid fa-user-shield"></i> Usuários</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Valores</span></div>
        <li><a href="listarMensalidades.php"><i class="fa-solid fa-piggy-bank"></i> Mensalidades</a></li>
        <li><a href="arrecadacao.php"><i class="fa-solid fa-hand-holding-dollar"></i> Arrecadação</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Gestão</span></div>
        <li><a href="relatorios.php"><i class="fa-regular fa-clipboard"></i> Relatórios</a></li>
        <li><a href="listarAnotacoes.php"><i class="fa-solid fa-note-sticky"></i> Anotações</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Configurações</span></div>
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <li><a class="active" href="pageAjuda.php"><i class="fa-solid fa-book-open"></i> Manual do Sistema</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>


    <div class="main-wrapper">
        <div class="card">
            <div class="card-header">Organização da Tela</div>
            <div class="card-body">
                <h4>Ao fazer login no sistema, você verá uma interface organizada em abas, onde cada aba representa uma área específica do sistema.</h4>
                <p>Na lateral esquerda, você encontrará um menu de navegação que permite acessar rapidamente as diferentes seções do sistema.
                Na parte superior da tela, você verá o cabeçalho com o nome do sistema e informações do usuário logado.</p>
                <div class="imagem" style="text-align: center; border: 1px solid #ccc; padding: 10px;">
                    <img src="setaPainelLateral_pageAjuda.png" width="80%" height="80%">
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">Gerenciar Outros Usuários</div>
            <div class="card-body">
                <h4>Falar sobre o usuário, como cadastrar e excluir um usuário e falar sobre as permissões</h4>
                <h4>Também falar sobre a área de configurações</h4>
            </div>
        </div>

        <hr>
        <div class="card">
            <div class="card-header">Seção PESSOAS</div>
            <div class="card-body">
                <h4>Falar e explicar sobre cada página do painel na seção PESSOAS.</h4>
                <h4>Explicar o que é, pra que é, o que pode ser feito e gerenciado e explicar sobre a função de pesquisa.</h4>
                <details>
                    <summary>Exemplo de pesquisa</summary>
                    <p>Ao digitar um nome ou parte dele no campo de pesquisa, o sistema filtrará automaticamente os resultados, exibindo apenas os registros que correspondem ao critério de busca.</p>
                    <p>Se você não digitar nada no campo de pesquisa e pressionar ENTER, o sistema limpará o campo e retornará à visualização padrão, exibindo todos os registros disponíveis.</p>
                </details>
                <details>
                    <summary>Exemplo de pesquisa</summary>
                    <p>Ao digitar um nome ou parte dele no campo de pesquisa, o sistema filtrará automaticamente os resultados, exibindo apenas os registros que correspondem ao critério de busca.</p>
                    <p>Se você não digitar nada no campo de pesquisa e pressionar ENTER, o sistema limpará o campo e retornará à visualização padrão, exibindo todos os registros disponíveis.</p>
                </details>
                <details>
                    <summary>Exemplo de pesquisa</summary>
                    <p>Ao digitar um nome ou parte dele no campo de pesquisa, o sistema filtrará automaticamente os resultados, exibindo apenas os registros que correspondem ao critério de busca.</p>
                    <p>Se você não digitar nada no campo de pesquisa e pressionar ENTER, o sistema limpará o campo e retornará à visualização padrão, exibindo todos os registros disponíveis.</p>
                </details>
            </div>
        </div>

        <hr>
        <div class="card">
            <div class="card-header">Seção VALORES</div>
            <div class="card-body">
                <h4>Falar mesma coisa sobre a seção VALORES.</h4>
            </div>
        </div>

        <hr>
        <div class="card">
            <div class="card-header">Seção GESTÃO</div>
            <div class="card-body">
                <h4>também a mesma coisa. Falar e explicar.</h4>
            </div>
        </div>

        <hr>
        <div class="card">
            <div class="card-header">Seção Configurações</div>
            <div class="card-body">
                <h4>segue o mesmo. Falar sobre o painel de configurações e o Manual do Sistema.</h4>
            </div>
        </div>

        <hr>
        <div class="card">
            <div class="card-header">Funcionalidades e Automações</div>
            <div class="card-body">
                <h4>Explicar e falar sobre funcionalidades e automações ocultas ou até mesmo não óbvias ou perceptíveis.</h4>
                <h4>Como exemplo: enquanto o navegador tá aberto e sessão ativa não precisa fazer login denovo ao fechar a guia.</h4>
                <h4>O sistema descobre sozinho o segundo sábado de cada mês.</h4>
                <h4>O sistema fará sozinho a lista de adimplentes, mas ela poderá ser editada manualmente.</h4>
                <h4>Sistema de cores só muda de usuário para usuário. Se eu escolher azul, o fulano não vai saber.</h4>
                <h4>Se eu não digitar nada no campo de pesquisa e der ENTER, o sistema limpa o campo e volta como tava antes, sem resultados e a tela mais limpa.</h4>
            </div>
        </div>

        <hr>
        <div class="card">
            <div class="card-header">Perguntas Frequentes</div>
            <div class="card-body">
                <h4>Surgiu um erro estranho na tela.</h4>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">Documentação de Desenvolvimento do Sistema - Luiz Felipe Leges 2026</div>
            <div class="card-body" style="text-align: center;">
                <iframe src="TCC_Coter.pdf" width="100%" height="600px"></iframe> <!-- descobri agora o iframe. Achei SENSACIONAL -->
            </div>
        </div>
    </div>



</body>

</html>