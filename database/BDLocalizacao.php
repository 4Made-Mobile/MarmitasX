<?php

class BDLocalizacao extends ConexaoBD {

    public function cadastrar($array) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            return 3;
        }
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('INSERT INTO localizacao Values(
                                                                    :id,
                                                                    :descricao
                                        )');
            $stmt->execute($array);
            $pdo = $this->fecharBD();
            return 1;
        } catch (PDOExcepetion $ex) {
            return 4;
        }
    }

    public function buscarLocalizacao($id) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            return 3;
        }
        try {
            print_r($id);
            $query = $pdo->query("select *from localizacao where id = " . $id . "")->fetch(PDO::FETCH_OBJ);
            return $query;
        } catch (PDOException $ex) {
            return 4;
        }
    }

    public function findAll() {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            exit;
        }
        try {
            $query = $pdo->query("select *from localizacao")->fetchAll(PDO::FETCH_OBJ);
            return $query;
        } catch (PDOExcepetion $ex) {
            return 4;
        }
    }

    public function findByDescricao($descricao) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            exit;
        }
        try {
            $query = $pdo->query("select *from localizacao where descricao like " . $descricao . "");
            return $query;
        } catch (PDOExcepetion $ex) {
            return 4;
        }
    }

    public function removerLocalizacao($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("DELETE FROM LOCALIZACAO WHERE ID = $id");
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

}