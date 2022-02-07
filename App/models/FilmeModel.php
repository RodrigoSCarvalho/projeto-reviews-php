<?php

use App\Core\BaseModel;

class FilmeModel extends BaseModel
{

    public function create($filme)
    {
        try { // conexão com a base de dados
            $sql = "INSERT INTO filme(titulo, descricao, ano, duracao, imagem, diretor_id) VALUES (?,?,?,?,?,?)";
            $conn = FilmeModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $filme->getTitulo());
            $stmt->bindValue(2, $filme->getDescricao());
            $stmt->bindValue(3, $filme->getAno());
            $stmt->bindValue(4, $filme->getDuracao());
            $stmt->bindValue(5, $filme->getImagem());
            $stmt->bindValue(6, $filme->getDiretor_id());
            $stmt->execute();
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function get($id)
    {
        try {
            $sql = "SELECT * FROM filme WHERE id = ?";
            $conn = FilmeModel::getConexao();
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
            $sql = "SELECT * FROM filme";
            $conn = FilmeModel::getConexao();
            $stmt = $conn->query($sql);
            $conn = null;
            return $stmt;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function update($filme)
    {
        try {
            $sql = "UPDATE filme SET titulo = ?, descricao = ?, ano = ?, duracao = ? , imagem = ?, diretor_id = ? WHERE id = ?";
            $conn = FilmeModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $filme->getTitulo());
            $stmt->bindValue(2, $filme->getDescricao());
            $stmt->bindValue(3, $filme->getAno());
            $stmt->bindValue(4, $filme->getDuracao());
            $stmt->bindValue(5, $filme->getImagem());
            $stmt->bindValue(6, $filme->getDiretor_id());
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function delete($Id)
    {
        try {
            $sql = "DELETE FROM filme WHERE id = ?";
            $conn = FilmeModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$Id);
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }


    public function getTotalFilmes()
    {
        try {
            $sql = "SELECT count(*) as total FROM filme";
            $conn = FilmeModel::getConexao();
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
            $sql = "SELECT * FROM FILME LIMIT ?,?";
            $conn = FilmeModel::getConexao();
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
