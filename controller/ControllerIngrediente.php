<?php

include_once "../../../database/BDIngrediente.php";

class ControllerIngrediente {

    public function __construct() {
        //vazio
    }

    public function adicionarIngrediente($array) {
        try {
            $tipo = new BDIngrediente();
            // para o cadatro funcionar a respostas nos parametros tem que ser: false, true e false. Por conta do '!' o primeiro e terceiro false viram true            
            $res = $tipo->adicionarIngrediente($array);
            return $res;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function verificaDescricaoIngrediente($descricao) {
        try {
            $tipo = new BDIngrediente();
            $lista = $tipo->listarIngrediente()->fetchAll(PDO::FETCH_OBJ);
            foreach ($lista as $valor) {
                if ($valor->descricao == $descricao) {
                    return true;
                }
            }
            return false;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function listarIngrediente() {
        try {
            $tipo = new BDIngrediente();
            $lista = $tipo->listarIngrediente();
            return $lista;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function buscarIngredienteID($id) {
        try {
            $tipo = new BDIngrediente();
            $busca = $tipo->buscarIngredienteID($id);
            return $busca;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function alterarIngrediente($array) {
        try {
            $tipo = new BDIngrediente();
            $res = $tipo->alterarIngrediente($array);
            return $res;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function removerIngrediente($id) {
        try {
            $ingrediente = new BDIngrediente();
            $res = $ingrediente->removerIngrediente($id);
            return $res;
        } catch (Excepetion $ex) {
            echo "Erro: $ex";
        }
    }

    public function cardapio() {
        try {
            $ingredintes = new BDIngrediente();
            $lista = $ingredintes->cardapio();
            return $lista;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function listarIngredienteCarnes() {
        try {
            $ingredientes = new BDIngrediente();
            $lista = $ingredientes->listarIngredienteCarnes();
            return $lista;
        } catch (Exception $ex) {
            return false;
        }
    }

}