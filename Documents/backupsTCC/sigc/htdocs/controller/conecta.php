<?php
$bdServidor = 'sql112.infinityfree.com'; 
$bdUsuario = 'if0_42392227'; 
$bdSenha = 'Io7GuPR0S0r';
$bdBanco = 'if0_42392227_sigc';
mysqli_report(MYSQLI_REPORT_OFF);
$conn = @mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);
if (!$conn) {
    echo('Erro de conexão: ' . 
        mysqli_connect_error());
    die();
}
