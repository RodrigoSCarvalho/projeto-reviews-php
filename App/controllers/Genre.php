<?php

use App\Core\BaseController;
use App\core\Funcoes;
use GUMP as Validador;

class Genre extends BaseController
{

    protected $filters = [
        'genero' => 'trim|sanitize_string',
    ];

    protected $rules = [
        'genero'    => 'required|min_len,2|max_len,40',
    ];

    function __construct()
    {
        session_start();
        if (!Funcoes::usuarioLogado()) :
            Funcoes::redirect("Home");
        endif;
    }

    public function index($numPag = 1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            if (filter_var($numPag, FILTER_VALIDATE_INT)) :
                $numPag = $numPag;
            else :
                $numPag = 1;
            endif;

            // calcula o offset
            $offset = ($numPag - 1) * 5;

            $generoModel = $this->model("generoModel");

            // obtém a quantidade total de registros na base de dados
            $total_registros = $generoModel->getTotalGeneros();

            // calcula a quantidade de páginas - ceil — Arredonda frações para cima
            $total_paginas = ceil($total_registros / 5);

            // obtém os registros referente a página
            $lista_generos = $generoModel->getRegistroPagina($offset, 5)->fetchAll(\PDO::FETCH_ASSOC);

            $data = ["TotalRegistros" => $total_registros, "TotalPaginas" => $total_paginas, "Generos" => $lista_generos];

            $this->view('genero/index', $data);
        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function alterar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :

            // gera o CSRF_token e guarda na sessão
            $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

            $genreModel = $this->model("GeneroModel");

            $genero = $genreModel->get($id);

            $data = ["genero" => $genero];

            $this->view('genero/alterar', $data);
        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function gravarAlterar()
    {
        // trata a as solicitações POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

                $filters = [
                    'genero' => 'trim|sanitize_string',
                ];

                $rules = [
                    'genero'    => 'required|min_len,2|max_len,40',
                ];

                $validacao = new Validador("pt-br");

                $post_filtrado = $validacao->filter($_POST, $filters);
                $post_validado = $validacao->validate($post_filtrado, $rules);

                if ($post_validado === true) :  // verificar dados do usuario

                    // criando um objeto usuário
                    $genero = new \App\models\Genero();
                    $genero->setGenero($_POST['genero']);
                    $genero->setId($_POST['id']);

                    $genreModel = $this->model("GeneroModel");

                    $genreModel->update($genero);

                    Funcoes::redirect("Genre");
                else :
                    $erros = $validacao->get_errors_array();
                    $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

                    $genreModel = $this->model("GenreModel");
                    $genre = $genreModel->get($_POST['id']);
                    $data = ['erros' => $erros, 'genero' => $genre];
                    $this->view('genero/alterar', $data);
                endif;
            else :
                die("Erro 404");
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }

// ************************** EXCLUIR ***********************************

    public function excluir($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            // gera o CSRF_token e guarda na sessão
            $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

            $genreModel = $this->model("GeneroModel");

            $genero = $genreModel->get($id);

            $data = ["genero" => $genero];

            $this->view('genero/excluir', $data);

        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function gravarExcluir()
    {
        // trata a as solicitações POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

                $genreModel = $this->model("GeneroModel");

                $genreModel->delete($_POST['id']);

                Funcoes::redirect("Genre");

            else :
                die("Erro 404");
            endif;

        else :
            Funcoes::redirect("Home");
        endif;

    }


      // chama a view para entrada dos dados do usuario
      public function incluir()
      {
          if ($_SERVER['REQUEST_METHOD'] == 'GET') :
              // gera o CSRF_token e guarda na sessão
              $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
              $this->view('genero/incluir');
          else :
              Funcoes::redirect("Home");
          endif;
      }
  
      public function gravarInclusao()
      {
          // trata a as solicitações POST
          if ($_SERVER['REQUEST_METHOD'] == 'POST') :
  
              if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :
  
                  $validacao = new Validador("pt-br");
  
                  $post_filtrado = $validacao->filter($_POST, $this->filters);
                  $post_validado = $validacao->validate($post_filtrado, $this->rules);
  
                  if ($post_validado === true) :  // verificar dados do usuario
                      // gerando hash da senha
  
                      // criando um objeto usuário
                      $genero = new \App\models\Genero();
                      $genero->setGenero($_POST['genero']);
                      $generoModel = $this->model("GeneroModel");
  
                      $generoModel->create($genero);
  
                      Funcoes::redirect("Genre");
                  else :
                      $erros = $validacao->get_errors_array();
                      $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
                      $data = ['erros' => $erros];
                      $this->view('genero/incluir', $data);
                  endif;
              else :
                  die("Erro 404");
              endif;
  
          else :
              Funcoes::redirect("Home");
          endif;
      }
  

}