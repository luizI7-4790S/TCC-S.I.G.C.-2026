<?php
    
    include "conecta.php";

	$sql = "SELECT * FROM aluno WHERE pelotao_id != 1 AND estagiando = 1 AND arquivado = 0";
	$resultado = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($resultado) > 0) {
        $divDeAlerta = '
        
               
        
        ';
    }