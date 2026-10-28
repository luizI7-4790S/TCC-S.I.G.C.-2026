<?php
session_start();
include "../controller/conecta.php";

$id = $_SESSION['id'];

// de cara já verifica se tem sessão existente
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sqlAdmin = "SELECT * FROM administrador WHERE id = '$id'";
    $resAdmin = mysqli_query($conn, $sqlAdmin);
    $dadosAdmin = mysqli_fetch_assoc($resAdmin);
    $_SESSION["tema"] = $dadosAdmin["tema"];
} else {
    header('Location: login.php');
    exit;
}

function converterNumMes($mes) {
    if ($mes == 1) { $mesPorExtenso = "Janeiro"; }
    else if ($mes == 2) { $mesPorExtenso = "Fevereiro"; }
    else if ($mes == 3) { $mesPorExtenso = "Março"; }
    else if ($mes == 4) { $mesPorExtenso = "Abril"; }
    else if ($mes == 5) { $mesPorExtenso = "Maio"; }
    else if ($mes == 6) { $mesPorExtenso = "Junho"; }
    else if ($mes == 7) { $mesPorExtenso = "Julho"; }
    else if ($mes == 8) { $mesPorExtenso = "Agosto"; }
    else if ($mes == 9) { $mesPorExtenso = "Setembro"; }
    else if ($mes == 10) { $mesPorExtenso = "Outubro"; }
    else if ($mes == 11) { $mesPorExtenso = "Novembro"; }
    else if ($mes == 12) { $mesPorExtenso = "Dezembro"; }
    return $mesPorExtenso;
}

