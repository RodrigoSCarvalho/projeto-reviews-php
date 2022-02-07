<?php
// Configuração do BD
define('HOST', 'localhost');// onde está o banco de dados
define('DB','review');      // nome da base de dados
define('USUARIO','root');   // usuário da base de dados
define('SENHA','Carv@lho26');         // senha usuário da base de dados

//Constante que indica a URL básica da aplicação
define("URL_BASE", "http://review.com");

//Constante usada para gerar CSRF Token
define('CSRF_TOKEN_SECRET', 'iyHS4##SiPcV9tIZ');

// Caminho para a imagem Captcha
define('DIR_IMG_CAPTCHA', "D:/wamp64/www/review/App/writable/");

// Quantidade de registros exibidos na página
define("REGISTROS_PAG", 5);