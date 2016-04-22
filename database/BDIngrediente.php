<?php

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
                                                                    :tipo_id,
                                                                    :status
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
                                  inner join tipo t2 on (t1.tipo_id = t2.id)
                                  where t1.status != 0");
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
                                  where t1.id = $id AND t1.status != 0");
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
            $query = $pdo->query("SELECT id, descricao, tipo_id FROM  ingrediente WHERE data1 <= '$data' AND  data2 >=  '$data' AND status != 0 ORDER BY descricao");
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

    public function listarIngredienteCarnes() {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select t1.id AS id, t1.descricao AS descricao,
                                  t1.data1 AS data1 , t1.data2 AS data2,
                                  t2.descricao AS tipo from ingrediente t1
                                  inner join tipo t2 on (t1.tipo_id = t2.id)
                                  where t2.id = 3 AND t1.status != 0");
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    public function removerIngrediente($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("UPDATE ingrediente SET status = 0 where id = $id");
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

}
