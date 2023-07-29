<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <div id="site">
        <header>
            <a class="voltar" href="index.php"><img src="images/voltar.svg"></a>
            <h1 class="total">Salvar novo usuário</h1>
            <figure></figure>
            <a class="sair" href="views/login.php">sair</a>
        </header>
        <form action="?action=<?= isset($usuario['id']) ? "editar&id=" . $usuario['id'] : 'cadastrar' ?>  " method="post" class="cadastro">
            <div class="input">
                <label for="input_nome">Nome:</label>
                <input type="text" id="input_nome" name="nome" placeholder="Digite um nome" value="<?= $usuario['nome'] ?? false  ?>" maxlength="255">
            </div>
            <div class="input">
                <label for="input_cpf">CPF:</label>
                <input type="text" id="input_cpf" name="cpf" placeholder="Digite um CPF" value="<?= $usuario['cpf'] ?? false  ?>" maxlength="12">
            </div>
            <div class="input">
                <label for="input_email">E-mail:</label>
                <input type="text" id="input_email" name="email" placeholder="Digite um e-mail" value="<?= $usuario['email'] ?? false  ?>" maxlength="255">
            </div>
            <div class="input" id="div_senha">
                <label for="input_senha">Senha:</label>
                <input type="password" id="input_senha" name="senha" placeholder="Digite uma senha" value="<?= $usuario['senha'] ?? false  ?>" <?php isset($usuario['senha']) ? 'disabled' : false  ?> disabled>
                <span>obs: todas as senhas do sistemas são encriptografadas para sua segurança</span> <br>
                <?php if (isset($usuario['id'])) : ?>
                    <span>*Clique duas vezes para alterar a senha</span>
                <?php endif ?>
            </div>

            <div class="select">
                <label for="input_status">Status</label>
                <select name="status" id="input_status">
                    <option <?= isset($usuario) ? false : 'selected' ?> disabled value="">Escolha uma opção</option>
                    <option <?= isset($usuario) ? ($usuario['status'] == true ? 'selected' : false) : false  ?> value="1">Ativo</option>
                    <option <?= isset($usuario) ? ($usuario['status'] == false ? 'selected' : false) : false  ?> value="0">Inativo</option>
                </select>
                <div class="seta"><img src="images/seta.svg" alt=""></div>
            </div>

            <h2>Permissão</h2>
            <div class="permissao">
                <div class="checkbox">
                    <input type="checkbox" id="input_permissao_login" name="permissao[]" value="login" <?= isset($usuario) ? (in_array('login', $usuario['permissao']) ? 'checked' : false) : false  ?>>
                    <div class="check"><img src="images/check.svg"></div>
                    <label for="input_permissao_login">Login</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="input_permissao_usuario_add" name="permissao[]" value="usuario_add" <?= isset($usuario) ? (in_array('usuario_add', $usuario['permissao']) ? 'checked' : false) : false  ?>>
                    <div class="check"><img src="images/check.svg"></div>
                    <label for="input_permissao_usuario_add">Add usuário</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="input_permissao_usuario_editar" name="permissao[]" value="usuario_editar" <?= isset($usuario) ? (in_array('usuario_editar', $usuario['permissao']) ? 'checked' : false) : false  ?>>
                    <div class="check"><img src="images/check.svg"></div>
                    <label for="input_permissao_usuario_editar">Editar usuário</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="input_permissao_usuario_deletar" name="permissao[]" value="usuario_deletar" <?= isset($usuario) ? (in_array('usuario_deletar', $usuario['permissao']) ? 'checked' : false) : false  ?>>
                    <div class="check"><img src="images/check.svg"></div>
                    <label for="input_permissao_usuario_deletar">Deletar usuário</label>
                </div>
            </div>
            <button>SALVAR</button>
        </form>
    </div>

    <script>
        let senha = window.document.getElementById("div_senha");
        console.log(senha);
        senha.addEventListener("click", function() {
            window.document.getElementById("input_senha").value = ""
            window.document.getElementById("input_senha").removeAttribute("disabled");
        });
    </script>
</body>

</html>