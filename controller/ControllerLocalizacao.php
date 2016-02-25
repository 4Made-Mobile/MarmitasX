<?php

include_once "../../../database/BDLocalizacao.php";

class ControllerLocalizacao {

    public function cadastrar($array) {
        $db = new BDLocalizacao();
        $obj = $db->findByDescricao($array['descricao']);
        if (!empty($obj)) {
            return 0;
        }
        try {
            $res = $db->cadastrar($array);
            return $res;
        } catch (Exception $ex) {
            return 2;
        }
    }

    public function listar() {
        $db = new BDLocalizacao();
        try {
            $lista = $db->findAll();
            return $lista;
        } catch (Exception $ex) {
            exit;
        }
    }

    public function buscarLocalizacao($id) {
        $db = new BDLocalizacao();
        try {
            $busca = $db->buscarLocalizacao($id);
            return $busca;
        } catch (Exception $ex) {
            exit;
        }
    }

    public function alterarLocalizacao($array) {
        return $res;
    }

    public function removerLocalizacao($id) {
        try {
            $db = new BDLocalizacao();
            $res = $db->removerLocalizacao($id);
            return $res;
        } catch (Exception $ex) {
            return false;
        }
    }

}

?>