<?php

use App\Core\BaseController;
use App\core\Funcoes;

class Director extends BaseController
{
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
            $offset = ($numPag - 1) * 3;

            $diretorModel = $this->model("diretorModel");

            // obtém a quantidade total de registros na base de dados
            $total_registros = $diretorModel->getTotalGeneros();

            // calcula a quantidade de páginas - ceil — Arredonda frações para cima
            $total_paginas = ceil($total_registros / 3);

            // obtém os registros referente a página
            $lista_diretores = $diretorModel->getRegistroPagina($offset, 3)->fetchAll(\PDO::FETCH_ASSOC);

            $data = ["TotalRegistros" => $total_registros, "TotalPaginas" => $total_paginas, "Diretores" => $lista_diretores];

            $this->view('diretor/index', $data);
        else :
            Funcoes::redirect("Home");
        endif;
    }
}