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

    public function buscarPrecoID($id) {
        try {
            $Preco = new BDPreco();
            $busca = $Preco->buscarPrecoID($id);
            return $busca;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function alterarPreco($valor) {
        try {
            $Preco = new BDPreco();
            $res = $Preco->alterarPreco($valor);
            return $res;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }    
    
}

?>
