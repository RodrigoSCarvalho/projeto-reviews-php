<?php

use App\Core\BaseController;
use App\core\Funcoes;
use \App\models\Usuario;
use GUMP as Validador;

class User extends BaseController
{
    protected $filters = [
        'nome' => 'trim|sanitize_string|upper_case',
        'email' => 'trim|sanitize_email|lower_case',
        'sobrenome' => 'trim|sanitize_string|upper_case',
        'senha' => 'trim|sanitize_string|lower_case'
    ];

    protected $rules = [
        'nome'    => 'required|min_len,2|max_len,50',
        'sobrenome'    => 'min_len,2|max_len,50',
        'email'  => 'required|valid_email',
        'senha'    => 'required|min_len,3',
    ];

    function __construct()
    {
        session_start();
        //if (!Funcoes::usuarioLogado()) :
        //Funcoes::redirect("Home");
        //endif;
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

            $usuarioModel = $this->model("UsuarioModel");

            // obtém a quantidade total de registros na base de dados
            $total_registros = $usuarioModel->getTotalUsuarios();

            // calcula a quantidade de páginas - ceil — Arredonda frações para cima
            $total_paginas = ceil($total_registros / 5);

            // obtém os registros referente a página
            $lista_usuarios = $usuarioModel->getRegistroPagina($offset, 5)->fetchAll(\PDO::FETCH_ASSOC);

            $data = ["TotalRegistros" => $total_registros, "TotalPaginas" => $total_paginas, "Usuario" => $lista_usuarios];

            $this->view('user/index', $data);
        else :
            Funcoes::redirect("Home");
        endif;
    }

    // ***********************************************************************
    // chama a view para entrada dos dados do usuario
    public function incluir()
    {
        echo ("<script>console.log('PHP');</script>");
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            // gera o CSRF_token e guarda na sessão
            //$_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
            $this->view('/usuario/cadastrar');
        //else :

        //Funcoes::redirect("Home");
        endif;
    }

    public function confirmarInclusao()
    {
        $usuario = new \App\models\Usuario();
        $usuario->setNome($_POST['nome']);
        $usuario->setSobrenome($_POST['sobrenome']);
        $usuario->setEmail($_POST['email']);
        $usuario->setSenha($_POST['senha']);
        $usuario->setData_nascimento($_POST['data_nascimento']);
        $usuarioModel = $this->model("UsuarioModel");

        $usuarioModel->create($usuario);
    }

    public function gravarInclusao()
    {

        echo ("<script>console.log('Cheguei em gravar');</script>");
        // trata a as solicitações POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            //if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

            $validacao = new Validador("pt-br");

            $post_filtrado = $validacao->filter($_POST, $this->filters);
            $post_validado = $validacao->validate($post_filtrado, $this->rules);

            if ($post_validado === true) :  // verificar dados do usuario
                // gerando hash da senha

                //$hash_senha = password_hash($_POST['nome'], PASSWORD_ARGON2I);
                // criando um objeto usuário
                $usuario = new \App\models\Usuario();
                $usuario->setNome($_POST['nome']);
                $usuario->setSobrenome($_POST['sobrenome']);
                $usuario->setEmail($_POST['email']);
                $usuario->setSenha($_POST['senha']);
                $usuario->setData_nascimento($_POST['data_nascimento']);
                $usuarioModel = $this->model("UsuarioModel");

                $usuarioModel->create($usuario);
                // calcular o hash da chave gerada

                echo ("<script>console.log('Cheguei em gravar');</script>");
                //Funcoes::redirect("AcessoRestrito/login");
            else :

                echo ("<script>console.log('Erro');</script>");

                $erros = $validacao->get_errors_array();
                //$_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
                $data = ['erros' => $erros];
                //$this->view('usuario/cadastrar', $data);
                
            endif;
        else :
            echo ("<script>console.log('Erro');</script>");
        //    die("Erro 404");
        //endif;

        //else :
        //    Funcoes::redirect("Home");
        endif;
    }

    // ***********************************************************************
    public function alterar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :

            // gera o CSRF_token e guarda na sessão
            $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

            $userModel = $this->model("UserModel");

            $usuario = $userModel->getId($id);

            $data = ["usuario" => $usuario];

            $this->view('user/alterar', $data);
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
                    'nome' => 'trim|sanitize_string|upper_case',
                    'email' => 'trim|sanitize_email|lower_case'
                ];

                $rules = [
                    'nome'    => 'required|min_len,2|max_len,40',
                    'email'  => 'required|valid_email'
                ];

                $validacao = new Validador("pt-br");

                $post_filtrado = $validacao->filter($_POST, $filters);
                $post_validado = $validacao->validate($post_filtrado, $rules);

                if ($post_validado === true) :  // verificar dados do usuario

                    // criando um objeto usuário
                    $usuario = new \App\models\Usuario();
                    $usuario->setNome($_POST['nome']);
                    $usuario->setEmail($_POST['email']);

                    $userModel = $this->model("UserModel");

                    $userModel->update($usuario);

                    Funcoes::redirect("User");
                else :
                    $erros = $validacao->get_errors_array();
                    $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

                    $userModel = $this->model("UserModel");
                    $usuario = $userModel->getHashID($_POST['id']);
                    $data = ['erros' => $erros, 'usuario' => $usuario];
                    $this->view('user/alterar', $data);
                endif;
            else :
                die("Erro 404");
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }

    // ***********************************************************************
    public function excluir($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            // gera o CSRF_token e guarda na sessão
            $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

            $userModel = $this->model("UserModel");

            $usuario = $userModel->getId($id);

            $data = ["usuario" => $usuario];

            $this->view('user/excluir', $data);

        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function gravarExcluir()
    {
        // trata a as solicitações POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

                $userModel = $this->model("UserModel");

                $userModel->delete($_POST['id']);

                Funcoes::redirect("User");

            else :
                die("Erro 404");
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }
}
