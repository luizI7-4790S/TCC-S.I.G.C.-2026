<?php 
function telefoneStr_Num(string $telefone): string {
    return preg_replace('/\D/', '', $telefone);
}
//inutilizado