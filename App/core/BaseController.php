<?php

namespace App\Core;

class BaseController {

    // método que carrega o model associado ao controller
    public function model($model){
        require_once '../App/models/'.$model.'.php';
        return new $model;
    }

     // método que carrega a view associado ao controller
     // e os dados que serão exibidos
     // $view passada parâmetro será inserida em template
    public function view($view, $data=[]){
        require_once '../App/views/template.php';
       
    }

    public function view_basic($view){
        require_once '../App/views/template.php';
       
    }


}