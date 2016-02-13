<?php

include_once "../../../database/ConexaoBD.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerTipo
 *
 * @author bergonalta
 */
class BDTipo extends ConexaoBD {

    public function __construct() {
        //vazio
    }

    public function adicionarTipo($array) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            return false;
        }
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('INSERT INTO tipo Values(
                                                                    :id,
                                                                    :descricao
                                        )');
            $stmt->execute($array);
            $pdo = $this->fecharBD();
            return $stmt->rowCount();
        } catch (Exception $ex) {
            
        }
    }

    public function listarTipo() {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select *from tipo");
            return $query;
        } catch (Exception $ex) {
            
        }
    }

    public function buscarTipoID($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select *from tipo where id = $id");
            return $query;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    public function alterarTipo($array) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("UPDATE tipo set descricao = '" . $array['descricao'] . "'
            where id = " . $array['id'] . "");
            return 1;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    public function removerTipo($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("UPDATE tipo set status_tipo = 0 AND data_fim_tipo = " . date('y-m-d') . " where id = $id");
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

}
