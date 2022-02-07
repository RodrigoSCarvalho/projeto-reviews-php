<?php

namespace App\models;

class Filme
{
    private $id, $titulo, $descricao, $ano, $duracao, $imagem, $diretor_id;

    public function __construct()
    {
        $this->id = 0;
        $this->titulo = "";
        $this->descricao = "";
        $this->ano= 0;
        $this->imagem= "";
        $this->diretor_id = 0;
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
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of ano
     */ 
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set the value of ano
     *
     * @return  self
     */ 
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get the value of duracao
     */ 
    public function getDuracao()
    {
        return $this->duracao;
    }

    /**
     * Set the value of duracao
     *
     * @return  self
     */ 
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;

        return $this;
    }

    /**
     * Get the value of imagem
     */ 
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     *
     * @return  self
     */ 
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get the value of diretor_id
     */ 
    public function getDiretor_id()
    {
        return $this->diretor_id;
    }

    /**
     * Set the value of diretor_id
     *
     * @return  self
     */ 
    public function setDiretor_id($diretor_id)
    {
        $this->diretor_id = $diretor_id;

        return $this;
    }
}