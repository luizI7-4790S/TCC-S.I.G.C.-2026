<?php
include '../controller/conecta.php';
require __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
$qualPdf = $_GET['qualPdf'];

if($qualPdf == "listaAlunos") {
    gerarListaAlunos();
    
} else if ($qualPdf	== "listaResponsaveis") {
    gerarListaResponsaveis();
} else if ($qualPdf	== "listaEstagio") {
    gerarListaEstagio();
} else if ($qualPdf	== "listaRelatorio1") {
     //....
} else if ($qualPdf	== "listaDevedores") {
     gerarListaDevedores();
}

// daqui pra baixo é pra definir as funções, apenas. Daqui pra cima é reservado pro condicional de chamada de função

function gerarListaAlunos() {
	
    $pdf = new Dompdf();
	global $conn; //descobri que precisa desse "global" pra função conseguir ver a variável
    $sqlLista = "SELECT a.*, r.nome AS nome_Resp, r.arquivado AS respArquivado 
                 FROM aluno a 
                 LEFT JOIN responsavel r ON a.id = r.id_aluno 
                 WHERE a.arquivado = 0 
                 ORDER BY  a.id_pelotao, a.nome";

    $resultadoLista = mysqli_query($conn, $sqlLista);

    if ($resultadoLista && mysqli_num_rows($resultadoLista) > 0) {
        $conteudo = '<table><tr>';
        $conteudo .= '<th>Nome Completo</th><th>Nome de guerra</th><th>Responsável</th><th>Número de guerra</th><th>Estagiando</th><th>Monitor</th><th>Graduação</th><th>Pelotão</th>';
        $conteudo .= '</tr>';

        while ($dados = mysqli_fetch_assoc($resultadoLista)) { //nesse while eu pedi pro ChatPGT fazer um tratamento melhor, organizar melhor
            $nome = !empty($dados['nome']) ? htmlspecialchars($dados['nome']) : '<span style="color:red;">Não informado</span>';
            $nomeGuerra = !empty($dados['nome_guerra']) ? htmlspecialchars($dados['nome_guerra']) : '<span style="color:red;">Não informado</span>';

            if (!empty($dados['nome_Resp'])) {
                if ($dados['respArquivado'] == 1) {
                    $nomeResp = '<span style="color:#FF7A2A;">' . htmlspecialchars($dados['nome_Resp']) . '</span>';
                } else {
                    $nomeResp = htmlspecialchars($dados['nome_Resp']);
                }
            } else {
                $nomeResp = '<span style="color:red;">Não informado</span>';
            }

            $numero = !empty($dados['numero']) ? htmlspecialchars($dados['numero']) : '<span style="color:red;">Não informado</span>';
            $estagiando = ($dados['estagiando'] == 1) ? '<span style="color:green;">Sim</span>' : '<span style="color:red;">Não</span>';
            $monitor = ($dados['monitor'] == 1) ? '<span style="color:green;">Sim</span>' : '<span style="color:red;">Não</span>';
            $graduacao = !empty($dados['graduacao']) ? htmlspecialchars($dados['graduacao']) : '<span style="color:red;">Não informado</span>';

            switch ($dados['id_pelotao']) {
                case 1: $pelotao = 'Cobra'; break;
                case 2: $pelotao = 'Águia'; break;
                case 3: $pelotao = 'Tigre'; break;
                case 4: $pelotao = 'Leão'; break;
                case 5: $pelotao = 'Falcão'; break;
                default: $pelotao = '<span style="color:red;">Não informado</span>'; break;//aprendi agora desse default
            }

            $conteudo .= "<tr>
                <td>" .$nome ."</td>
                <td>" . $nomeGuerra . "</td>
                <td>" . $nomeResp . "</td>
                <td>" . $numero . "</td>
                <td>" . $estagiando . "</td>
                <td>" . $monitor . "</td>
                <td>" . $graduacao . "</td>
                <td>" . $pelotao . "</td>
            </tr>";
        }
        $conteudo .= '</table>';
    } else {
        $conteudo = '<h2>Nenhum aluno acadastrado!</h2>';
    }

    $css = '<style>
        body { font-family: Arial, sans-serif; font-size: 10px; } 
        h1 { text-align: center; margin-bottom: 20px; } 
        table { width: 100%; border-collapse: collapse; } 
        th { background-color: #eeeeee; font-weight: bold; } 
        th, td { border: 1px solid #000; padding: 5px; text-align: left; } 
        td { vertical-align: middle; } 
    </style>';

    $conteudo = $css . $conteudo;
    $pdf->loadHtml($conteudo);
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();
    $nome2 = 'Lista-Alunos_SIGC_' . date('d-m-Y'); 
    $pdf->stream($nome2); //Chat deu a dica desse "attachment", aí não precisa baixar 20 pdf diferente pra testar

}

function gerarListaEstagio() {
	
    $pdf = new Dompdf();
	global $conn; //descobri que precisa desse "global" pra função conseguir ver a variável
    $sqlLista = "SELECT * FROM aluno WHERE arquivado = 0 AND estagiando = 1 ORDER BY nome";

    $resultadoLista = mysqli_query($conn, $sqlLista);

    if ($resultadoLista && mysqli_num_rows($resultadoLista) > 0) {
        $conteudo = '<table><tr>';
        $conteudo .= '<th>Nome Completo</th><th>Nome de guerra</th><th>Número de guerra</th><th>Monitor</th><th>Graduação</th>';
        $conteudo .= '</tr>';

        while ($dados = mysqli_fetch_assoc($resultadoLista)) { //nesse while eu pedi pro ChatPGT fazer um tratamento melhor, organizar melhor
            $nome = !empty($dados['nome']) ? htmlspecialchars($dados['nome']) : '<span style="color:red;">Não informado</span>';
            $nomeGuerra = !empty($dados['nome_guerra']) ? htmlspecialchars($dados['nome_guerra']) : '<span style="color:red;">Não informado</span>';
            $numero = !empty($dados['numero']) ? htmlspecialchars($dados['numero']) : '<span style="color:red;">Não informado</span>';
            $monitor = ($dados['monitor'] == 1) ? '<span style="color:green;">Sim</span>' : '<span style="color:red;">Não</span>';
            $graduacao = !empty($dados['graduacao']) ? htmlspecialchars($dados['graduacao']) : '<span style="color:red;">Não informado</span>';

            $conteudo .= "<tr>
                <td>" .$nome ."</td>
                <td>" . $nomeGuerra . "</td>
                <td>" . $numero . "</td>
                <td>" . $monitor . "</td>
                <td>" . $graduacao . "</td>
            </tr>";
        }
        $conteudo .= '</table>';
    } else {
        $conteudo = '<h2>Nenhum aluno em estágio no momento!</h2>';
    }

    $css = '<style>
        body { font-family: Arial, sans-serif; font-size: 10px; } 
        h1 { text-align: center; margin-bottom: 20px; } 
        table { width: 100%; border-collapse: collapse; } 
        th { background-color: #eeeeee; font-weight: bold; } 
        th, td { border: 1px solid #000; padding: 5px; text-align: left; } 
        td { vertical-align: middle; } 
    </style>';

    $conteudo = $css . $conteudo;
    $pdf->loadHtml($conteudo);
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();
    $nome2 = 'Lista-Estagio_SIGC_' . date('d-m-Y'); 
    $pdf->stream($nome2); //Chat deu a dica desse "attachment", aí não precisa baixar 20 pdf diferente pra testar

}

function gerarListaResponsaveis() {
    $pdf = new Dompdf();
    global $conn;

    $sqlLista = "SELECT r.* FROM responsavel r ORDER BY r.nome";
    $resultadoLista = mysqli_query($conn, $sqlLista);

    $conteudo = '';

    if ($resultadoLista && mysqli_num_rows($resultadoLista) > 0) {
        $conteudo .= "<table>
            <tr>
                <th>Nome Completo</th>
                <th>Número (WhatsApp)</th>
                <th>Aluno associado</th>
            </tr>";

        while ($dados = mysqli_fetch_assoc($resultadoLista)) {
            $telefoneProWhats = preg_replace('/\D/', '', $dados['telefone']);
            
            // busca aluno
            $nomeAluno = '<span style="color:red;">Nenhum aluno associado!</span>';
            if (!empty($dados['id_aluno'])) {
                $idAluno = "SELECT nome, arquivado FROM aluno WHERE id = " . intval($dados['id_aluno']);
                $buscaAluno = mysqli_query($conn, $idAluno);
                if ($buscaAluno && mysqli_num_rows($buscaAluno) > 0) {
                    $dadosAluno = mysqli_fetch_assoc($buscaAluno);
                    if ($dadosAluno['arquivado'] == 1) {
                        $nomeAluno = '<span style="color: #FF7A2A;">' . htmlspecialchars($dadosAluno['nome']) . '</span>';
                    } else {
                        $nomeAluno = htmlspecialchars($dadosAluno['nome']);
                    }
                }
            }

            $conteudo .= "<tr>
                <td>" . htmlspecialchars($dados['nome']) . "</td>
                <td>" . htmlspecialchars($dados['telefone']) . "</td>
                <td>" . $nomeAluno . "</td>
            </tr>";
        }
        $conteudo .= '</table>';
    } else {
        $conteudo = '<h2>Nenhum responsável cadastrado!</h2>';
    }

    $css = '<style>
        body { font-family: Arial, sans-serif; font-size: 10px; } 
        table { width: 100%; border-collapse: collapse; } 
        th { background-color: #eeeeee; font-weight: bold; } 
        th, td { border: 1px solid #000; padding: 5px; text-align: left; } 
    </style>';

    $conteudo = $css . $conteudo;
    $pdf->loadHtml($conteudo);
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();
    $nome2 = 'Lista-Responsaveis_SIGC_' . date('d-m-Y'); 
    $pdf->stream($nome2); //Chat deu a dica desse "attachment", aí não precisa baixar 20 pdf diferente pra testar
}

function gerarListaDevedores() {
    $pdf = new Dompdf(); 
    global $conn;
    
    $mesAtual = date('m');
	$anoAtual = date('Y');
    $sqlLista = "SELECT aluno.nome, responsavel.nome AS responsavel_nome, responsavel.telefone AS respTelefone,
                pelotao.nome AS pelotao_nome 
                                FROM aluno
                                LEFT JOIN responsavel ON responsavel.id_aluno = aluno.id
                                LEFT JOIN pelotao ON pelotao.id = aluno.id_pelotao
                                LEFT JOIN mensalidade ON mensalidade.id_aluno = aluno.id 
                                    AND MONTH(mensalidade.data_pagamento) = $mesAtual 
                                    AND YEAR(mensalidade.data_pagamento) = $anoAtual 
                                    AND mensalidade.arquivado = 0 
                                WHERE mensalidade.id IS NULL AND aluno.arquivado = 0 
                                ORDER BY aluno.nome;";

    $resultadoLista = mysqli_query($conn, $sqlLista);
    $conteudo = ""; 

    if ($resultadoLista && mysqli_num_rows($resultadoLista) > 0) {
        $conteudo .= "<table> 
                        <tr> 
                            <th>Aluno</th> 
                            <th>Pelotão</th> 
                            <th>Responsável</th> 
                            <th>Telefone Resp</th>
                        </tr>"; 

        while ($pesquisaNaoPagou = mysqli_fetch_assoc($resultadoLista)) {
            $telefoneProWhats = preg_replace('/\D/', '', $pesquisaNaoPagou['respTelefone']); 
            
            $conteudo .= "<tr> 
                            <td>" . $pesquisaNaoPagou['nome'] . "</td> 
                            <td>" . htmlspecialchars($pesquisaNaoPagou['pelotao_nome']) /*essa bomba desse htmlspecialchars não funcionou */ . "</td> 
                            <td>" . $pesquisaNaoPagou['responsavel_nome'] . "</td> 
                            <td><a target='_blank' href='https://wa.me/" . $telefoneProWhats . "'>" . $pesquisaNaoPagou['respTelefone'] . "</a></td> 
                          </tr>"; 
        }
        $conteudo .= "</table>"; 
    } else {
        $conteudo = "<h2>Ninguém está em dívida!<i class='fa-solid fa-face-smile'></i></h2>"; 
    }

    $css = "<style> 
                body { font-family: Arial, sans-serif; font-size: 10px; } 
                table { width: 100%; border-collapse: collapse; } 
                th { background-color: #eeeeee; font-weight: bold; } 
                th, td { border: 1px solid #000; padding: 5px; text-align: left; } 
            </style>"; 

    $conteudo = $css . $conteudo;
    $pdf->loadHtml($conteudo);
    $pdf->setPaper('A4', 'landscape'); 
    $pdf->render();
    
    $nome2 = "Lista-Devedores_SIGC_" . date('d-m-Y');
    
    $pdf->stream($nome2); 
}
