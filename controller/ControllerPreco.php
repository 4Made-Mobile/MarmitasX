<?php

include_once "../../../database/BDPreco.php";

class ControllerPreco {

    public function __construct() {
        //vazio
    }

    public function listarPreco() {
        try {
            $preco = new BDPreco();
            $lista = $preco->listarPreco();
            return $lista;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function listarPrecoId() {
        try {
            $preco = new BDPreco();
            $lista = $preco->listarPrecoId();
            return $lista;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function buscarPrecoID($id) {
        try {
            $Preco = new BDPreco();
            $busca = $Preco->buscarPrecoID($id);
            return $busca;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function alterarPreco($array) {
        try {
            $preco = new BDPreco();
            $res = $preco->alterarPreco($array);
            return $res;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

}