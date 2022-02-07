<?php

namespace App\core;

class Router
{
    protected $controller = 'Home';  // controlador default
    protected $method = 'index';     // metodo default
    protected $params = [];          // sem parâmetros - default

    public function __construct()
    {
        $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $url = $this->parseURL($url); // gerando o array com as partes da URL

        // tratar do controlador - usuário colocou um controlador na URL?
        if (isset($url[1])) :
            if (file_exists('../App/controllers/' . $url[1] . '.php')) :
                $this->controller = $url[1];
                unset($url[1]);  // apaga o controlador da string $url                
            endif;
        endif;

        // carrega o código do controlador especificamente
        require_once '../App/controllers/' . $this->controller . '.php';

        // cria a instância do controlador
        $this->controller = new $this->controller;

        if (isset($url[2])) : // foi escrito um método na url ?
            // existe o método na instância
            if (method_exists($this->controller, $url[2])) :
                $this->method = $url[2];
                unset($url[2]);  // apaga o metodo da string $url
            endif;
        endif;

        unset($url[0]); // apaga o blog.com da $url

        // testa se o array está vazio
        // $url possui algum componente (o que tem é parâmetro)
        if ($url) :
            // gera um array comecando de zero com os componentes de $url
            $this->params = array_values($url);
        else :
            $this->params = [];
        endif;

        // passando o controle da execução para o controlador/método...
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // ele pega a url completa e descobre qual é o
    // controlador e os parametros que foram passados
    // separando cada um deles
    public function parseURL($url)
    {
        // O filtro FILTER_SANITIZE_URL remove todos os caracteres de URL ilegais de uma string.
        $aux  = filter_var($url, FILTER_SANITIZE_URL);

        // verifica se o usuário digitou uma barra no final da url
        // exemplo: //http://blog.com/  ou //http://blog.com/Home/ e elimina ela
        if (substr($aux, -1) === '/') :
            $aux = substr($aux, 0, -1);
        endif;

        //http://blog.com/Artigo/alterar/1
        //0 => string 'blog.com' 
        //1 => string 'Artigo' 
        //2 => string 'alterar' 
        //3 => string '1' 

        return explode('/', $aux); // explode - Divide uma string em strings pelo delimitador
    }
}
