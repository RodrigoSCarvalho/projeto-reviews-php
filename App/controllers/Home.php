<?php

use App\core\BaseController;

class Home extends BaseController{

    function __construct()
    {
        session_start();
    }

    public function index(){
        
        $this->view_basic('home/index');
    }

}