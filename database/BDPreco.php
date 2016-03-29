<?php

class BDPreco extends ConexaoBD {

    public function __construct() {
        //vazio
    }

    public function listarPreco() {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select *from preco");
            return $query;
        } catch (Exception $ex) {
            
        }
    }

    public function listarPrecoId() {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select *from preco where id = 1");
            return $query;
        } catch (PDOException $ex) {
            return false;
        }
    }

    public function buscarPrecoID($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select *from preco where id = $id");
            return $query;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    public function alterarPreco($array) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("UPDATE preco set valor = " . $array['valor'] . "
            where id = " . $array['id'] . "");
            return 1;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

}
