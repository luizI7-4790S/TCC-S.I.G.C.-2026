<?php
    //easy
function buscarTema($idAdmin) {
	include "../controller/conecta.php";
    $sql = "SELECT tema FROM administrador WHERE id='$idAdmin'"; 
    $resultado = mysqli_query($conn, $sql);
    
    $tema = mysqli_fetch_assoc($resultado);
    if ($tema['tema'] == 'verdeEscuro') { // verde claro
        $style = 'verde-escuro';
    } else if ($tema['tema'] == 'verdeClaro') { // VERDE CLARO
        $style = 'verde-claro';
    } else if ($tema['tema'] == 'azulEscuro') { // AZUL ESCURO
        $style = 'azul-escuro';
    } else if ($tema['tema'] == 'azulClaro') { // AZUL CLARO
        $style = 'azul-claro';
    } else if ($tema['tema'] == 'rosaEscuro') { // ROSA ESCURO
        $style = 'rosa-escuro';
    } else if ($tema['tema'] == 'rosaClaro') { // ROSA CLARO
        $style = 'rosa-claro';
    } else { // PADRÃO
        $style = 'verde-escuro';
    }
    
    return $style;
}