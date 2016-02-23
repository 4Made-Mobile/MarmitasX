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
// Classe responsável pelo banco de dados
class BDPedido extends ConexaoBD {

    public function __construct() {
        //vazio
    }

    public function cadastrarPedido($dados) {
        try {
            $this->pdo = $this->abrirBD();
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->pdo->prepare('INSERT INTO pedido Values(
                                                      :id,
                                                      :cliente_id,
                                                      :localizacao_id,
                                                      :data_hora,
                                                      :obs,
                                                      :status,
                                                      :localizacao
                                  )');
            $stmt->execute($dados);
            $this->pdo = $this->fecharBD();
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    public function adicionarPedidoIngrediente($dados) {
        try {
            $this->pdo = $this->abrirBD();
            $stmt = $this->pdo->prepare('INSERT INTO pedido_ingrediente Values(
                                                    :pedido_id,
                                                    :ingrediente
                                )');
            $stmt->execute($dados);
            $this->pdo = $this->fecharBD();
        } catch (PDOException $ex) {
            
        }
    }

    public function lastPedido($id) {
        try {
            $this->pdo = $this->abrirBD();
            $row = $this->pdo->query("SELECT id FROM `pedido` WHERE cliente_id = " . $id . " ORDER BY `id` DESC LIMIT 1")->fetch(PDO::FETCH_OBJ);
            $this->pdo = $this->fecharBD();
            return $row->id;
        } catch (PDOException $ex) {
            return false;
        }
    }

    // Encontrar todos os pedidos válidos
    public function findAll() {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            exit;
        }
        try {
            $query = $pdo->query("
                    select t1.id from pedido t1
                    inner join pedido_ingrediente t2 ON (t1.id = t2.pedido_id)
                    inner join ingrediente t3 ON (t3.id = t2.ingrediente)
                    inner join tipo t4 ON (t4.id = t3.tipo_id)
                    inner join localizacao t5 ON (t5.id = t1.localizacao_id)
                    ");
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOExcepetion $ex) {
            echo "Erro: $ex";
        }
    }

    public function findByCarne($carne = NULL) {
        $pdo = $this->abrirBD();
        if ($pdo == null || $carne == NULL) {
            exit;
        }
        try {
            $query = $pdo->query("

            ");
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOExcepetion $ex) {
            echo "Erro: $ex";
        }
    }

    public function findByLocalizacao($localizacao = NULL) {
        $pdo = $this->abrirBD();
        if ($pdo == null || $localizacao == null) {
            exit;
        }

        try {
            $query = $pdo->query("

          ");

            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOExcepetion $ex) {
            echo "Erro: $ex";
        }
    }

    public function findByLocalizacaoCarne($carne = NULL, $localizacao = NULL) {
        $pdo = $this->abrirBD();
        if ($pdo == null || $carne == NULL || $localizacao == NULL) {
            exit;
        }
        try {
            $query = $pdo->query("

            ");

            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOExcepetion $ex) {
            echo "Erro: $ex";
        }
    }

}
