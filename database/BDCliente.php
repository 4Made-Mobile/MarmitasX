<?php
class BDCliente extends ConexaoBD {

    public function __construct() {
        //vazio
    }

    public function adicionarCliente($array) {
        $pdo = $this->abrirBD();
        if ($pdo == null) {
            return false;
        }
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('INSERT INTO cliente Values(
                                                                    :id,
                                                                    :nome,
                                                                    :telefone,
                                                                    :senha,
                                                                    :status
                                        )');
            $stmt->execute($array);
            $pdo = $this->fecharBD();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function loginCliente($telefone, $senha) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            $var = false;
        }
        try {
            $var = false;
            $cliente = $this->buscaClienteTelefone($telefone);
            if ($cliente->senha == $senha) {
                $var = true;
            } else {
                $var = false;
            }
            $pdo = $this->fecharBD();
            return $var;
        } catch (Exception $ex) {
            return $var;
        }
    }

    public function buscaClientetelefone($telefone) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $array = $pdo->query("select * from cliente where telefone = '" . $telefone . "' AND status != 0")->fetch(PDO::FETCH_OBJ);
            return $array;
        } catch (PDOException $ex) {
            return false;
        }
    }

    public function listarCliente() {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select *from cliente where status != 0");
            return $query;
        } catch (Exception $ex) {
            
        }
    }

    public function buscarClienteID($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $query = $pdo->query("select *from cliente where id = $id where status != 0");
            return $query;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    public function alterarCliente($array) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $stmt = $pdo->prepare('UPDATE cliente SET nome = :nome, telefone = :telefone, senha = :senha WHERE id = :id');
            $stmt->execute($array);
            return 1;
        } catch (PDOException $ex) {
            echo "Erro: $ex";
        }
    }

    public function removerCliente($id) {
        $pdo = $this->abrirBD();
        if ($pdo == NULL) {
            return false;
        }
        try {
            $pdo->query('UPDATE cliente SET status = 0 WHERE id = ' . $id . '');
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

}
