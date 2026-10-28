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
        <h1>Manual do Sistema</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>
    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>


    <div class="main-wrapper">
        <details>
            <summary>Painel Lateral</summary>
            <h4>À esquerda da tela está o Painel Lateral, onde ficam organizadas as seções do sistema.</h4>
            <p>Serve para facilitar a navegação e separar as funcionalidades do sistema.</p>
            <fieldset class="radio-group">
            <div class="imagem" style="text-align: center; padding: 10px;">
                <img src="../images/setaPainelLateral_pageAjuda.png" style="border-radius: 10px" width="70%" height="70%">
            </div>
            </fieldset>
        </details>

        <hr>

        <details>
            <summary> <i class="fa-solid fa-user-group"></i> Alunos </summary>
            <h4>Essa seção é dedicada para o gerenciamento das informações dos Alunos.</h4>
            
            <details>
            	<summary>Como cadastrar um Aluno?</summary>
                <p>No topo da tela, há um botão 
                    <button type="button" id="abrirCadastro"><i class="fa-solid fa-id-card"></i>Cadastrar Aluno</button>
                    . Nele, informe as informações pedidas e clique em <button type="button" id="abrirCadastro">Cadastrar</button>.</p>
			</details>
            <details>
            	<summary>Como excluir um Aluno?</summary>
                <p>Na tabela dos Alunos, localize o Aluno que deseja excluir e clique em 
                    <button class="botaoTable_excluir botaoAbrir"> Arquivar <i class="fa-solid fa-box-archive"></i></button>
                    .</p>
                <p>O Aluno não será excluído permanentemente, ele será alocado à Lixeira. Isso é uma forma de segurança contra enganos.</p>
			</details>
            <details>
            	<summary>Como editar um Aluno?</summary>
                <p>Na tabela dos Alunos, há o botão <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i></button>. Altere o que desejar e clique em <button type="button" id="abrirCadastro">Alterar informações</button>.</p>
			</details>
            <details>
            	<summary>Como definir um Responsável pro Aluno?</summary>
                <p>Para associar um Responsável ao Aluno escolhido, existem duas formas:</p>
                <ul>
                    <li><b>Eu JÁ cadastrei o Responsável</b>: vá para a seção Responsáveis. Na lista de Responsáveis, localize o Responsável desejado e clique em <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i></button>. Lá, selecione o aluno desejado no campo "Aluno subordinado".</li>
                    
                    <br>
                    
                    <li><b>Ainda NÃO cadastrei o Responsável</b>: vá para a seção Responsáveis e, no topo da tela, localize o botão <button type="button" id="abrirCadastro"><i class="fa-solid fa-id-card"></i>Cadastrar Aluno</button>. Informe as credenciais e selecione o aluno desejado.</li>
                </ul>
			</details>
            <details>
            	<summary>Como usar a Pesquisa de Alunos?</summary>
                <p>Acima da lista, há uma seção de Pesquisa. Nela, digite o nome, o nome de guerra OU o número do aluno. Não precisa ser nome completo. Não precisa usar letras maiúsculas. Não precisam ser as letras iniciais.</p>
			</details>
            <details>
            	<summary>Possíveis problemas</summary>
                <br>
                <details><summary>O nome do Responsável está laranja</summary>
                    <p>Isso acontece pois o Responsável associado está na Lixeira. A cor laranja serve para alertar, mas não significa um erro ou problema comprometedor.</p>
				</details>
            </details>
        </details>

        <hr>
        <details>
            <summary> <i class="fa-solid fa-user-tie"></i> Responsáveis </summary>
            <h4>Essa seção é dedicada para o gerenciamento das informações dos Responsáveis.</h4>
            
            <details>
            	<summary>Como cadastrar um Responsável?</summary>
                <p>No topo da tela, há um botão <button type="button" id="abrirCadastro"><i class="fa-solid fa-id-card"></i>Cadastrar Responsável</button>. Nele, informe as informações pedidas e clique em <button type="button" id="abrirCadastro">Cadastrar</button>.</p>
			</details>
            <details>
            	<summary>Como excluir um Responsável?</summary>
                <p>Na tabela dos Responsáveis, localize o Responsável que deseja excluir e clique em <button class="botaoTable_excluir botaoAbrir"> Arquivar <i class="fa-solid fa-box-archive"></i></button>.</p>
                <p>O Responsável não será excluído permanentemente, ele será alocado à Lixeira. Isso é uma forma de segurança contra enganos.</p>
			</details>
            <details>
            	<summary>Como editar um Responsável?</summary>
                <p>Na tabela dos Responsáveis, há o botão <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i></button>. Altere o que desejar e clique em <button type="button" id="abrirCadastro">Alterar informações</button>.</p>
			</details>
            <details>
            	<summary>Como definir um Responsável pro Aluno?</summary>
                <p>Ao cadastrar um Responsável, selecione o Aluno no campo "Aluno subordinado". Ao editar um Responsável, faça o mesmo processo, caso queira mudar o aluno ou atribuir um aluno.</p>
			</details>
            <details>
            	<summary>Como usar a Pesquisa de Responsáveis?</summary>
                <p>Acima da lista, há uma seção de Pesquisa. Nela, digite o nome, o nome OU o número do Responsável. Não precisa ser nome completo. Não precisa usar letras maiúsculas. Não precisam ser as letras iniciais.</p>
			</details>
            <details>
            	<summary>Possíveis problemas</summary>
                <br>
                <details><summary>O nome do Aluno está laranja</summary>
                    <p>Isso acontece pois o Aluno associado está na Lixeira. A cor laranja serve para alertar, mas não significa um erro ou problema comprometedor.</p>
				</details>
			</details>
        </details>

        <hr>
        <details>
            <summary> <i class="fa-solid fa-user"></i> Estagiários </summary>
            <h4>Essa seção é dedicada para o gerenciamento dos Alunos em Estágio.</h4>
            
            <details>
            	<summary>Como adiciono um Aluno no Estágio?</summary>
                <p>Existem duas formas: vá na seção Alunos, localize o aluno, clique em <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i></button> em marquem "Sim" no campo "Em estágio?". Ou, no topo da tela na seção Estagiários, clique em 
                   <button type="button" id="abrirCadastro"><i class="fa-solid fa-square-check"></i>Atribuir estágio</button>, selecione os Alunos desejados e clique em <button type="button">Atribuir estágio 
                </button>.</p>
			</details>
            <details>
            	<summary>Como removo um Aluno do Estágio?</summary>
                <p>Vá em <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i></button> e marque "Não" no campo "Em estágio?".</p>
			</details>                
        </details>

        <hr>
        <details>
            <summary> <i class="fa-solid fa-user-shield"></i> Usuários & Tela de Login</summary>
            <h4>Essa seção é dedicada para o gerenciamento dos Usuários.</h4>
            <details>
            	<summary>Como cadastrar um Usuário?</summary>
                <p>No topo da tela, há um botão "Abrir formulario de cadastro de Usuário". Nele, informe o que se pede nos campos, anote a senha em um local seguro, e cliquem em "Cadastrar Administrador".</p>
			</details>
            <details>
            	<summary>Como excluir um Usuário?</summary>
                <p>Atente-se: usuários são excluídos direto! Não são alocados à Lixeira.<br>
                Clique em "Excluir" e confirme.</p>
			</details>
            <details>
            	<summary>Como editar a senha de um Usuário? (AINDA NÃO ADICIONADO)</summary>
                <p>Clique em "Alterar senha" ao lado de "Excluir".</p>
			</details>
            <details>
            	<summary>É possível saber a senha de outro Usuário?</summary>
                <p>Não. O S.I.G.C. usa uma tecnologia de segurança onde é impossível descriptografar ("traduzir" de volta pro texto original). É uma forma de segurança.</p>
			</details>
            <details>
            	<summary>Há limite de contas de Usuário?</summary>
                <p>Não. Se precisar, é possível cadastrar inúmeros emails/usuários e senhas. É recomendado, à propósito.</p>
			</details>                
        </details>

        <hr>
                <details>
            <summary> <i class="fa-solid fa-piggy-bank"></i> Mensalidades </summary>
            <h4>Essa seção é dedicada para o gerenciamento dos Pagamentos mensais.</h4>
            
            <details>
            	<summary>Como cadastrar um Pagamento?</summary>
                <p></p>
			</details>
            <details>
            	<summary>Como excluir um Pagamento?</summary>
                <p></p>
			</details>
            <details>
            	<summary>Como editar um Pagamento?</summary>
                <p></p>
			</details>
            <details>
            	<summary>Como vejo quem ainda não pagou?</summary>
                <p></p>
			</details>
            <details>
            	<summary>Como usar a Pesquisa de Responsáveis?</summary>
                <p></p>
			</details>
            <details>
            	<summary>Possíveis problemas</summary>
                <p></p>
			</details>
                
        </details>
        <hr>
        
        <details>
            <summary> <i class="fa-regular fa-clipboard"></i> Relatórios (EM DESENVOLVIMENTO)</summary>
            <h4>Essa seção é dedicada para Relatórios.</h4>
            
            <details>
            	<summary>Relatório de Inadimplência</summary>
                <p>Fazer o sistema salvar quem não pagou mensalidades e quantas cada aluno está devendo</p>
			</details>
            <details>
            	<summary>Relatório de adimplência</summary>
                <p>Fazer o sistema salvar quem nunca atrasou no ano para formar a lista do sorteio anual</p>
			</details>
            <details>
            	<summary>Relatório do total recebido (valor das mensalidades) mensalmente e talvez anualmente (se sobrar tempo e vontade)</summary>
                <p>>:D</p>
			</details>                
        </details>
        <hr>
        
        <details>
            <summary> <i class="fa-solid fa-book"></i> Anotações - INDISPONÍVEL</summary>
            <h4>Essa seção é dedicada para gerenciar notas, avisos, lembretes e anotações.</h4>
            <!--
            <details>
            	<summary>Relatório de Inadimplência</summary>
                <p>Fazer o sistema salvar quem não pagou mensalidades e quantas cada aluno está devendo</p>
			</details>
            <details>
            	<summary>Relatório de adimplência</summary>
                <p>Fazer o sistema salvar quem nunca atrasou no ano para formar a lista do sorteio anual</p>
			</details>
            <details>
            	<summary>Relatório do total recebido (valor das mensalidades) mensalmente e talvez anualmente</summary>
                <p></p>
			</details> -->                
        </details>
        <hr>
        
        <details>
            <summary> <i class="fa-solid fa-trash-can"></i> Lixeira </summary>
            <h4>Essa seção é dedicada para o gerenciamento de registros marcados como exclusos.</h4>
            
            <details>
            	<summary>Para que serve?</summary>
                <p>A Lixeira tem o objetivo de ser uma camada de segurança contra "Excluí sem querer!".</p>
			</details>
            <details>
            	<summary>Como restauro um registro da Lixeira?</summary>
                <p></p>
			</details>
            <details>
            	<summary>Como envio um registro para a Lixeira?</summary>
                <p></p>
			</details>
            <details>
            	<summary>Como excluo permanentemente um registro?</summary>
                <p></p>
			</details>
            <details>
            	<summary>Como restauro todos os registros de uma vez?</summary>
                <p></p>
			</details>
        </details>
        <hr>
        
        <details>
            <summary> <i class="fa-solid fa-gear"></i> Preferências</summary>
            <h4>Essa seção é dedicada para pequenas configurações.</h4>
            
            <details>
            	<summary>Mudar tema do sistema</summary>
                <p></p>
			</details>
            <details>
            	<summary>Definir valor da Mensalidade</summary>
                <p></p>
			</details>
        </details>
        <hr>
        
        
        <details>
            <summary><i class="fa-solid fa-arrows-rotate"></i> Atualizações </summary>
            <h4>Essa seção é dedicada para a listagem de adições, mudanças e correções cotidianas e do desenvolvimento do sistema.</h4>
            
            <details>
            	<summary>Para que serve?</summary>
                <p>Apenas para deixar registrado o processo de produção do sistema como TCC para o Instituto Federal Farroupilha.</p>
			</details>
            <details>
            	<summary>Gif do gato?</summary>
                <p>Por que não?</p>
			</details>
        </details>
        <hr>
                
        <details>
            <summary> <i class="fa-solid fa-right-from-bracket"></i> Botão Sair</summary>
            <h4>Faz logon (sair) e encerra a sessão.</h4>
            
            <details>
            	<summary>Para que serve?</summary>
                <p>Serve para voltar à tela de login e entrar com outro usuário. Também encerra a sessão, ou seja, se alguém tentar reabrir a guia do sistema, dará de cara com a tela de login, e não diretamente no sistema.</p>
			</details>
            
            <details>
            	<summary>O que é uma Sessão?</summary>
                <p>Ao fazer login, a sessão inicia, permitindo o sistema funcionar devidamente.</p>
                <p>Também aumenta a segurança e aumenta a praticidade</p>
                <ul>
                    <li>Se, de alguma forma, alguém burlar a tela de login (passar direto), o sistema bloqueia e joga de volta na tela de login.</li>
                    <li>Se fizer login, fechar a guia e reabrir o site (coterug.site.je), não precisa refazer login enquanto o navegador estiver aberto.</li>
                </ul>
			</details>
        </details>
        <hr>
        
        <details>
            <summary>Documentação de Desenvolvimento do Sistema - Luiz Felipe Leges 2026</summary>
            <div style="text-align: center;">
                <iframe src="../images/tccCoter.pdf" width="100%" height="600px"></iframe> <!-- descobri agora o iframe. Achei SENSACIONAL -->
            </div>
        </details>
    </div>



</body>

</html>