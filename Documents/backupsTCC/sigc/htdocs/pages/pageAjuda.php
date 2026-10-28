<?php
session_start();
include "../controller/conecta.php";
$id = $_SESSION['id'];

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

?>

<!DOCTYPE html>
<html lang="pt-br">

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
    <div class="card">
            <div class="card-body">
                <label>
                    <a href="manualPopup.php" onclick="window.open(this.href, 'Manual', 'width=400,height=500,scrollbars=yes,resizable=no'); return false;">
                        <button>Vizualização em Janela (Computador)</button>
                    </a>
                </label>
            </div>
        </div>
		<hr>
    
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
                <p>Para associar um Responsável ao aluno escolhido, existem duas formas:</p>
                <ul>
                    <li><b>Eu JÁ cadastrei o Responsável</b>: vá para a seção Responsáveis. Na lista de Responsáveis, localize o Responsável desejado e clique em <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i></button>. Lá, selecione o aluno desejado no campo "Aluno subordinado".</li>
                    
                    <br>
                    
                    <li><b>Ainda NÃO cadastrei o Responsável</b>: vá para a seção Responsáveis e, no topo da tela, localize o botão de cadastro de Responsável. Informe os dados solicitados e selecione o aluno desejado.</li>
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
                    <p>Isso acontece porque o Responsável associado está na Lixeira. A cor laranja serve para alertar que o vínculo aponta para um registro arquivado; não significa, por si só, um erro comprometedor.</p>
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
                <p>Acima da lista, há uma seção de Pesquisa. Digite o nome ou o número do Responsável. Não é necessário informar o nome completo, usar letras maiúsculas ou começar pelas letras iniciais.</p>
			</details>
            <details>
            	<summary>Possíveis problemas</summary>
                <br>
                <details><summary>O nome do Aluno está laranja</summary>
                    <p>Isso acontece porque o Aluno associado está na Lixeira. A cor laranja serve para alertar que o vínculo aponta para um registro arquivado; não significa, por si só, um erro comprometedor.</p>
				</details>
			</details>
        </details>

        <hr>
        <details>
            <summary> <i class="fa-solid fa-user"></i> Estagiários </summary>
            <h4>Essa seção é dedicada para o gerenciamento dos Alunos em Estágio.</h4>
            
            <details>
            	<summary>Como adiciono um Aluno no Estágio?</summary>
                <p>Existem duas formas: vá à seção Alunos, localize o aluno, clique em <button class="botaoTable_editar"> Editar <i class="fa-solid fa-pen-to-square"></i></button> e marque "Sim" no campo "Em estágio?". Ou, no topo da tela na seção Estagiários, clique em 
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
                <p>No topo da tela, abra o formulário de cadastro de usuário. Preencha os campos solicitados e clique em <b>Cadastrar</b> para concluir. Oriente cada usuário a manter sua senha em local seguro e não compartilhá-la.</p>
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
                <p>Não é possível consultar a senha original pela tela do sistema. As senhas devem ser armazenadas de forma protegida, justamente para reduzir o risco de exposição. Se esquecer a senha, será necessário utilizar o procedimento de alteração ou recuperação, caso esteja disponível.</p>
			</details>
            <details>
            	<summary>Há limite de contas de Usuário?</summary>
                <p>O limite depende das configurações e da implementação do sistema. Quando possível, é recomendável criar uma conta individual para cada pessoa autorizada, em vez de compartilhar o mesmo usuário e senha.</p>
			</details>                
        </details>

        <hr>
                <details>
            <summary> <i class="fa-solid fa-piggy-bank"></i> Mensalidades </summary>
            <h4>Essa seção é dedicada para o gerenciamento dos Pagamentos mensais.</h4>
            
            <details>
            	<summary>Como cadastrar um Pagamento?</summary>
                <p>Na tela de Mensalidades, preencha os campos solicitados no formulário — como Aluno, data, valor e forma de pagamento — e confirme o cadastro. Confira os dados antes de salvar para evitar registros incorretos.</p>
			</details>
            <details>
            	<summary>Como excluir um Pagamento?</summary>
                <p>Na lista de mensalidades, localize o pagamento desejado e utilize a opção disponível para arquivá-lo ou excluí-lo. Confira se selecionou o registro correto antes de confirmar.</p>
			</details>
            <details>
            	<summary>Como editar um Pagamento?</summary>
                <p>Localize o pagamento na lista e clique no botão <b>Editar</b>, caso esteja disponível. Altere as informações necessárias e confirme a alteração.</p>
			</details>
            <details>
            	<summary>Como vejo quem ainda não pagou?</summary>
                <p>Na seção de Mensalidades, clique no botão <b>Lista de devedores</b>. Ele mostra os alunos ativos que ainda não possuem um pagamento registrado para o mês atual. Para guardar ou imprimir a relação, utilize <b>Baixar lista</b> para gerar um PDF.</p>
			</details>
            <details>
            	<summary>Como usar os filtros e a pesquisa?</summary>
                <p>Utilize os campos de pesquisa e os filtros disponíveis para localizar mensalidades por data, situação ou forma de pagamento. Combine os filtros conforme necessário para encontrar o registro desejado.</p>
			</details>
            <details>
            	<summary>Possíveis problemas</summary>
                <p>Se um aluno aparecer na lista de devedores mesmo depois de pagar, confira se o pagamento foi cadastrado corretamente e se a data corresponde ao mês atual. A lista é montada a partir dos pagamentos registrados no sistema.</p>
			</details>
                
        </details>
        <hr>
        
        <details>
            <summary> <i class="fa-regular fa-clipboard"></i> Relatórios (EM DESENVOLVIMENTO)</summary>
            <h4>Essa seção é dedicada para Relatórios.</h4>
            
            <details>
            	<summary>Relatório de Inadimplência</summary>
                <p>A proposta é manter um histórico dos alunos que não realizaram o pagamento em cada mês, facilitando a consulta de pendências anteriores. Enquanto a funcionalidade estiver em desenvolvimento, o histórico pode ainda não estar disponível.</p>
			</details>
            <details>
            	<summary>Relatório de adimplência</summary>
                <p>A proposta é identificar os alunos que mantiveram os pagamentos em dia durante o período definido, auxiliando na organização da lista para o sorteio anual. Essa função depende da implementação das regras e do histórico de pagamentos necessários.</p>
			</details>
            <details>
            	<summary>Relatório do total recebido (valor das mensalidades) mensalmente e talvez anualmente (se sobrar tempo e vontade)</summary>
                <p>A proposta é apresentar os valores arrecadados com as mensalidades, organizados por mês e, se implementado, também por ano. Isso facilita acompanhar a arrecadação ao longo do tempo.</p>
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
                <p>Na seção Lixeira, localize o registro que deseja recuperar e utilize a opção de restaurar correspondente, caso esteja disponível. Depois da restauração, o registro poderá voltar a aparecer na seção original.</p>
			</details>
            <details>
            	<summary>Como envio um registro para a Lixeira?</summary>
                <p>Na seção correspondente, localize o registro e clique em <b>Arquivar</b>. Ele será enviado à Lixeira em vez de ser excluído permanentemente.</p>
			</details>
            <details>
            	<summary>Como excluo permanentemente um registro?</summary>
                <p>Na Lixeira, localize o registro e utilize a opção de exclusão permanente, se disponível. Atenção: essa ação pode não permitir a recuperação dos dados. Confira cuidadosamente antes de confirmar.</p>
			</details>
            <details>
            	<summary>Como restauro todos os registros de uma vez?</summary>
                <p>Se houver uma opção de restauração em lote na Lixeira, utilize-a para recuperar os registros arquivados. Antes de confirmar, verifique se deseja restaurar todos eles.</p>
			</details>
        </details>
        <hr>
        
        <details>
            <summary> <i class="fa-solid fa-gear"></i> Preferências</summary>
            <h4>Essa seção é dedicada para pequenas configurações.</h4>
            
            <details>
            	<summary>Mudar tema do sistema</summary>
                <p>Nas Preferências, selecione o tema visual desejado e salve a alteração, caso seja solicitado. Essa opção permite personalizar a aparência do sistema.</p>
			</details>
            <details>
            	<summary>Definir valor da Mensalidade</summary>
                <p>Utilize essa opção para configurar o valor padrão sugerido ao cadastrar uma nova mensalidade. Confira o valor antes de salvar. A alteração do padrão não deve ser entendida como uma mudança automática nos pagamentos já registrados.</p>
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