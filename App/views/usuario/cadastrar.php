<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="http://review.com/css/bootstrap.css" rel="stylesheet">
  <link href="http://review.com/fontawesome/css/all.css" rel="stylesheet">
  <style>
    body {
      background-image: url(http://review.com/images/cadastro.jpg);
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }

    .tam {
      height: 100vh;
    }

    .d-flex form {
      flex-grow: 0.5;
    }

    .container-fluid {
      padding: 0px;
    }
  </style>
  <title>Reviews e Recomendações</title>
</head>



<body>
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
  <div class="container-fluid">
    <div class="d-flex justify-content-center">
      <div class="col bg-light tam align-middle">
        <form action="http://review.com/User/gravarInclusao" class="d-flex justify-content-center mt-5 pb-2" method="post">
          <div class="col-6">
            <a href="/home"><img src="http://review.com/images/icon_black.svg" width="40" height="40" alt="Icone" /></a>
            <div class="mb-3">
            </div>
            <div class="mb-3">
              <h1 class="display-4"> Comece por aqui </h1>
            </div>
            <div class="mb-3">
              <p class="fs-6 fw-light"> Crie sua conta agora mesmo e guarde os filmes que te marcaram. </p>
            </div>
            <input type="hidden" id="token_csrf" name="id" value="0" />
            <div class="mb-3">
              <label for="nome">Nome</label>
              <input id="nome_user" class="form-control" type="text" name="nome" placeholder="Fulano">
            </div>
            <div class="mb-3">
              <label for="sobrenome">Sobrenome</label>
              <input id="sobrenome_user" class="form-control" type="text" name="sobrenome" placeholder="Silva">
            </div>
            <div class="mb-3">
              <label for="email">E-mail</label>
              <input id="email_user" class="form-control" type="email" name="email" placeholder="example@mail.com">
            </div>
            <div class="mb-3">
              <label for="data_nascimento">Data de Nascimento</label>
              <input id="data_nascimento_user" class="form-control" type="date" name="data_nascimento" placeholder="01/01/1999">
            </div>
            <div class="mb-3">
              <label for="email">Senha</label>
              <input id="senha_user" class="form-control" type="password" name="senha" placeholder="123">
            </div>

            <div class="form-group d-flex justify-content-center mb-3">
              <button type="submit" class="btn btn-primary">Cadastrar minha conta</button>
            </div>

            <div class="d-inline d-flex justify-content-center mb-3">
              <p class="mt-3"> Já possui uma conta? <a href="/AcessoRestrito/login">Entre</a> </p>
            </div>
          </div>
        </form>
      </div>
      <div class="col">

      </div>
    </div>
  </div>
</body>