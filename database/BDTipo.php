<?php

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
                                                                    :descricao,
                                                                    :status
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
            $query = $pdo->query("select *from tipo where status != 0");
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
            $query = $pdo->query("select *from tipo where id = $id AND id != 0");
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
            $pdo->query("UPDATE tipo set status = 0 where id = $id");
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

}
