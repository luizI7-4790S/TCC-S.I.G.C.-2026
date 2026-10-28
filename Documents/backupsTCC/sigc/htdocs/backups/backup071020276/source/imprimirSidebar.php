<?php
function imprimirSidebar() {
/*    $sidebar = '
    <ul class="sidenav">
        <li><a href="index.php"><i class="fa-solid fa-house"></i> Início</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Pessoas</span></div>
        <li><a href="listarAlunos.php"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a href="listarResponsaveis.php"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
        <li><a href="listarEstagiario.php"><i class="fa-solid fa-user"></i> Estagiários</a></li>
        <li><a href="listarUsuarios.php"><i class="fa-solid fa-user-shield"></i> Usuários</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Valores</span></div>
        <li><a href="listarMensalidades.php" class="emManutencao"><i class="fa-solid fa-piggy-bank"></i> Mensalidades</a></li>
        <li><a href="arrecadacao.php" class="emManutencao"><i class="fa-solid fa-hand-holding-dollar"></i> Arrecadação</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Gestão</span></div>
        <li><a href="relatorios.php"><i class="fa-regular fa-clipboard"></i> Relatórios</a></li>
        <li><a href="listarAnotacoes.php"><i class="fa-solid fa-book"></i> Anotações</a></li>
        <li><a href="lixeira.php"><i class="fa-solid fa-trash-can"></i> Lixeira</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Configurações</span></div>
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <li><a href="pageAjuda.php"><i class="fa-solid fa-book-open"></i> Manual do Sistema</a></li>
        <li><a href="atualizacoes.php"><i class="fa-solid fa-arrows-rotate"></i> Atualizações</a></li>
        <hr>
        <li><a href="../source/destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>';*/
    
    
        $sidebar = '
    <ul class="sidenav">
        <li><a href="inicio.php"><i class="fa-solid fa-house"></i> Início</a></li>
        
        <span class="sidenav-section">Pessoas</span>
        
        <li><a href="listarAlunos.php"><i class="fa-solid fa-user-group"></i> Alunos</a></li>
        <li><a href="listarResponsaveis.php"><i class="fa-solid fa-user-tie"></i> Responsáveis</a></li>
        <li><a href="listarEstagiario.php"><i class="fa-solid fa-user"></i> Estagiários</a></li>
        <li><a href="listarUsuarios.php"><i class="fa-solid fa-user-shield"></i> Usuários</a></li>
        
        <span class="sidenav-section">Gestão</span>
        <li><a href="listarMensalidades.php"><i class="fa-solid fa-piggy-bank"></i> Mensalidades</a></li>
        
        <li><a href="relatorios.php"><i class="fa-regular fa-clipboard"></i> Relatórios</a></li>
        <li><a href="lixeira.php"><i class="fa-solid fa-trash-can"></i> Lixeira</a></li>
        
        <span class="sidenav-section">Sistema</span>
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <li><a href="pageAjuda.php"><i class="fa-solid fa-book-open"></i> Manual do Sistema</a></li>
        <li><a href="atualizacoes.php"><i class="fa-solid fa-arrows-rotate"></i> Atualizações</a></li>
        
        <span class="sidenav-section"></span>
    <li><a href="../source/destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>
    ';
    
    //<li><a href=""><i class="fa-solid fa-book"></i> Anotações (EM BREVE)</a></li>
    
    return $sidebar;
}
?>
