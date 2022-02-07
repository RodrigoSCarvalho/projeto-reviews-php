<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://review.com/css/bootstrap.css" rel="stylesheet">
    <link href="http://review.com/fontawesome/css/all.css" rel="stylesheet" >
    <style>
        body {
            background-image: url(http://review.com/images/home.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .sombra {
             text-shadow: 2px 3px 4px rgba(0, 0, 0, 0.3);
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

    </style>
    <title>Reviews e Recomendações</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-dark shadow-5-strong">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="http://review.com/images/icon.svg" alt="" width="40" height="40"> Reviews

                </a>
                <div class="d-flex">
                    <a class="nav-link active" aria-current="page" href="/User/incluir"><button type="button" class="btn btn-outline-dark">Cadastre-se</button></a>
                    <a class="nav-link active" aria-current="page" href="/AcessoRestrito/login"><button type="button" class="btn btn-light">Entrar</button></a>
                </div>
            </div>


        </nav>
        <div class="row my-5 py-5">

        </div>

        <div class="row mt-5 pt-5">
            <div class="col-9">
                <p class="display-3 fw-light text-light pt-3 sombra" >Registre suas impressões e avalie <br> os seus filmes favoritos (ou não).</p>
            </div>

        </div>
    </div>
</body>
<footer class="bg-dark text-center text-lg-start fixed-bottom" role="contentinfo">
  <div class="text-center p-3 text-light" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="navbar-brand text-light" href="https://github.com/RodrigoSCarvalho" target="_blank">
      <img src="http://review.com/images/gitwhite.svg" alt="GitHub" width="24" height="24">
      RodrigoSCarvalho
    </a>
  </div>
</footer>

</html>