<?php

if(file_exists('../../../database/ConexaoBD.php')) {
    include_once "../../../database/ConexaoBD.php";
}else{
    include_once "database/ConexaoBD.php";
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerIngrediente
 *
 * @author bergonalta
 */
class BDIngrediente extends ConexaoBD {

    public function __construct() {
        //vazio
    }

    public function adicionarIngrediente($array) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            return false;
        }
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('INSERT INTO ingrediente Values(
                                                                    :id,
                                                                    :descricao,
                                                                    :data1,
                                                                    :data2,
                                                                    :tipo_id
                                        )');
            $stmt->execute($array);
            $pdo = $this->fecharBD();
            return $stmt->rowCount();
        } catch (Exception $ex) {
            
        }
    }

    public function listarIngrediente() {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select t1.id AS id, t1.descricao AS descricao,
                                  t1.data1 AS data1 , t1.data2 AS data2,
                                  t2.descricao AS tipo, t1.tipo_id AS tipo_id from ingrediente t1
                                  inner join tipo t2 on (t1.tipo_id = t2.id)");
            return $query;
        } catch (Exception $ex) {
            
        }
    }

    public function buscarIngredienteID($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select t1.id AS id, t1.descricao AS descricao,
                                  t1.data1 AS data1 , t1.data2 AS data2,
                                  t2.descricao AS tipo from ingrediente t1
                                  inner join tipo t2 on (t1.tipo_id = t2.id)
                                  where t1.id = $id");
            return $query;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    public function cardapio() {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return "erro no banco de dados";
        }
        try {
            $data = date("Y-m-d G:i:s");
            $query = $pdo->query("SELECT id, descricao, tipo_id FROM  ingrediente WHERE data1 <= '$data' AND  data2 >=  '$data'");
            $pdo = $this->fecharBD();
            // verifica se existe algo para mostrar
            if (!$query) {
                throw new Exception();
            } else {
                return $query;
            }
        } catch (Exception $ex) {
            return "Erro: $ex";
        }
    }

    public function alterarIngrediente($array) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $stmt = $pdo->prepare('UPDATE ingrediente SET descricao = :descricao, data1 = :data1, data2 = :data2, tipo_id = :tipo_id WHERE id = :id');
            $stmt->execute($array);

            return 1;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

}
