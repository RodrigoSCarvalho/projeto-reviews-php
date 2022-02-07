<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="http://review.com/css/bootstrap.css" rel="stylesheet">
  <link href="http://review.com/fontawesome/css/all.css" rel="stylesheet">
  <style>
    body {
      background-image: url(http://review.com/images/login.jpg);
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
  if (isset($data['mensagens'])) { ?>
    <div class="col-6">
      <div class="alert alert-danger" role="alert">
        <?php

        foreach ($data['mensagens'] as $mensagem) {
          echo $mensagem . "<br>";
        }

        ?>
      </div>
    </div>
  <?php
  }
  ?>
  <div class="container-fluid">
    <div class="d-flex justify-content-center">
      <div class="col bg-light tam align-middle">
        <form action="http://review.com/AcessoRestrito/logar" class="d-flex justify-content-center mt-5 pb-2" method="post">
          <div class="col-6">
            <a href="/home" ><img src="http://review.com/images/icon_black.svg" width="40" height="40" alt="Icone" /></a>
            <div class="mb-3">
            </div>
            <div class="mb-3">
              <h1 class="display-4"> Entre </h1>
            </div>
            <div class="mb-3">
              <p class="fs-6 fw-light"> Adicione novas avaliações e revise suas as antigas reflexões. </p>
            </div>
            <div class="mb-3">
              <label for="email">E-mail</label>
              <input id="email" class="form-control" type="email" name="email" placeholder="example@mail.com">
            </div>
            <div class="mb-3">
              <label for="email">Senha</label>
              <input id="senha" class="form-control" type="password" name="senha" placeholder="123">
            </div>

            <div class="mb-3">
              <?php echo $data['imagem'] ?>
            </div>

            <div class="mb-3">
              <input id="captcha" class="form-control" type="text" name="captcha" placeholder="Digite o código acima">
            </div>

            <div class="form-group d-flex justify-content-center mb-3">
              <button type="submit" class="btn btn-primary">Entrar</button>
            </div>

            <div class="d-inline d-flex justify-content-center mb-3">
              <p class="mt-3"> Ainda não tem uma conta? <a href="/User/incluir">Cadastre-se</a> </p>
            </div>
          </div>
        </form>
      </div>
      <div class="col">

      </div>
    </div>
  </div>
</body>