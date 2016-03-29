<?php

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
                                                      :localizacao,
                                                      :tamanho
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

            $data1 = date('Y-m-d G:i:s', strtotime('-14 hours'));

            $query = $pdo->query("
                    select t1.id AS id, t6.nome AS cliente, t3.descricao AS carne,
                    t1.localizacao AS localizacao, t1.tamanho AS tamanho, t1.obs AS obs, t1.status AS status
                    from pedido t1
                    inner join pedido_ingrediente t2 ON (t1.id = t2.pedido_id)
                    inner join ingrediente t3 ON (t3.id = t2.ingrediente)
                    inner join tipo t4 ON (t4.id = t3.tipo_id)
                    inner join localizacao t5 ON (t5.id = t1.localizacao_id)
                    inner join cliente t6 ON (t6.id = t1.cliente_id)
                    where t4.id = 3 AND t1.status != 0
                    AND t1.data_hora >= '$data1'
                    ");
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOExcepetion $ex) {
            echo "Erro: $ex";
        }
    }

    public function findByCarne($carne) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            exit;
        }
        try {

            $data1 = date('Y-m-d G:i:s', strtotime('-14 hours'));

            $query = $pdo->query("
                select t1.id AS id, t6.nome AS cliente, t3.descricao AS carne,
                    t1.localizacao AS localizacao, t1.tamanho AS tamanho, t1.obs AS obs, t1.status AS status
                    from pedido t1
                    inner join pedido_ingrediente t2 ON (t1.id = t2.pedido_id)
                    inner join ingrediente t3 ON (t3.id = t2.ingrediente)
                    inner join tipo t4 ON (t4.id = t3.tipo_id)
                    inner join localizacao t5 ON (t5.id = t1.localizacao_id)
                    inner join cliente t6 ON (t6.id = t1.cliente_id)
                    where t4.id = 3 AND t3.id = $carne AND t1.status != 0
                    AND t1.data_hora >= '$data1'
            ");
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOExcepetion $ex) {
            echo "Erro: $ex";
        }
    }

    public function findByLocalizacao($localizacao) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            exit;
        }

        try {

            $data1 = date('Y-m-d G:i:s', strtotime('-14 hours'));

            $query = $pdo->query("
                select t1.id AS id, t6.nome AS cliente, t3.descricao AS carne,
                    t1.localizacao AS localizacao,t1.tamanho AS tamanho, t1.obs AS obs, t1.status AS status
                    from pedido t1
                    inner join pedido_ingrediente t2 ON (t1.id = t2.pedido_id)
                    inner join ingrediente t3 ON (t3.id = t2.ingrediente)
                    inner join tipo t4 ON (t4.id = t3.tipo_id)
                    inner join localizacao t5 ON (t5.id = t1.localizacao_id)
                    inner join cliente t6 ON (t6.id = t1.cliente_id)
                    where t4.id = 3 AND t1.localizacao_id = " . $localizacao . " AND t1.status != 0
                    AND t1.data_hora >= '$data1'
            ");

            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOExcepetion $ex) {
            echo "Erro: $ex";
        }
    }

    public function findByLocalizacaoCarne($carne = NULL, $localizacao = NULL) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            exit;
        }
        try {

            $data1 = date('Y-m-d G:i:s', strtotime('-14 hours'));

            $query = $pdo->query("
                    select t1.id AS id, t6.nome AS cliente, t3.descricao AS carne,
                    t1.localizacao AS localizacao, t1.obs AS obs, t1.status AS status
                    from pedido t1
                    inner join pedido_ingrediente t2 ON (t1.id = t2.pedido_id)
                    inner join ingrediente t3 ON (t3.id = t2.ingrediente)
                    inner join tipo t4 ON (t4.id = t3.tipo_id)
                    inner join localizacao t5 ON (t5.id = t1.localizacao_id)
                    inner join cliente t6 ON (t6.id = t1.cliente_id)
                    where t3.id = " . $carne . " AND t1.localizacao_id = " . $localizacao . " AND t1.status != 0
                    AND t1.data_hora >= '$data1'
            ");

            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOExcepetion $ex) {
            echo "Erro: $ex";
        }
    }

    public function findById($id) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            exit;
        }
        try {

            $data1 = date('Y-m-d G:i:s', strtotime('-14 hours'));

            $query = $pdo->query("
                select t1.id AS id, t6.nome AS cliente, t3.descricao AS ingrediente,
                    t1.localizacao AS localizacao, t1.obs AS obs, t1.status AS status,
                    t4.descricao AS tipo, t6.telefone AS telefone
                    from pedido t1
                    inner join pedido_ingrediente t2 ON (t1.id = t2.pedido_id)
                    inner join ingrediente t3 ON (t3.id = t2.ingrediente)
                    inner join tipo t4 ON (t4.id = t3.tipo_id)
                    inner join localizacao t5 ON (t5.id = t1.localizacao_id)
                    inner join cliente t6 ON (t6.id = t1.cliente_id)
                    where t1.id = $id AND t1.status != 0 AND t1.data_hora >= '$data1'
            ")->fetchAll(PDO::FETCH_OBJ);
            return $query;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    // modifica o pedido para informar se ele foi impresso ou não
    public function impressoPedido($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $pdo->query("UPDATE pedido SET status = 2 where id = $id");
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    public function removerPedido($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $pdo->query("UPDATE pedido SET status = 0 where id = $id");
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

}
