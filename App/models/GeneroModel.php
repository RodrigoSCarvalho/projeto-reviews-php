<?php

use App\Core\BaseModel;

class GeneroModel extends BaseModel
{

    public function create($genero)
    {
        try { // conexão com a base de dados
            $sql = "INSERT INTO genero(genero) VALUES (?)";
            $conn = GeneroModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $genero->getGenero());
            $stmt->execute();
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function get($id)
    {
        try {
            $sql = "SELECT * FROM genero WHERE id = ?";
            $conn = GeneroModel::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            return  $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function read()
    {
        try {
            $sql = "SELECT * FROM genero";
            $conn = GeneroModel::getConexao();
            $stmt = $conn->query($sql);
            $conn = null;
            return $stmt;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function update($genero)
    {
        try {
            $sql = "UPDATE genero SET genero = ? WHERE id = ?";
            $conn = GeneroModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $genero->getGenero());
            $stmt->bindValue(2, $genero->getId());
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function delete($Id)
    {
        try {
            $sql = "DELETE FROM usuario WHERE id = ?";
            $conn = GeneroModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$Id);
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }


    public function getTotalGeneros()
    {
        try {
            $sql = "SELECT count(*) as total FROM genero";
            $conn = GeneroModel::getConexao();
            $stmt = $conn->query($sql)->fetch(\PDO::FETCH_ASSOC);
            $conn = null;
            return $stmt['total'];
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function getRegistroPagina($offset, $numRegistrosPag)
    {
        try {
            $sql = "SELECT * FROM GENERO LIMIT ?,?";
            $conn = GeneroModel::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $offset, PDO::PARAM_INT);
            $stmt->bindParam(2, $numRegistrosPag, PDO::PARAM_INT);
            $stmt->execute();
            //$stmt->debugDumpParams();  <- usando para depuração
            $conn = null;
            return $stmt;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    /*
       public function getGenero($genero)
    {

        try {
            $sql = "Select * from genero where email = ? and senha = ? limit 1";
            // obter a conecção e preparar o comando sql (PDO)
            $conn = UsuarioModel::getConexao();
            $stmt = $conn->prepare($sql);
             // passando parâmteros
            $stmt->bindValue(1, $genero);
            $stmt->execute();
            if ($stmt->rowCount() > 0) :
                $resultset = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultset[0];
            else :
                return []; // retornado array vazio... não há registros no BD    
            endif;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    */

}
