<?php
	
	class BDPreco{

	private $pdo = null;

    private function abrirBD() {
        $pdo = new PDO("mysql:host=localhost;dbname=fourmade_marmita", "fourmade_marmita", "p2ssw0rd");
        return $pdo;
    }

    private function fecharBD() {
        return null;
    }

    public function lista() {
        try {
            $this->pdo = $this->abrirBD();
            $query = $this->pdo->query("
          		select valor from preco
          		where id = 1
            	");
            $this->pdo = $this->fecharBD();
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            return false;
        }
    }

	}


?>