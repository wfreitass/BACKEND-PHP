<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div id="site">
        <header>
            <h1>USUÁRIOS</h1>
            <form class="busca" action="?action=pesquisa" method="post">
                <i><img src="images/lupa.svg"></i>
                <input type="text" name="pesquisa" placeholder="Pesquisar...">
            </form>
            <figure></figure>
            <a class="sair" href="?action=logout">sair</a>
        </header>
        <ul>
            <li class="titulo">
                <div class="texto nome">Nome</div>
                <div class="texto cpf">CPF</div>
                <div class="texto email">E-MAIL</div>
                <div class="texto data">DATA</div>
                <div class="texto status">STATUS</div>
                <?php if (in_array('usuario_add', $usuarioLogado['permissao'])) : ?>
                    <div class="editar"></div>
                <?php endif ?>
                <?php if (in_array('usuario_deletar', $usuarioLogado['permissao'])) : ?>
                    <div class="deletar"></div>
                <?php endif ?>
            </li>
            <?php while ($value = $resultado->fetch(PDO::FETCH_ASSOC)) : ?>
                <li class="dado">
                    <div class="texto nome"><?= $value['nome'] ?></div>
                    <div class="texto cpf"><?= $value['cpf'] ?></div>
                    <div class="texto email"><?= $value['email'] ?></div>
                    <div class="texto data"><?= $value['data_criacao'] ?></div>
                    <div class="texto status"><?= $value['status'] ? "Ativado" : "Inativado" ?></div>
                    <?php if (in_array('usuario_add', $usuarioLogado['permissao'])) : ?>
                        <div class="editar"><a href="?action=editar&id=<?= $value['id'] ?>"><img src="images/editar.svg"></a></div>
                    <?php endif ?>
                    <?php if (in_array('usuario_deletar', $usuarioLogado['permissao'])) : ?>
                        <div class="deletar"><a href="?action=excluir&id=<?= $value['id'] ?>"><img src="images/deletar.svg"></a></div>
                    <?php endif ?>
                </li>
            <?php endwhile ?>
        </ul>
        <div class="pagina">
            <p class="resultado"><?= $total ?> resultados</p>
            <a href="?pagina=<?= $paginaAtual - 1 != 0 ?  $paginaAtual - 1 : $paginaAtual ?>">Anterior</a>
            <a href="?pagina=<?= $paginaAtual + 1 > $totalPaginas ? $paginaAtual : $paginaAtual + 1  ?>">Próxima</a>
        </div>
        <?php if (in_array('usuario_add', $usuarioLogado['permissao'])) : ?>
            <a href="?action=cadastrar" class="botao_add">Adicionar novo</a>
        <?php endif ?>
    </div>
    <script>
        function confirmarExclusao() {
            let confirme = confirm("Deseja excluir este item ");
            if (confirme) {
                alert("item excluido com sucesso")
            }
            return false;
        }
    </script>
</body>

</html>