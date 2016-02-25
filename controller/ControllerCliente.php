<?php

include_once "../../../database/BDCliente.php";

class ControllerCliente {

    public function __construct() {
        //vazio
    }

    public function adicionarCliente($array) {
        try {
            $tipo = new BDCliente();
            // para o cadatro funcionar a respostas nos parametros tem que ser: false, true e false. Por conta do '!' o primeiro e terceiro false viram true            
            $res = $tipo->adicionarCliente($array);
            return $res;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function verificaDescricaoCliente($telefone) {
        try {
            $tipo = new BDCliente();
            $lista = $tipo->listarCliente()->fetchAll(PDO::FETCH_OBJ);
            foreach ($lista as $valor) {
                if ($valor->descricao == $telefone) {
                    return true;
                }
            }
            return false;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function listarCliente() {
        try {
            $tipo = new BDCliente();
            $lista = $tipo->listarCliente();
            return $lista;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function buscarClienteID($id) {
        try {
            $tipo = new BDCliente();
            $busca = $tipo->buscarClienteID($id);
            return $busca;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function buscarClienteTelefone($telefone) {
        try {
            $cliente = new BDCliente();
            $busca = $cliente->buscaClientetelefone($telefone);
            return $busca;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function alterarCliente($array) {
        try {
            $tipo = new BDCliente();
            $res = $tipo->alterarCliente($array);
            return $res;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function loginCliente($telefone, $senha) {
        try {
            $cliente = new BDCliente();
            $res = $cliente->loginCliente($telefone, $senha);
            return $res;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function removerCliente($id) {
        try {
            $cliente = new BDCliente();
            $res = $cliente->removerCliente($id);
            return $res;
        } catch (Exception $ex) {
            return false;
        }
    }

}

?>
