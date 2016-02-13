<?php

include_once "../../../database/ConexaoBD.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerPedido
 *
 * @author bergonalta
 */
class BDPedido extends ConexaoBD {

    public function __construct() {
        //vazio
    }

    public function listarPedido() {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("SELECT t1.id AS id, t5.nome AS cliente, t3.descricao AS carne,
                                  t1.localizacao AS localizacao, t1.obs AS obs
                                  FROM pedido t1
                                  INNER JOIN pedido_ingrediente t2 ON ( t1.id = t2.pedido_id )
                                  INNER JOIN ingrediente t3 ON ( t2.ingrediente = t3.id )
                                  INNER JOIN tipo t4 ON ( t4.id = t3.tipo_id )
                                  INNER JOIN cliente t5 ON ( t1.cliente_id = t5.id )
                                  WHERE data_hora =  '" . date("Y-m-d") . "'
                                  AND t4.id =3");
            return $query;
        } catch (Exception $ex) {
            
        }
    }

    public function buscarPedidoID($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("SELECT t1.id AS id, t5.nome AS cliente, t4.descricao AS tipo,
                                  t1.localizacao AS localizacao, t1.obs AS obs, t3.descricao AS ingrediente
                                  FROM pedido t1
                                  INNER JOIN pedido_ingrediente t2 ON ( t1.id = t2.pedido_id )
                                  INNER JOIN ingrediente t3 ON ( t2.ingrediente = t3.id )
                                  INNER JOIN tipo t4 ON ( t4.id = t3.tipo_id )
                                  INNER JOIN cliente t5 ON ( t1.cliente_id = t5.id )
                                  WHERE data_hora =  '" . date("Y-m-d") . "'
                                  AND t1.id = $id")->fetchAll(PDO::FETCH_OBJ);
            return $query;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    public function listaPedidoIngredienteId($id) {
        try {
            $this->pdo = $this->abrirBD();
            $lista = $this->pdo->query("select t2.descricao AS ingrediente, t3.descricao AS tipo
                                        from pedido_ingrediente t1
                                        inner join ingrediente t2 ON (t1.ingrediente_id = t2.id)
                                        inner join tipo t3 ON (t2.tipo_id = t3.id)
                                        where t1.pedido_id = $id")->fetchAll(PDO::FETCH_OBJ);
            return $lista;
        } catch (Exception $ex) {
            
        }
    }

    public function listarPedidoCarne($ingrediente) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("SELECT t1.id AS id, t5.nome AS cliente, t3.descricao AS carne,
                                  t1.localizacao AS localizacao, t1.obs AS obs
                                  FROM pedido t1
                                  INNER JOIN pedido_ingrediente t2 ON ( t1.id = t2.pedido_id )
                                  INNER JOIN ingrediente t3 ON ( t2.ingrediente = t3.id )
                                  INNER JOIN tipo t4 ON ( t4.id = t3.tipo_id )
                                  INNER JOIN cliente t5 ON ( t1.cliente_id = t5.id )
                                  WHERE data_hora =  '" . date("Y-m-d") . "'
                                  AND t3.id = $ingrediente")->fetchAll(PDO::FETCH_OBJ);
            return $query;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

}
