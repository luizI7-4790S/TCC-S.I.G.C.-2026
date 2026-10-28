<?php
include "../controller/conecta.php"; //acho que esse include é irrelevante
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
        <h1>Atualizações</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>

    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>

    <!-- <div class="dashboard-grid"> tirei essa div que ajusta as outras uma ao lado da outra. -->
    <div class="main-wrapper">

        <div class="card">
            <div class="card-body" style="text-align:center;">
                <h4 style="color: #ffe0b2; margin-top: 0; line-height: 1.4; text-align: center;">
                    <span style="color: #ffb74d;">Quadro de atualizações do sistema!</span><br>
                    A cada nova atualização, adicionarei uma mensagem com os detalhes do que foi feito
                </h4>
                <img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExZzZ4NnY0Z3ZkMGltanY2am9rOXViOG16d3R3YjJmMDNzMnAxYm5ncSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/GRk3GLfzduq1NtfGt5/giphy.gif"
                    alt="meme do gato kkkskssjkfdlkjflk" width="200px" height="200px"
                    style="
                border: 2px solid #1e1e1e;
                border-radius:50%;">
            </div>
        </div>
        <hr>
        
        <details>
            <summary>Atualização 2.1: concluida seção Mensalidades (02/10/2026 - 10:35) - Luiz Felipe Ferrioli Leges</summary>

            <!-- Corpo do Card -->
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Adicionada pequena tabela no topo da tela na seção Mensalidades que mostra informações do mês, como número de pagamentos registrados, número de pessoas que ainda não pagaram e valor total arrecadado.</li>
                    <li>Adicionado pequeno contador no botão "Lista de Devedores" informando quantas pessoas ainda não pagaram no mês.</li>
                    <li>Corrigido erro que não listava nenhuma mensalidade cadastrada ao abrir a seção, apenas quando utilizava-se os filtros de pesquisa.</li>
                    <li>Adicionado formatador de datas: agora, ao invés de mostrar "AAAA-MM-DD" na data da mensalidade, o sistema mostra "(dia) de (mês escrito por extenso) de (ano)".</li>
                    <li>Removida a coluna ID na lista de devedores por ser irrelevante pro usuário final.</li>
                    <li>Adicionado botão "Limpar" que limpa os filtros selecionados na pesquisa e mostra todos os pagamentos do mês, sem filtro.</li>
                </ul>
            </div>
        </details>
        
        
        
        <details>
            <summary><span style="color: #E32727;">S.I.G.C. 2.0: Sistema 95% pronto (13/09/2026 - 17:36) - Luiz Felipe Ferrioli Leges</span></summary>

            <!-- Corpo do Card -->
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    
                    <h3 class="h2Dialog">Atualizações gerais</h3>
                    <li>Melhorado, corrigido e refinado todo o design do sistema</li>
                    <li>Melhorado menu lateral</li>
                    <li>Corrigido botão de abrir menu lateral na versão de celular</li>
                    <li>Melhorados os textos dos botões</li>
                    <li>Animações melhoradas</li>
                    <li>Removida seção ARRECADAÇÃO; Ideia descartada</li>
                    <li>Removida seção ANOTAÇÕES; Ideia descartada</li>
                    <hr>
                    <h3 class="h2Dialog">Seção INÍCIO</h3>
                    <li>Adicionado lembrete de baixar lista de devedores quando restam 7 dias ou menos pro fim do mês</li>
                    <li>Adicionado aviso quando há aluno mirim em estágio</li>
                    <li>Removido botão "cadastrar anotação"</li>
                    <hr>
                    <h3 class="h2Dialog">Seção ALUNOS</h3>
                    <li>Adicionado botão "baixar lista" para fazer download em PDF</li>
                    <li>Listas separadas por pelotão</li>
                    <li>Listas podem ser minimizadas</li>
                    <hr>
                    <h3 class="h2Dialog">Seção RESPONSÁVEIS</h3>
                    <li>Adicionado botão "baixar lista" para fazer download em PDF</li>
                    <li>Adicionada função que abre o WhatsApp no número do responsável ao clicar no telefone correspondente</li>
                    <hr>
                    <h3 class="h2Dialog">Seção ESTAGIÁRIOS</h3>
                    <li>Adicionado botão "baixar lista" para fazer o download em PDF</li>
                    <li>Melhorado design do menu ao clicar em "Atribuir estágio"</li>
                    <hr>
                    <h3 class="h2Dialog">Seção MENSALIDADES</h3>
                    <li>Adicionada função que abre o WhatsApp no número do responsável ao clicar no telefone correspondente</li>
                    <li>Adicionado botão "baixar lista" para fazer download em PDF</li>
                    <li>Encontrado um erro que mostra "?" ao invés da letra com acento no nome do pelotão</li>
                    <hr>
                    <h3 class="h2Dialog">Seção RELATÓRIOS</h3>
                    <li>Adicionada nota explicativa</li>
                    <li>Ainda em elaboração</li>
                    <hr>
                    <h3 class="h2Dialog">Seção MANUAL DO SISTEMA</h3>
                    <li>Atualizada com novas informações</li>
                    <li>Ainda em elaboração</li>
                    <hr>
                    <h3 class="h2Dialog">Próximas etapas</h3>
                    <li>Será realizado um teste com 3 pessoas que não conhecem o sistema. O objetivo é fazer um teste real se é uma interface fácil de utilizar e didática ou autoexplicativa.</li>
                    <li>Terminar o Manual do Sistema</li>
                    <li>Adicionar um menu de informações ao clicar no nome do aluno</li>
                    <li>Procurar por erros e incoerências para resolvê-los</li>
                </ul>
            </div>
        </details>
        
        
        
        
        <details>
            <summary>Adição 1.3: Adicionado filtragem por Método de Pagamento (07/08/2026 - 12:40) - Luiz Felipe Ferrioli Leges</summary>

            <!-- Corpo do Card -->
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Agora é possível filtrar a lista de mensalidades por PIX ou Dinheiro na 
                        <a style="color: rgb(31, 136, 223)" href="listarMensalidades.php">lista de Mensalidades</a> 
                        <br>Também adicionada possibilidade de NÃO filtrar por STATUS (Atrasado ou Em dia); Nessa opção, será mostrado na tela todas as mensalidades cadastradas no mês selecionado</li>
                </ul>
            </div>
        </details>
        
        <details>
            <summary>Adição 1.2: Adicionada pesquisa por múltiplos fatores (29/07/2026 - 08:47) - Luiz Felipe Ferrioli Leges</summary>

            <!-- Corpo do Card -->
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li><span style="color: #ffb74d;">Agora é possível pesquisar por NOME, nome de GUERRA ou NÚMERO na 
                        <a style="color: rgb(31, 136, 223)" href="listarAlunos.php">lista de Alunos</a> 
                        <br>Também é possível pesquisar por NOME ou TELEFONE na <a style="color: rgb(31, 136, 223)" href="listarResponsaveis.php">lista de Responsáveis</a></span></li>
                    <li>Adicionada possibilidade de "recolher" e esconder a caixa de pesquisa, opcionalmente</li>
                </ul>
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de correções</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Removidos botões de EDITAR e EXCLUIR da lista dos resultados de pesquisa por apresentarem erros</li>
                    <li>Removida coluna "Identificador" da lista e da pesquisa de Responsáveis</li>
                </ul>
            </div>
        </details>
        
        <details>
            <summary>Adição 1.1: Adicionado indicador de informação arquivada (28/07/2026 - 14:05) - Luiz Felipe Ferrioli Leges</summary>

            <!-- Corpo do Card -->
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li><span style="color: #ffb74d;">Agora, se o ALUNO ASSOCIADO ao RESPONSÁVEL na <a style="color: rgb(31, 136, 223)" href="listarResponsaveis.php">lista de Responsáveis</a> estiver ARQUIVADO, 	
                        seu nome será exibido em LARANJA. 
                        <br> O mesmo acontece na <a style="color: rgb(31, 136, 223)" href="lisarAlunos.php">lista de Alunos</a> quando, caso o RESPONSÁVEL estiver na lixeira,
                        seu nome será exibido em LARANJA</span></li>
                    <li>Adicionado exibição do nome do Responsável do Aluno na <a style="color: rgb(31, 136, 223)" href="listarAlunos.php">lista de Alunos</a></li>
                </ul>
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de correções</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Corrigido pequeno erro na lista de Mensalidades Pendentes</li>
                    <li>Corrigido erro onde, ao fazer uma pesquisa na <a style="color: rgb(31, 136, 223)" href="listarResponsaveis.php">lista de Responsáveis</a>, a lista normal sumia</li> 
                    <li>Corrigido erro na <a style="color: rgb(31, 136, 223)" href="configuracoesUser.php">escolha de tema e cor</a>. Agora é exibido a cor e o tema atualmente usado
                    <br><span style="color: #ffb74d;">( ~ sugestão por: Kassiano de Freitas Felix ) </li>
                    <li>Correções de erros diversos</li>
                </ul>
            </div>
        </details>
        
        
        
        <details>
            <summary><span style="color: #E32727;">S.I.G.C. 1.0: A primeira versão usável (25/07/2026 - 19:15) - Luiz Felipe Ferrioli Leges</span></summary>

            <!-- Corpo do Card -->
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li><span style="color: #ffb74d;">Adicionado botão na seção <a style="color: rgb(31, 136, 223)" href="listarMensalidades.php">Mensalidades</a> que mostra
                        todos os alunos que ainda não pagaram no mês atual</span></li>
                    <li>Adicionado seção Atualizações para relatar mudanças e versionamento do sistema</li>
                    <li>Adicionado indicador nas seções ainda não finalizadas</li>
                    <li>Adicionado botões de <span style="color: #ffb74d;">arquivar TODOS os Alunos ou Responsáveis</span> e enviá-los para a Lixeira de uma vez só</li>
                    <li>Adicionado versão usual para celular</li>
                </ul>
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de correções</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Corrigidas pequenas diferenças entre alguns temas, como exemplo, o design de tabelas nos temas Azul e Rosa sofrer mudanças sutis em relação ao tema Verde</li>
                    <li>Corrigido erro que impedia a exclusão permanente de todos os Responsáveis arquivados</li> 
                    <li> Corrigido problemas no menu lateral da versão de celular</li>
                </ul>
                
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de Erros e Problemas</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Encontrado erro ao mostrar letras acentuadas</li>
                    <li>Encontrado botão de menu em cima do título da página, ignore por enquanto</li>
                    <li>Encontrado problema que, quando o sistema não acha nenhum cadastro qualquer no banco, simplesmente não mostra as informações na tela. Resolvido temporariamente forçando-o
                    a mostrar a tabela mesmo se não tiver nada escrito, deixando apenas os títulos das colunas</li>
                    <li>Encontrado erro no botão Arquivar sair para fora das linhas das tabelas na versão de celular</li>
                </ul>
            </div>
        </details>
        
        <details>
            <summary>Atualização 0.4 (23/07/2026 - 17h) - Luiz Felipe Ferrioli Leges </summary>

            <!-- Corpo do Card -->
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">

                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Agora o sistema está devidamente hospedado <span style="color: #ffb74d;">na nuvem!</span></li>
                    <li>Adicionado botões de <span style="color: #ffb74d;">restaurar TODOS os Alunos ou Responsáveis arquivados</span> na Lixeira de uma vez só</li>
                    <li>Adicionado botões de <span style="color: #ffb74d;">arquivar TODOS os Alunos ou Responsáveis</span> e enviá-los para a Lixeira de uma vez só</li>
                    <li>Agora os formulários de CADASTRO ou EDIÇÃO de Alunos, Responsáveis e Mensalidades não são mais em página separada. Para isso: 
                        <span style="color: #ffb74d;">Adicionado botões de que abrem um menu flutuante com os formulários.</span> Dessa forma, fica mais eficiente pois não é mais necessário carregar outra página
                    </li>
                </ul>
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de correções</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Removido botões de cadastro, pois agora os formulários ficam em menus flutuantes.</li>
                    <li>Removida coloração diferente que indicava a página que você estava no menu lateral. Feito para resolver um problema interno e otimizar a programação.</li>
                </ul>
                
                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de Erros e Problemas</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Botão de menu em cima do título da página, ignore por enquanto</li>
                    <li>Encontrado problema que, quando o sistema não acha nenhum cadastro qualquer no banco, simplesmente não mostra as informações na tela. Resolvido temporariamente forçando-o
                    a mostrar a tabela mesmo se não tiver nada escrito, deixando apenas os títulos das colunas</li>
                </ul>
            </div>
        </details>
        
        
         <details>
            <summary>Atualização 0.3 (22/07/2026 - 15:50) - Luiz Felipe Ferrioli Leges</summary>
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">

                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Finalizada a seção <span style="color: #ffb74d;">Lixeira</span>.</li>
                    <li>Agora não é mais possível excluir Alunos e Responsáveis pelas listas diretamente. Para isso, deve-se ir até a seção
                        <span style="color: #ffb74d;">Lixeira</span> para restaurar (reverter a "exclusão") ou deletar permanentemente.
                    </li>
                    <li>Alterado botão de Excluir para Arquivar na lista de Alunos, Mensalidade e Responsáveis.</li>
                    
                </ul>

                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de correções</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Removido mensagem extra ao excluir, cadastrar, arquivar ou editar algum registro. Agora o sistema tem apenas o Pop-up de confirmação
                        e, logo após, retorna direto para a tela original.</li>
                    <li>Corrigido erro de ícones não mudarem de cor junto ao sistema.</li>
                    <li>Removida borda branca ao redor das listas, deixando tabelas mais limpas e simplificadas.</li>
                </ul>
            </div>
        </details>

        <details>
            <summary>Atualização 0.2 (20/07/2026 - 22:35) - Luiz Felipe Ferrioli Leges</summary>
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">

                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li><span style="color: #ffb74d;">Descobri como coloca GIFs na página ahsuhduashdua</span></li>
                    <li>Adicionado gerenciamento de <span style="color: #ffb74d;">MENSALIDADES</span></li>
                    <li>Adicionado seção <a style="color: rgb(31, 136, 223)" href="configuracoesUser.php">Preferências</a> onde é possível escolher o tema do sistema, o valor
                        padrão da mensalidade e alternar a visibilidade de dicas</li>
                    <li>Agora o sistema sabe quando é o <span style="color: #ffb74d;">segundo sábado</span> de qualquer mês e ano</li>
                    <li>Agora pode-se fechar a guia do sistema e reabrir <span style="color: #ffb74d;">sem precisar logar de novo</span>, enquanto o navegador estiver aberto</li>
                    <li>Adicionado sistema de <span style="color: #ffb74d;">filtros de pesquisa</span> para pesquisar <a style="color: rgb(31, 136, 223)" href="listarMensalidades.php">Mensalidades</a> </li>
                    <li>Adicionado lista de <span style="color: #ffb74d;">quem ainda não pagou</span></li>
                    <li>Adicionao seção <a style="color: rgb(31, 136, 223)" href="lixeira.php">Lixeira</a> onde ficarão temporariamente os registros excluídos</li>
                </ul>

                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de correções</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Corrigido erro ao cadastrar um Responsável no formulário de Aluno</li>
                    <li>Versão de celular está minimamente melhorada</li>
                    <li>Corrigido erro de design onde tabelas ficavam diferente nos temas claros</li>
                </ul>
            </div>
        </details>


        <details>
            <summary>Atualização 0.1 (13/07/2026 - 18h) - Luiz Felipe Ferrioli Leges </summary>

            <!-- Corpo do Card -->
            <div class="bloco-nota" style="padding: 20px; color: #e0e0e0;">

                <h4 style="color: #ffb74d; margin-top: 25px;">Lista de itens Adicionados/Finalizados</h4>
                <ul style="text-align: left; margin-left: 20px; line-height: 1.6;">
                    <li>Adicionado gerenciamento de <span style="color: #ffb74d;">ALUNOS, RESPONSÁVEIS, ESTAGIÁRIOS e USUÁRIOS</span></li>
                    <li>Agora o sistema está devidamente hospedado <span style="color: #ffb74d;">na nuvem!</span></li>
                </ul>
            </div>
        </details>

    </div>

</body>

</html>