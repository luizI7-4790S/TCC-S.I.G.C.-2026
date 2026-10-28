<?php
    
function converterMesTexto($data) {
	//pra separar a data
    $data2 = explode('-', $data);
    
    $mes = $data2[1];
    
    if($mes == 1){$mesPorExtenso = "Janeiro";}
    else if($mes == 2){$mesPorExtenso = "Fevereiro";}
    else if($mes == 3){$mesPorExtenso = "Março";}
    else if($mes == 4){$mesPorExtenso = "Abril";}
    else if($mes == 5){$mesPorExtenso = "Maio";}
    else if($mes == 6){$mesPorExtenso = "Junho";}
    else if($mes == 7){$mesPorExtenso = "Julho";}
    else if($mes == 8){$mesPorExtenso = "Agosto";}
    else if($mes == 9){$mesPorExtenso = "Setembro";}
    else if($mes == 10){$mesPorExtenso = "Outubro";}
    else if($mes == 11){$mesPorExtenso = "Novembro";}
    else if($mes == 12){$mesPorExtenso = "Dezembro";}
    //casa 2 do vetor porque a data no sql guardada é ANO-MES-DIA
    return $data2[2] . " de " . $mesPorExtenso . " de " . $data2[0];
}