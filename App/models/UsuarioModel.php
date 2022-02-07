<?php

use App\Core\BaseModel;

class UsuarioModel extends BaseModel
{

    public function create($usuario)
    {
        try { // conexão com a base de dados
            $sql = "INSERT INTO usuario(nome,sobrenome,email,senha,data_nascimento) VALUES (?,?,?,?,?)";
            $conn = UsuarioModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $usuario->getNome());
            $stmt->bindValue(2, $usuario->getSobrenome());
            $stmt->bindValue(3, $usuario->getEmail());
            $stmt->bindValue(4, $usuario->getSenha());
            $stmt->bindValue(5, $usuario->getData_nascimento());
            $stmt->execute();
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function get($id)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE id = ?";
            $conn = UsuarioModel::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            return  $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    /*
    public function getHashID($hashid)
    {
        try {
            $sql = "SELECT * FROM USUARIOS WHERE hashid = ?";
            $conn = UserModel::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $hashid);
            $stmt->execute();
            $conn = null;
            return  $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    */

    public function read()
    {
        try {
            $sql = "SELECT * FROM usuario";
            $conn = UsuarioModel::getConexao();
            $stmt = $conn->query($sql);
            $conn = null;
            return $stmt;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function update($usuario)
    {
        try {
            $sql = "UPDATE usuario SET nome = ?, sobrenome = ?, email = ?, data_nascimento = ? WHERE id = ?";
            $conn = UsuarioModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $usuario->getNome());
            $stmt->bindValue(2, $usuario->getSobrenome());
            $stmt->bindValue(3, $usuario->getEmail());
            $stmt->bindValue(4, $usuario->getData_nascimento());
            $stmt->bindValue(5, $usuario->getId());
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
            $conn = UsuarioModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$Id);
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }


    public function getTotalUsuarios()
    {
        try {
            $sql = "SELECT count(*) as total FROM usuario";
            $conn = UsuarioModel::getConexao();
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
            $sql = "SELECT * FROM USUARIO LIMIT ?,?";
            $conn = UsuarioModel::getConexao();
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

       public function getUsuarioEmail($email, $senha)
    {

        try {
            $sql = "Select * from usuario where email = ? and senha = ? limit 1";
            // obter a conecção e preparar o comando sql (PDO)
            $conn = UsuarioModel::getConexao();
            $stmt = $conn->prepare($sql);
             // passando parâmteros
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $senha);
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

    /*
    public function createHashID($id, $hashId)
    {
        try {
            $sql = "UPDATE usuarios SET hashid = ? WHERE id = ?";
            $conn = UserModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $hashId);
            $stmt->bindValue(2, $id);
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
    */
}
