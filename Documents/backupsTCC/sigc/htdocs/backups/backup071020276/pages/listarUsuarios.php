<?php
// FEITO
include "../controller/conecta.php";
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM administrador WHERE id = $id";
$resultado = mysqli_query($conn, $sql);
$dadosAdmin = mysqli_fetch_assoc($resultado);

$msg = '';
if ($_POST) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    include "conecta.php";
    $sql = "INSERT INTO administrador (usuario, senha, nome) VALUES ('$email', '$senha', '$nome')";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $msg = "<div class='bloco-nota'>
                    <h3>Sucesso!</h3>
                    <p>Cadastro efetuado com sucesso.</p>
                </div>";
    } else {
        $msg = "<div class='bloco-nota' style='border-left-color: #d32f2f;'>
                    <h3 style='color: #d32f2f;'>Erro</h3>
                    <p style='color: #ef5350;'>Falha ao cadastrar. Tente novamente.</p>
                </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <?php
    include "../source/verStyle.php";
    $tema = buscarTema($id);
    ?>
    <link rel="stylesheet" href="../styles/style_CLOUDE.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="../images/logoCoter.png" type="image/x-icon">
</head>

<body data-theme='<?php echo $tema ?>'>
    <!-- 1. OBRIGATÓRIO: O controle do menu fica no topo do body para o CSS funcionar -->
    <input type="checkbox" id="menu-toggle" style="display: none;">

    <header>
        <!-- 2. O label aponta para o ID do input acima -->
        <h1>Usuários</h1>
        <label for="menu-toggle" class="hamburger">&#9776;</label>
    </header>

    <?php include "../source/imprimirSidebar.php";
    echo imprimirSidebar(); ?>


    <dialog id="modalCadastro" style="max-width:900px;width:90%;">

        <div class="card-header" style="border-radius: 5px;">
            <button type="button" id="fecharCadastro">
                Fechar Formulário
            </button>
        </div>
        <br>
        <details>
            <summary>Abrir informações</summary>
            <div class="bloco-nota">
            <p>O novo usuário terá permissão total ao sistema. Cuide o acesso!</p>
            <p>Você também pode criar vários usuários caso venha a esquecer a senha ou credencial de login.
            </p>
            <p>O que muda de um usuário para outro?</p>
            <p><i class="fa-solid fa-arrow-right"></i> Credenciais de entrada;</p>
            <p><i class="fa-solid fa-arrow-right"></i> Tema do sistema;</p>
            </div>
        </details>
        <hr>
        <form action="../source/F_cadastrarUsuario.php" method="POST">

            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" placeholder="Nome do administrador" required />
            </div>
            <br>
            <div class="form-group">
                <label for="email">Usuário (E-mail)</label>
                <input type="text" id="email" name="email" placeholder="seu@email.com" required />
            </div>
            <br>
            <div class="form-group">
                <label for="senha">Senha de Acesso</label>
                <input type="text" id="senha" name="senha" placeholder="Digite uma senha segura" required />
            </div>
            <br>
            <div style="text-align: right; margin-top: 25px;">
                <input type="submit" value="Cadastrar Administrador" style="padding: 10px 20px;" />
            </div>

        </form>
    </dialog>





    <div class="main-wrapper">

        <?php echo $msg; ?>

        <div class="form-container">
            <div class="card-header" style="border-radius: 5px;">
                <button id="abrirCadastro"><i class="fa-solid fa-user-plus"></i>Cadastrar usuário</button>
            </div>
        </div>
        <hr>
        <div class="form-container">

            <?php
            include "../controller/conecta.php";
            $sql = "SELECT * FROM administrador";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 1) { ?>
                <div class="card">
                    <div class="card-header">
                        Outros Usuários
                    </div>
                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['id'] == $id) {
                                        continue;
                                    }
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['nome'] . "</td>";
                                    echo "<td>" . $row['usuario'] . "</td>";
                                    echo "<td class='acoes'>
                                        <button data-id='" . $row['id'] . "' class='botaoTable_excluir botaoAbrir'>Excluir<i class='fa-solid fa-trash-can'></i></button></td>";
                                    echo "</tr>";
                                }
                            } else { ?>
                                <div class="card">
                                    <div class="card-header">Opa!</div>
                                    <div class="card-body">
                                        <h2 class="h2Dialog">Nenhum cadastro encontrado! <i
                                                class="fa-solid fa-triangle-exclamation"
                                                style="color: rgb(0, 107, 146);"></i></h2>
                                        <h4 class="pDialog">Não há outro usuário cadastrado além de você,
                                            <?php echo $dadosAdmin['nome']; ?>!</h4>
                                        <h4 class="pDialog">Cadastre um novo usuário logo acima e o(s) usuário(s)
                                            aparecerá(ão) na lista.</h4>
                                    </div>
                                </div>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>

    </div>
    <dialog id="modal">
        <h2 class="h2Dialog">Atente-se! <i class="fa-solid fa-triangle-exclamation"
                style="color: rgb(0, 107, 146);"></i></h2>
        <h4 class="pDialog">O Usuário selecionado será excluido. Esta ação não possui volta!</h4>
        <h4 class="pDialog">Tem certeza?</h4>
        <div class="botoesDialog">
            <button id="cancelar">Cancelar sem exclusão</button>
            <button id="excluir">Sim, excluir</button>
        </div>
    </dialog>
</body>
<script>
    // nunca mais quero mexer nisso
    const modal = document.getElementById('modal');
    const cancelar = document.getElementById('cancelar');
    const excluir = document.getElementById('excluir');

    let idUsuario = null;

    document.querySelectorAll('.botaoAbrir').forEach(botao => {

        botao.addEventListener('click', () => {
            idUsuario = botao.dataset.id;

            modal.showModal();
        });

    });

    cancelar.addEventListener('click', () => {
        modal.close();
    });

    excluir.addEventListener('click', () => {

        modal.close();

        window.location.href = "../source/F_excluirUsuario.php?idUsuario=" + idUsuario;

    });




    const modalCadastro = document.getElementById("modalCadastro"); //abrri popup do formulário

    document.getElementById("abrirCadastro").addEventListener("click", () => {
        modalCadastro.showModal();
    });

    document.getElementById("fecharCadastro").addEventListener("click", () => {
        modalCadastro.close();
    });
</script>

</html>