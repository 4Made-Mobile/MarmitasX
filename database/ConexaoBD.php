<?php

class ConexaoBD {

    public function __construct() {
        
    }

    protected function abrirBD() {
        $pdo = null;
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=fourmade_marmita", "fourmade_marmita", "p2ssw0rd");
        } catch (PDOException $ex) {
            $pdo = new PDO("mysql:host=localhost;dbname=fourmade_marmita", "root", "");
        }
        return $pdo;
    }

    protected function fecharBD() {
        try {
            return null;
        } catch (PDOException $ex) {
            echo "erro: $ex";
        }
    }

}
