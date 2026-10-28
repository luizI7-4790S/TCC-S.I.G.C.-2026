<?php
session_start();
$id = $_SESSION['id'];
include "../controller/conecta.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrecadação - Lixeira</title>
    <?php
    include "../source/verStyle.php";
    $tema = buscarTema($id);
    ?>
    <link rel="stylesheet" href="../styles/style_CLOUDE.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../images/logoCoter.png" type="image/x-icon">
</head>

<body data-theme='<?php echo $tema ?>'>
    <input type="checkbox" id="menu-toggle" style="display: none;">

    <header>
        <h1>Lixeira</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>
    <?php
    include "../source/imprimirSidebar.php";
    echo imprimirSidebar();
    ?>

    <div class="main-wrapper">
        <div class="content">
            <details>
                <summary>Abrir informações sobre a Lixeira</summary>
                    <div class="card-body">
                        <h2 class="h2Dialog">Seção de registros arquivados</h2>
                        <div class="bloco-nota">
                            <h3>Arquivados:</h3>
                            <p>Registros arquivados são considerados "pré-excluídos". Ao arquivar um aluno, por exemplo, ele virá para cá e contará como excluído.</p>
                            <p>Aqui você pode excluir permanentemente um registro, se assim preferir.</p>
                            <p>Essa seção visa ser uma camada de segurança contra exclusão por engano.</p>
                            <hr>
                            <p>A Lixeira abriga apenas registros de Alunos e Responsáveis por serem registros mais importantes quando comparados à uma anotação, por exemplo.</p>
                            <p>As Mensalidades também são arquivadas antes de serem excluídas, mas não são mostradas aqui.
                                Para vê-las, vá para a seção <a style="color: rgb(31, 136, 223)" href="listarMensalidades.php">Mensalidades</a>.</p>
                        </div>
                    </div>
            </details>
            <hr>

            <?php
            include "../controller/conecta.php";

            $sqlAlunosNaLixeira = "SELECT * FROM aluno WHERE arquivado = TRUE";
            $resultadoAlunosNaLixeira = mysqli_query($conn, $sqlAlunosNaLixeira);
            if (mysqli_num_rows($resultadoAlunosNaLixeira) > 0) { ?>
                <details>
                    <summary>Alunos arquivados</summary>
					<br>
                    <div class="card-header">
                        <button id="abrirLimpezaAlunos" class="botaoTable_excluir">Excluir alunos na lixeira <i class="fa-solid fa-broom"></i></button>
                        <button id="abrirPerguntaRestauroTudoALUNOS">Restaurar todos ALunos<i class="fa-solid fa-trash-arrow-up"></i></button>
                    </div>
                        <table>
                            <tr>
                                <th>Nome Completo</th>
                                <th>Nome de guerra</th>
                                <th>Número de guerra</th>
                                <th>Estagiando</th>
                                <th>Monitor</th>
                                <th>Graduação</th>
                                <th>Pelotão</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            while ($dadosAlunosNaLixeira = mysqli_fetch_assoc($resultadoAlunosNaLixeira)) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo ($dadosAlunosNaLixeira['nome']) ? $dadosAlunosNaLixeira['nome'] : '<span style="color:red;">Não informado</span>'; ?>
                                    </td>
                                    <td>
                                        <?php echo ($dadosAlunosNaLixeira['nome_guerra']) ? $dadosAlunosNaLixeira['nome_guerra'] : '<span style="color:red;">Não informado</span>'; ?>
                                    </td>
                                    <td>
                                        <?php echo ($dadosAlunosNaLixeira['numero']) ? $dadosAlunosNaLixeira['numero'] : '<span style="color:red;">Não informado</span>'; ?>
                                    </td>
                                    <td>
                                        <?php echo ($dadosAlunosNaLixeira['estagiando'] == 1) ? '<span style="color:green;">Sim</span>' : '<span style="color:red;">Não</span>'; ?>
                                    </td>
                                    <td>
                                        <?php echo ($dadosAlunosNaLixeira['monitor'] == 1) ? '<span style="color:green;">Sim</span>' : '<span style="color:red;">Não</span>'; ?>
                                    </td>
                                    <td>
                                        <?php echo $dadosAlunosNaLixeira['graduacao']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($dadosAlunosNaLixeira['id_pelotao'] == 1) echo 'Águia';
                                        else if ($dadosAlunosNaLixeira['id_pelotao'] == 2) echo 'Falcão';
                                        else if ($dadosAlunosNaLixeira['id_pelotao'] == 3) echo 'Tigre';
                                        else if ($dadosAlunosNaLixeira['id_pelotao'] == 4) echo 'Leão';
                                        else if ($dadosAlunosNaLixeira['id_pelotao'] == 5) echo 'Cobra';
                                        else echo '<span style="color:red;">Não informado</span>';
                                        ?>
                                    </td>
                                    <td class="acoes">
                                        <button style="padding-left: 32%; padding-right: 32%;" class="botaoTable_editar btn-restaurar" data-id="<?php echo $dadosAlunosNaLixeira['id']; ?>" data-tipo="aluno">
                                            <i class="fa-solid fa-trash-arrow-up"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </table>
                </details>
            <?php
            } else { ?>
                <div class="card">
                    <div class="card-header">Alunos arquivados</div>
                    <div class="card-body">
                        <h2 class="h2Dialog">Nenhum aluno arquivado.</h2>
                        <h4 class="pDialog">Os cadastros de aluno arquivados aparecerão aqui. Você pode reverter a ação.</h4>
                        <div class="botoesDialog">
                            <a href="listarAlunos.php"><button class="botaoDialog">Ver lista de Alunos</button></a>
                            <a href="inicio.php"><button class="botaoDialog">Voltar para a página inicial</button></a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php
            include "../controller/conecta.php";
            $sqlRespsNaLixeira = "SELECT * FROM responsavel WHERE arquivado = TRUE";
            $resultadoRespsNaLixeira = mysqli_query($conn, $sqlRespsNaLixeira);
            if (mysqli_num_rows($resultadoRespsNaLixeira) > 0) { ?>
                <details>
                    <summary>Responsáveis arquivados</summary>
                    <br>
                    <div class="card-header"><button id="abrirLimpezaResponsaveis" class="botaoTable_excluir">Excluir responsáveis na lixeira <i class="fa-solid fa-broom"></i></button>
                        <button id="abrirPerguntaRestauroTudoRESPS">Restaurar todos Responsáveis<i class="fa-solid fa-trash-arrow-up"></i></button>
                    </div>
                        <table>
                            <tr>
                                <th>Nome</th>
                                <th>Número (WhatsApp)</th>
                                <th>Aluno associado</th>
                                <th>Identificador</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            while ($dadosRespsNaLixeira = mysqli_fetch_assoc($resultadoRespsNaLixeira)) {
                            ?>
                                <tr>
                                    <td><?php echo $dadosRespsNaLixeira['nome']; ?></td>
                                    <td><?php echo $dadosRespsNaLixeira['telefone']; ?></td>
                                    <td>
                                        <?php
                                        $idAluno = "SELECT nome FROM aluno WHERE id =" . $dadosRespsNaLixeira['id_aluno'];
                                        $buscaAluno = mysqli_query($conn, $idAluno);
                                        if (mysqli_num_rows($buscaAluno) > 0) {
                                            $nomeAluno = mysqli_fetch_assoc($buscaAluno);
                                            echo $nomeAluno['nome'];
                                        } else {
                                            echo '<span style="color:red;">Nenhum aluno associado!</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $dadosRespsNaLixeira['id']; ?></td>
                                    <td class="acoes">
                                        <button style="padding-left: 32%; padding-right: 32%;" class="botaoTable_editar btn-restaurar" data-id="<?php echo $dadosRespsNaLixeira['id']; ?>" data-tipo="responsavel">
                                            <i class="fa-solid fa-trash-arrow-up"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                </details>
            <?php } else { ?>
                <div class="card">
                    <div class="card-header">Responsáveis arquivados</div>
                    <div class="card-body">
                        <h2 class="h2Dialog">Nenhum responsável arquivado.</h2>
                        <h4 class="pDialog">Os cadastros de responsável arquivados aparecerão aqui. Você pode reverter a ação.</h4>
                        <div class="botoesDialog">
                            <a href="listarResponsaveis.php"><button class="botaoDialog">Ver lista de Responsáveis</button></a>
                            <a href="inicio.php"><button class="botaoDialog">Voltar para a página inicial</button></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


    <dialog id="modalDesarquivarTudoALUNOS">
        <h2 class="h2Dialog">Restaurar TODOS Alunos?</h2>
        <h4 class="pDialog">Todos os Alunos serão removidos da lixeira e desarquivados. Você pode reverter essa ação facilmente.</h4>
        <h4 class="pDialog">Prosseguir?</h4>
        <div class="botoesDialog">
            <button id="fecharPerguntaRestauroTudoALUNOS">Cancelar</button>
            <button id="desarquivarTudoALUNOS">Restaurar</button>
        </div>
    </dialog>

    <dialog id="modalDesarquivarTudoRESPS">
        <h2 class="h2Dialog">Restaurar TODOS Responsáveis?</h2>
        <h4 class="pDialog">Todos os Responsáveis serão removidos da lixeira e desarquivados. Você pode reverter essa ação facilmente.</h4>
        <h4 class="pDialog">Prosseguir?</h4>
        <div class="botoesDialog">
            <button id="fecharPerguntaRestauroTudoRESPS">Cancelar</button>
            <button id="desarquivarTudoRESPS">Restaurar</button>
        </div>
    </dialog>


    <dialog id="modalRestaurar">
        <h2 class="h2Dialog">Restaurar?</h2>
        <h4 class="pDialog">O registro selecionado será removido da lixeira e desarquivado.</h4>
        <h4 class="pDialog">Prosseguir?</h4>
        <div class="botoesDialog">
            <button id="fecharRestauro">Cancelar</button>
            <button id="confirmarRestauro">Restaurar</button>
        </div>
    </dialog>

    <dialog id="modalLimparTudo">
        <h2 class="h2Dialog">Atente-se! <i class="fa-solid fa-triangle-exclamation" style="color: rgb(179, 0, 0);"></i></h2>
        <h4 class="pDialog">Todos os itens arquivados nessa seção serão apagados permanentemente.</h4>
        <h4 class="pDialog">Você não poderá reverter essa ação!</h4>
        <h4 class="pDialog">Prosseguir?</h4>
        <div class="botoesDialog">
            <button id="cancelarLimpeza">Cancelar</button>
            <button id="confirmarLimpeza">Apagar permanentemente</button>
        </div>
    </dialog>

    <script>
        // Guardam os dados do item selecionado no momento do clique
        let itemSelecionadoId = null;
        let itemSelecionadoTipo = null;

        // Referências dos modais
        const modalRestaurar = document.getElementById('modalRestaurar');
        const modalLimparTudo = document.getElementById('modalLimparTudo');

        // --- LÓGICA DO POPUP DE RESTAURAR ITEM ---
        document.querySelectorAll('.btn-restaurar').forEach(botao => {
            botao.addEventListener('click', () => {
                itemSelecionadoId = botao.getAttribute('data-id');
                itemSelecionadoTipo = botao.getAttribute('data-tipo');

                modalRestaurar.showModal();
            });
        });

        document.getElementById('fecharRestauro').addEventListener('click', () => {
            modalRestaurar.close();
            itemSelecionadoId = null;
            itemSelecionadoTipo = null;
        });

        document.getElementById('confirmarRestauro').addEventListener('click', () => {
            if (itemSelecionadoId && itemSelecionadoTipo) {
                window.location.href = `../source/F_restaurarDaLixeira.php?id=${itemSelecionadoId}&tipo=${itemSelecionadoTipo}`;
            }
        });

        // ---------- LIMPAR LIXEIRA ----------
        let tipoLimpeza = "";

        // Botão de excluir ALUNOS
        const btnLimpezaAlunos = document.getElementById("abrirLimpezaAlunos");
        if (btnLimpezaAlunos) {
            btnLimpezaAlunos.addEventListener("click", () => {
                tipoLimpeza = "alunos";
                modalLimparTudo.showModal();
            });
        }

        // Botão de excluir RESPONSÁVEIS
        const btnLimpezaResponsaveis = document.getElementById("abrirLimpezaResponsaveis");
        if (btnLimpezaResponsaveis) {
            btnLimpezaResponsaveis.addEventListener("click", () => {
                tipoLimpeza = "responsaveis";
                modalLimparTudo.showModal();
            });
        }

        // Cancelar
        document.getElementById("cancelarLimpeza").addEventListener("click", () => {
            modalLimparTudo.close();
            tipoLimpeza = "";
        });

        // Confirmar
        document.getElementById("confirmarLimpeza").addEventListener("click", () => {
            modalLimparTudo.close();

            if (tipoLimpeza === "alunos") {
                window.location.href = "../source/F_excluirAlunosDaLixeira.php";
            } else if (tipoLimpeza === "responsaveis") {
                window.location.href = "../source/F_excluirResponsaveisDaLixeira.php";
            }

            tipoLimpeza = "";
        });


        // ---------- RESTAURAR TODOS RESPONSÁVEIS ----------
        const modalDesarquivarTudoRESPONSAVEIS = document.getElementById("modalDesarquivarTudoRESPS");
        const btnAbrirRestauroRESPS = document.getElementById("abrirPerguntaRestauroTudoRESPS");
        const btnFecharRestauroRESPS = document.getElementById("fecharPerguntaRestauroTudoRESPS");
        const btnDesarquivarRESPS = document.getElementById("desarquivarTudoRESPS");

        if (btnAbrirRestauroRESPS) {
            btnAbrirRestauroRESPS.addEventListener("click", () => {
                modalDesarquivarTudoRESPONSAVEIS.showModal();
            });
        }

        if (btnFecharRestauroRESPS) {
            btnFecharRestauroRESPS.addEventListener("click", () => {
                modalDesarquivarTudoRESPONSAVEIS.close();
            });
        }

        if (btnDesarquivarRESPS) {
            btnDesarquivarRESPS.addEventListener('click', () => {
                modalDesarquivarTudoRESPONSAVEIS.close();
                window.location.href = "../source/F_arquivarTudo.php?tipo=responsaveis&acao=0";
            });
        }


        // ---------- RESTAURAR TODOS ALUNOS ----------
        const modalDesarquivarTudoALUNOS = document.getElementById("modalDesarquivarTudoALUNOS");
        const btnAbrirRestauroALUNOS = document.getElementById("abrirPerguntaRestauroTudoALUNOS");
        const btnFecharRestauroALUNOS = document.getElementById("fecharPerguntaRestauroTudoALUNOS");
        const btnDesarquivarALUNOS = document.getElementById("desarquivarTudoALUNOS");

        if (btnAbrirRestauroALUNOS) {
            btnAbrirRestauroALUNOS.addEventListener("click", () => {
                modalDesarquivarTudoALUNOS.showModal();
            });
        }

        if (btnFecharRestauroALUNOS) {
            btnFecharRestauroALUNOS.addEventListener("click", () => {
                modalDesarquivarTudoALUNOS.close();
            });
        }

        if (btnDesarquivarALUNOS) {
            btnDesarquivarALUNOS.addEventListener('click', () => {
                modalDesarquivarTudoALUNOS.close();
                window.location.href = "../source/F_arquivarTudo.php?tipo=alunos&acao=0";
            });
        }
    </script>
</body>

</html>