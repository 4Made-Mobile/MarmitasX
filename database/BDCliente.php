<?php

include_once "../../../database/ConexaoBD.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerCliente
 *
 * @author bergonalta
 */
class BDCliente extends ConexaoBD {

    public function __construct() {
        //vazio
    }

    public function adicionarCliente($array) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            return false;
        }
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('INSERT INTO cliente Values(
                                                                    :id,
                                                                    :nome,
                                                                    :telefone,
                                                                    :senha
                                        )');
            $stmt->execute($array);
            $pdo = $this->fecharBD();
            return $stmt->rowCount();
        } catch (Exception $ex) {
            
        }
    }

    public function listarCliente() {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select *from cliente");
            return $query;
        } catch (Exception $ex) {
            
        }
    }

    public function buscarClienteID($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select *from cliente where id = $id");
            return $query;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    public function alterarCliente($array) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $stmt = $pdo->prepare('UPDATE cliente SET nome = :nome, telefone = :telefone, senha = :senha WHERE id = :id');
            $stmt->execute($array);

            return 1;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

}
