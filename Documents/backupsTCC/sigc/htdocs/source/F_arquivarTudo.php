<?php
include "../controller/conecta.php";
$acao = $_GET['acao'];
$arquivarOuDesarquivar = ($acao == 1) ? "arquivar" : "desarquivar";
$tipo = $_GET['tipo'];
$redirecionar = "l";

if ($arquivarOuDesarquivar == "arquivar") {
    if ($tipo == "alunos") {
        $sql = "UPDATE aluno SET arquivado = 1 WHERE arquivado = 0";
        $redirecionar = "a";
    } else if ($tipo == "responsaveis") {
        $sql = "UPDATE responsavel SET arquivado = 1 WHERE arquivado = 0";
        $redirecionar = "r";
    } else {
        $sql = "SELECT nome FROM aluno"; //qualquer coisa pro raro evento de dar falso nos dois condicionais. Só por desencargo
    }
    $res = mysqli_query($conn, $sql);
}


else if ($arquivarOuDesarquivar == "desarquivar") {
    if ($tipo == "alunos") {
        $sql = "UPDATE aluno SET arquivado = 0 WHERE arquivado = 1";
        $redirecionar = "l";
    } else if ($tipo == "responsaveis") {
        $sql = "UPDATE responsavel SET arquivado = 0 WHERE arquivado = 1";
        $redirecionar = "l";
    } else if ($tipo == "mensalidades") {
        $sql = "UPDATE mensalidade SET arquivado = 0 WHERE arquivado = 1";
        $redirecionar = "l";
    } else {
        $sql = "SELECT nome FROM aluno"; //qualquer coisa pro raro evento de dar falso nos dois condicionais. Só por desencargo
    }
    $res = mysqli_query($conn, $sql);
}

if ($redirecionar == "a") {
    header("Location: ../pages/listarAlunos.php");
} else if ($redirecionar == "r") {
    header("Location: ../pages/listarResponsaveis.php");
} else if ($redirecionar == "l") {
    header("Location: ../pages/lixeira.php");
}
