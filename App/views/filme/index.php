<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://review.com/css/bootstrap.css" rel="stylesheet">
    <link href="http://review.com/css/filmes.css" rel="stylesheet">
    <link href="http://review.com/fontawesome/css/all.css" rel="stylesheet">
    <title>Filmes - Index</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-dark shadow-5-strong">
            <div class="container">
                <a class="navbar-brand " href="/Client/index">
                    <img src="http://review.com/images/icon.svg" alt="" width="40" height="40"> Filmes

                </a>
                <div class="d-flex">
                    <a class="nav-link active linked " aria-current="page" href="/Genre/index">Gêneros</a>
                    <a class="nav-link linked" aria-current="page" href="/Director/index">Diretores</a>
                    <a class="nav-link linked " aria-current="page" href="/Actor/index">Atores</a>
                    <a class="nav-link linked border-top border-warning" aria-current="page" href="/Movie/index">Filmes</a>
                    <a class="nav-link" aria-current="page" href="/AcessoRestrito/logout"><button type="button" class="btn btn-warning">Sair</button></a>
                </div>
            </div>
        </nav>
        <?php

        $TotalRegistros = $data['TotalRegistros'];
        $TotalPaginas = $data['TotalPaginas'];
        $lista_filmes = $data['Filmes'];

        ?>
        <div class="row text-center">
            <div class="col">
                <p class="text-warning display-4 sombra">Filmes</p>
            </div>
        </div>
        <div class="row d-flex mt-5">
            <div class="col ">
                <table class="table tabela text-light text-center table-curved">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Capa</th>
                            <th>Titulo</th>
                            <th>Sinopse</th>
                            <th>Ano</th>
                            <th>Duração</th>
                            <th>Diretor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // listando os gÊneros
                        if (!empty($lista_filmes)) :
                            foreach ($lista_filmes as $filme) {
                                echo "<tr>";
                                echo "<td>" . htmlentities($filme['id'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td><img class='foto' src='" . htmlentities(utf8_encode($filme['imagem'])) . "' width='126' height='191' alt='Capa do Filme'> </img></td>";
                                echo "<td>" . htmlentities(utf8_encode($filme['titulo'])) . "</td>";
                                echo "<td class='fw-light' style='width: 40%'>" . htmlentities(utf8_encode($filme['descricao'])) . "</td>";
                                echo "<td>" . htmlentities(utf8_encode($filme['ano'])) . "</td>";
                                echo "<td>" . htmlentities(utf8_encode($filme['duracao'])) . "</td>";
                                echo "<td>" . htmlentities(utf8_encode($filme['diretor_id'])) . "</td>";
                                echo "</tr>";
                            }
                        else :
                            echo "<br ><p class='linked sombra'>Não há filmes</p>";
                        endif;
                        ?>
                    </tbody>
                </table>
                <p class="text-light sombra">Total de Registro(s) = <?= $TotalRegistros ?> </p>
                <?php
                if (!empty($lista_filmes)) : ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php
                            // links da paginação
                            for ($page = 1; $page <= $TotalPaginas; $page++) {
                                $url = 'http://review.com/Movie/index/' . $page;
                                echo '<li class="page-item"><a class="page-link" href="' . $url . '">' . $page . '</a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
<?php require_once '../App/views/footer.php' ?>

</html>