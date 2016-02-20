2<?php
	
	class BDLocalizacao extends ConexaoBD {

		public function cadastrar($array){
			$pdo = $this->abrirBD();
			if($pdo == null){
				return 3;
			}
			try{
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('INSERT INTO localizacao Values(
                                                                    :id,
                                                                    :descricao
                                        )');
            $stmt->execute($array);
            $pdo = $this->fecharBD();
            return 1;
			}catch(PDOExcepetion $ex){
				return 4;
			}
		}

		public function findAll(){
			$pdo = $this->abrirBD();
			if($pdo == null){
				exit;
			}
			try{	
				$query = $pdo->query("select *from localizacao")->fetchAll(PDO::FETCH_OBJ);
				return $query;
			}catch(PDOExcepetion $ex){
				echo "Erro: $ex";
			}
		}

		public function findByDescricao($descricao){
			$pdo = $this->abrirBD();
			if($pdo == NULL){
				exit;
			}
			try{
				$query = $pdo->query("select *from localizacao where descricao = " . $descricao . "");
				return $query;
			}catch(PDOExcepetion $ex){
				exit;
			}
		}

	}


?>