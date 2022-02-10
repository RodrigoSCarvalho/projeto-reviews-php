<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://review.com/css/bootstrap.css" rel="stylesheet">
    <link href="http://review.com/fontawesome/css/all.css" rel="stylesheet">
    <link href="http://review.com/css/genero.css" rel="stylesheet">
    <title>Genêros - Index</title>
</head>

<body>
    <nav class="navbar navbar-dark shadow-5-strong">
        <div class="container">
            <a class="navbar-brand" href="/Client/index">
                <img src="http://review.com/images/icon.svg" alt="" width="40" height="40"> Gêneros

            </a>
            <div class="d-flex">
                <a class="nav-link active linked border-top border-warning" aria-current="page" href="/Genre/index">Gêneros</a>
                <a class="nav-link  linked" aria-current="page" href="/Director/index">Diretores</a>
                <a class="nav-link  linked" aria-current="page" href="/Actor/index">Atores</a>
                <a class="nav-link  linked" aria-current="page" href="/Movie/index">Filmes</a>
                <a class="nav-link" aria-current="page" href="/AcessoRestrito/logout"><button type="button" class="btn btn-warning">Sair</button></a>
            </div>
        </div>
    </nav>
    <?php

    if (isset($data['erros']) && (!empty($data['erros']))) : ?>
        <div class="alert alert-danger" role="alert">
            <?php
            foreach ($data['erros'] as $erro) {
                echo $erro . "<br>";
            }
            ?>
        </div>
    <?php endif ?>
    <div class="row d-flex text-center justify-content-center">
        <div class="col d-flex justify-content-center">
            <form action="http://review.com/Genre/gravarInclusao" method="POST">
                <div class="mb-3">
                    <h1 class="display-4 sombra text-warning"> Adicionar - Gênero </h1>
                </div>
                <input type="hidden" id="token_csrf" name="CSRF_token" value="<?= $_SESSION['CSRF_token'] ?>" />
                <div class="form-group mb-3">
                    <label for="nome" class="text-light mb-1">Gênero</label>
                    <input type="nome" class="form-control" id="genero" name="genero">
                </div>

                <button type="submit" name="bt_acao" value="incluir" class="btn btn-success">Cadastrar</button>
                <a href="http://review.com/Genre/index" class="btn btn-outline-danger">Cancelar</a>
            </form>
        </div>
    </div>
</body>
<?php require_once '../App/views/footer.php' ?>

</html>