<?php

use App\Core\BaseController;
use App\core\Funcoes;

class Client extends BaseController
{
    function __construct()
    {
        session_start();
        if (!Funcoes::usuarioLogado()) :
            Funcoes::redirect("Home");
        endif;
    }

    public function index()
    {
        $this->view('home/landing_page');
    }
}
