<?php

class ControllerTipo {

    public function __construct() {
        //vazio
    }

    public function adicionarTipo($array) {
        try {
            $tipo = new BDTipo();
            // para o cadatro funcionar a respostas nos parametros tem que ser: false, true e false. Por conta do '!' o primeiro e terceiro false viram true
            if (!empty($array['descricao']) && !$this->verificaDescricaoTipo($array['descricao'])) {
                $res = $tipo->adicionarTipo($array);
                return $res;
            }
            return 0;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function verificaDescricaoTipo($descricao) {
        try {
            $tipo = new BDTipo();
            $lista = $tipo->listarTipo()->fetchAll(PDO::FETCH_OBJ);
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

    public function listarTipo() {
        try {
            $tipo = new BDTipo();
            $lista = $tipo->listarTipo();
            return $lista;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function buscarTipoID($id) {
        try {
            $tipo = new BDTipo();
            $busca = $tipo->buscarTipoID($id);
            return $busca;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function alterarTipo($array) {
        try {
            $tipo = new BDTipo();
            $res = $tipo->alterarTipo($array);
            return $res;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function removerTipo($id) {
        try {
            $tipo = new BDTipo();
            $res = $tipo->removerTipo($id);
            return $res;
        } catch (Excepetion $ex) {
            return false;
        }
    }

}