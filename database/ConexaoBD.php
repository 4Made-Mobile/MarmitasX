<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConexaoBD
 *
 * @author bergonalta
 */
//Essa classe existe
class ConexaoBD {

    public function __construct() {
        
    }

    protected function abrirBD() {
        $pdo = null;
        try {
            //$pdo = new PDO("mysql:host=localhost;dbname=fourmade_marmita", "fourmade_marmita", "p2ssw0rd");
            $pdo = new PDO("mysql:host=localhost;dbname=fourmade_marmita", "root", "");
        } catch (PDOException $ex) {
            echo $ex;
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
