<?php
session_start();
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensalidades</title>
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
        <li><a class="active" href="listarMensalidades.php"><i class="fa-solid fa-piggy-bank"></i> Mensalidades</a></li>
        <li><a href="arrecadacao.php"><i class="fa-solid fa-hand-holding-dollar"></i> Arrecadação</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Gestão</span></div>
        <li><a href="relatorios.php"><i class="fa-regular fa-clipboard"></i> Relatórios</a></li>
        <li><a href="listarAnotacoes.php"><i class="fa-solid fa-note-sticky"></i> Anotações</a></li>
        <hr>
        <div style="padding: 10px;"><span style="font-size:20px;">Configurações</span></div>
        <li><a href="configuracoesUser.php"><i class="fa-solid fa-gear"></i> Preferências</a></li>
        <li><a href="pageAjuda.php"><i class="fa-solid fa-book-open"></i> Manual do Sistema</a></li>
        <hr>
        <li><a href="destruirSessao.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
    </ul>
    <div class="main-wrapper">
        <div class="card">
            <div class="card-header"> Registrar Mensalidade </div>

            <div class="card-body">
                <div class="bloco-nota">
                    <h3>Nota:</h3>
                    <p>O Sistema reconhece se a mensalidade está em atraso ou em dia de acordo com a data fornecida.</p>
                    <p>Ou seja, sabendo o segundo sábado do mês, o sistema identifica automaticamente o status da mensalidade.</p>
                    <p>Caso o aluno selecionado não possua nenhuma mensalidade atrasada, o sistema irá manter ele na lista de adimplência.</p>
                </div>
                <hr>
                <form action="salvarMensalidade.php" method="POST">


                    <div class="bloco-nota">
                        <h3>Nota:</h3>
                        <?php $mesAtual = date('Y-m-d'); ?>
                        <?php echo date('Y-m-d'); ?>
                        <p>O Segundo Sábado desse mês (<?php echo $mesAtual; ?>) é dia <?php echo date('d', strtotime('second saturday of ' . $mesAtual)); ?></p>
                    </div>



                    <label>
                        <p>Efetuado em:</p>
                        <input type="date" name="data" value="<?php echo date('Y-m-d');?>" required>
                    </label>
                    <label>
                        <p>Valor:</p>
                        <input type="number" name="valor" value="150" step="0.01" required>
                    </label>
                    <label>
                        <p>Aluno:</p>
                        <select name="aluno" required>
                            <option value="" disabled selected>Selecione um aluno</option>
                            <?php
                            include 'conecta.php';
                            $sql = "SELECT * FROM aluno ORDER BY nome";
                            $result = mysqli_query($conn, $sql);
                            while ($dadosAluno = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $dadosAluno['id'] . '">' . $dadosAluno['nome'] . '</option>';
                            }
                            ?>
                            </select>
                    </label>
                    <label>
                        <p>Observação:</p>
                        <textarea name="observacao" rows="6" cols="50" placeholder='Deixe uma mensagem nesse pagamento. Exemplo: "Pago no pix por Fulano"..' required></textarea>
                    </label>
                    <hr>
                        <input type="submit" value="Registrar" disabled class="btn-salvar">
                </form>
            </div>
        </div>
    </div>


</body>

</html>