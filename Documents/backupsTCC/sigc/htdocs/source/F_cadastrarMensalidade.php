<?php
include '../controller/conecta.php'; 

$data = isset($_POST['data']) ? $_POST['data'] : '';
$valor = isset($_POST['valor']) ? $_POST['valor'] : '';
$aluno = isset($_POST['aluno']) ? $_POST['aluno'] : '';
$metodo = isset($_POST['metodo_pagamento']) ? $_POST['metodo_pagamento'] : '';
$observacao = isset($_POST['observacao']) ? $_POST['observacao'] : '';

$sqlValorbase = "SELECT * FROM definicoes";
$resultadoValorbase = mysqli_query($conn, $sqlValorbase);
$dados = mysqli_fetch_assoc($resultadoValorbase);
$valor_base = $dados['valorPadraoMensalidade'];

$atrasado = false;
$segundoSabado = date('Y-m-d', strtotime('second Saturday of ' . $data));

if ($data > $segundoSabado) {
    $atrasado = true;
}

// 3. Segurança: Proteção contra SQL Injection (Escapando dados) -- by: assistente do google
$data_sql = mysqli_real_escape_string($conn, $data);
$valor_sql = mysqli_real_escape_string($conn, $valor);
$valor_base_sql = mysqli_real_escape_string($conn, $valor_base);
$aluno_sql = mysqli_real_escape_string($conn, $aluno);
$metodo_sql = mysqli_real_escape_string($conn, $metodo);
$observacao_sql = mysqli_real_escape_string($conn, $observacao);
$atrasado_sql = $atrasado ? 1 : 0;

$sql = "INSERT INTO mensalidade (data_pagamento, valor_pago, valor_base, id_aluno, metodo_pagamento, observacao, atrasado) 
        VALUES ('$data_sql', '$valor_sql', '$valor_base_sql', '$aluno_sql', '$metodo_sql', '$observacao_sql', '$atrasado_sql')";

$resultado = mysqli_query($conn, $sql);

//header("Location: ../pages/listarMensalidades.php");
if ($resultado && mysqli_affected_rows($conn) > 0) {
   echo "<script>alert('Mensalidade registrada com sucesso!'); window.location.href='../pages/listarMensalidades.php';</script>";
} else {
    echo "<script>alert('Houve um erro...'); window.location.href='../pages/listarMensalidades.php';</script>";
}
?>