function percentualPagamentos($num) {
    include "../controller/conecta.php";
    $sql = "SELECT COUNT(id) as numero FROM aluno WHERE arquivado = 0";
    $resultado = mysqli_query($conn, $sql);
    $numAlunos = mysqli_fetch_assoc($resultado); 
    
    $porcentagem = $num / $numAlunos['numero'];
    
    return $porcentagem . '%';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
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
<body data-theme='<?php echo $tema; ?>'>
    <!-- 1. OBRIGATÓRIO: O controle do menu fica no topo do body para o CSS funcionar -->
    <input type="checkbox" id="menu-toggle" style="display: none;">
    <header>
        <!-- 2. O label aponta para o ID do input acima -->
        <h1>Relatórios</h1>
        <label for="menu-toggle" class="hamburger">☰</label>
    </header>

    <?php
    include "../source/imprimirSidebar.php";
    echo imprimirSidebar();
    ?>

    <div class="main-wrapper">
        <details>
            <summary>Informações</summary>
            <div class="card-body">
                <h2 class="h2Dialog">Seção Relatórios mensais</h2>
                <div class="bloco-nota">
                    <h3>Relatórios:</h3>
                    <p>Aqui ficam os relatórios dos meses do ano. Nessa seção, você pode ver todos que PAGARAM ATRASADO no mês referente.</p>
                    <p>Atente-se: NÃO são mostrados quem NÃO PAGOU no mês, mas, sim, quem acertou de forma atrasada.</p>
                    <p>Aqui também é destinado à junção de todos os geradores de PDFs do sistema.</p>
                </div>
            </div>
        </details>

        <div class="card">
            <div class="card-body">
                <label>
                    <a href="../source/F_gerarPDF.php?qualPdf=listaAlunos">
                        <button>Gerar PDF - ALUNOS</button>
                    </a>
                </label>
                <label>
                    <a href="../source/F_gerarPDF.php?qualPdf=listaResponsaveis">
                        <button>Gerar PDF - RESPONSÁVEIS</button>
                    </a>
                </label>
                <label>
                    <a href="../source/F_gerarPDF.php?qualPdf=listaEstagio">
                        <button>Gerar PDF - ESTAGIÁRIOS</button>
                    </a>
                </label>
                <label>
                    <a href="../source/F_gerarPDF.php?qualPdf=listaDevedores">
                        <button>Gerar PDF - DEVEDORES</button>
                    </a>
                </label>
            </div>
        </div>

        <br>

        
                <?php
                include "../controller/conecta.php";
                // ideias mirabolantes
                $mesAtual = date('m');
                $anoAtual = date('Y');
                $haAtrasos = false;

                for ($i = 1; $i <= $mesAtual; $i++) {
                    $mes = $i; // pra pegar os meses até o atual

                    // pega os alunos que tiverem mensalidade com atrasado = 1 no mês do loop
                    $sqlAtrasaram = "
                        SELECT aluno.*, COUNT(mensalidade.id) AS totalAtrasos 
                        FROM aluno 
                        INNER JOIN mensalidade ON mensalidade.id_aluno = aluno.id 
                        WHERE aluno.arquivado = 0 
                          AND mensalidade.arquivado = 0 
                          AND mensalidade.atrasado = 1 
                          AND MONTH(mensalidade.data_pagamento) = $mes 
                          AND YEAR(mensalidade.data_pagamento) = $anoAtual 
                        GROUP BY aluno.id
                    ";
                    $resultado = mysqli_query($conn, $sqlAtrasaram);
                    $numAtrasos = 0;
                    if (mysqli_num_rows($resultado) > 0) {
                        $haAtrasos = true;
                        // se tiver algum atraso no mês, mostra um details organizadinho na tela
                        ?>
        				<div class="card">
                            <div class="card-header">Meses com pagamentos atrasados em <?php echo date('Y'); ?></div>
                            <div class="card-body">
                            <details>
                                <summary>Pagamentos atrasados de <?php echo converterNumMes($mes) . " de " . $anoAtual; ?></summary>
                                <table>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Nome de Guerra</th>
                                        <th>Pelotão</th>
                                        <th>Responsável</th>
                                    </tr>

                                    <?php while ($naoPagaram = mysqli_fetch_assoc($resultado)) { 
                                        $numAtrasos++;
                                    ?>
                                        <tr>
                                            <td><?php echo $naoPagaram['nome']; ?></td>
                                            <td><?php echo $naoPagaram['nome_guerra']; ?></td>
                                            <td>
                                                <?php
                                                if ($naoPagaram['id_pelotao'] == 1) {
                                                    echo 'Cobra';
                                                } else if ($naoPagaram['id_pelotao'] == 2) {
                                                    echo 'Águia';
                                                } else if ($naoPagaram['id_pelotao'] == 3) {
                                                    echo 'Tigre';
                                                } else if ($naoPagaram['id_pelotao'] == 4) {
                                                    echo 'Leão';
                                                } else if ($naoPagaram['id_pelotao'] == 5) {
                                                    echo 'Falcão';
                                                } else {
                                                    echo '<span style="color:red;">Não informado</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $idAluno = $naoPagaram['id'];
                                                $sqlPai = "SELECT nome, arquivado FROM responsavel WHERE arquivado = 0 AND id_aluno = '$idAluno'";
                                                $resultadoPai = mysqli_query($conn, $sqlPai);
                                                $nomePai = mysqli_fetch_assoc($resultadoPai);
                                                $nomeResp = '<span style="color: red;">Não informado</span>';

                                                if ($nomePai['nome'] != NULL) {
                                                    if ($nomePai['arquivado'] == 1) {
                                                        $nomeResp = '<span style="color: #FF7A2A;">' . $nomePai['nome'] . '</span>';
                                                    } else {
                                                        $nomeResp = $nomePai['nome'];
                                                    }
                                                }
                                                echo $nomeResp;
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <h3></h3>
                            </details></div>
        				</div>
        				<br>
                        <?php
                    } else {
                        continue; // se não existir 1 atraso, pula pro próximo mês
                    }
                }

                ?>
            
                <?php if ($haAtrasos == false) { ?>
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h2Dialog">Não existem atrasos desde o início do ano até <?php echo converterNumMes($mesAtual); ?>!🙌
                            </h2>
                            <div style="text-align: center;">
                                <img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExNGI3dDRiYW5ha3YzMmc5cHc1cmk0b3JvNHlhZ3hwcjR4dmd0OTg1aiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/YnkMcHgNIMW4Yfmjxr/giphy.gif"
                                    alt="meme do gato kkkskssjkfdlkjflk" width="150px" height="150px"
                                    style="border: 2px solid #1e1e1e; border-radius:50%;">
                            </div>
                            <hr>
                            <p>Isso pode significar duas causas:</p>
                            <ul>
                                <li>Não existem pagamentos registrados no sistema</li>
                                <li>Ou todo mundo está em dia!</li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
    </div>
</body>
</html>
