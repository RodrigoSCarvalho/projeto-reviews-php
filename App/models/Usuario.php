<?php

namespace App\models;

class Usuario
{
    private $id, $nome, $email, $senha, $sobrenome, $data_nascimento;

    public function __construct()
    {
        $this->id = 0;
        $this->nome = "";
        $this->sobrenome= "";
        $this->senha= "";
        $this->email= "";
        $this->data_nascimento= "";
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of sobrenome
     */ 
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * Set the value of sobrenome
     *
     * @return  self
     */ 
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    /**
     * Get the value of data_nascimento
     */ 
    public function getData_nascimento()
    {
        return $this->data_nascimento;
    }

    /**
     * Set the value of data_nascimento
     *
     * @return  self
     */ 
    public function setData_nascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;

        return $this;
    }
}