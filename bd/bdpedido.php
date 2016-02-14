<?php

class BdPedido {

    private $pdo = null;

    private function abrirBD() {
        $pdo = new PDO("mysql:host=localhost;dbname=fourmade_marmita", "fourmade_marmita", "p2ssw0rd");
        return $pdo;
    }

    private function fecharBD() {
        return null;
    }

    public function add($dados) {
        try {
            $this->pdo = $this->abrirBD();
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->pdo->prepare('INSERT INTO pedido Values(
                                                      :id,
                                                      :cliente_id,
                                                      :obs,
                                                      :localizacao,
                                                      :data_hora,
                                                      :status
                                  )');
            $stmt->execute($dados);
            $this->pdo = $this->fecharBD();
            return true;
        } catch (PDOException $ex) {
            return false;
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

    public function pedidoIngrediente($dados) {
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

}

?>
