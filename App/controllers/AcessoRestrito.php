<?php

use App\core\BaseController;
use App\core\Funcoes;
use GUMP as Validador;

class AcessoRestrito extends BaseController
{
    protected $filters = [
        'email' => 'trim|sanitize_email',
        'senha' => 'trim|sanitize_string',
        'captcha' => 'trim|sanitize_string'
    ];

    protected $rules = [
        'email'    => 'required|min_len,8|max_len,255',
        'senha'  => 'required',
        'captcha'  => 'required|validar_CAPTCHA_CODE'
    ];


    function __construct()
    {
        session_start();
    }

    public function login()
    {
        // gera o CAPTCHA_CODE e guarda na sessão 
        $_SESSION['CAPTCHA_CODE'] = Funcoes::gerarCaptcha();
        $imagem = Funcoes::gerarImgCaptcha($_SESSION['CAPTCHA_CODE']);
        // gera o CSRF_token e guarda na sessão
        $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
        $data = ['imagem' => $imagem];
        // chama a view
        $this->view('login/login', $data);
    }

    public function logar()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") :

            Validador::add_validator("validar_CAPTCHA_CODE", function ($field, $input) {
                return $input['captcha'] === $_SESSION['CAPTCHA_CODE'];
            }, 'Código de Segurança incorreto.');

            $validacao = new Validador("pt-br");

            $post_filtrado = $validacao->filter($_POST, $this->filters);
            $post_validado = $validacao->validate($post_filtrado, $this->rules);

            if ($post_validado === true) :  // verificar login

                //if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

                $senha_enviada = $_POST['senha'];

                $usuarioModel = $this->model('UsuarioModel');
                $usuario = $usuarioModel->getUsuarioEmail($_POST['email'], $_POST['senha']);

                if (!empty($usuario)) :
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['nomeUsuario'] = $usuario['nome'];
                    $_SESSION['emailUsuario'] = $usuario['email'];

                    Funcoes::redirect("Client");
                
                else :
                    $mensagem = ["Usuário e/ou Senha incorreta"];
                    $_SESSION['CAPTCHA_CODE'] = Funcoes::gerarCaptcha(); // guarda o captcha_code na sessão 
                    $imagem = Funcoes::gerarImgCaptcha($_SESSION['CAPTCHA_CODE']);
                    $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
                    $data = [
                        'imagem' => $imagem,
                        'mensagens' => $mensagem
                    ];

                    $this->view('login/login', $data);
                endif;

            //else :  // falha CSRF_token"
            //    die("Erro 404");
            //endif;
            else : // erro de validação
                $mensagem = $validacao->get_errors_array();
                $_SESSION['CAPTCHA_CODE'] = Funcoes::gerarCaptcha(); // guarda o captcha_code na sessão 
                $imagem = Funcoes::gerarImgCaptcha($_SESSION['CAPTCHA_CODE']);
                $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
                $data = [
                    'imagem' => $imagem,
                    'mensagens' => $mensagem
                ];

                $this->view('login/login', $data);
            endif;
        else : // não POST
            Funcoes::redirect();
        endif;
    }
    

    public function logout()
    {
        session_unset();
        session_destroy();
        Funcoes::redirect();
    }
}
