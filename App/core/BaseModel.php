<?php

namespace App\Core;

use \PDO;
use \PDOException;

// classe responsável pela conecção com o BD
class BaseModel
{
    public static function getConexao()
    {
        $banco = "mysql:host=localhost;dbname=review";

        $opcoes = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try { // conexão com a base de dados
            return new PDO($banco, 'root', '', $opcoes);
        } catch (PDOException $e) {
            echo 'Conexao falhou: ' . $e->getMessage();
        }
    }
}
