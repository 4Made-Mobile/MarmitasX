<?php

	class BdCliente{

		private $pdo = null;


		private function abrirBD(){
			$pdo = new PDO("mysql:host=localhost;dbname=fourmade_marmita","fourmade_marmita","p2ssw0rd");
			return $pdo;
		}

		private function fecharBD(){
			return null;
		}

		// Pega o cliente pelo telefone e verifica as senhas
		public function verificaLogin($telefone, $senha){
			$var = false;
			$this->pdo = $this->abrirBD();
			$cliente = $this->buscaClienteTelefone($telefone);
			if($cliente->senha == $senha){
				$var = true;
			}else{
				$var = false;
			}
			$this->pdo = $this->fecharBD();
			return $var;
		}

		// Verifica se o número já foi cadastrado, se sim cadastra, se não retorna false.
		public function add($dados){
			// abri o banco e verefica se conseguiu abrir, se não conseguiu retorna falso, se sim continua
			$this->pdo = $this->abrirBD();
			if($this->pdo == null){
				return false;
			}
			// Procura se o telefone informado já está cadastrado
			$cliente = $this->buscaClienteTelefone($dados['telefone']);
			// Cliente
			if(empty($cliente->telefone)){
				$stmt = $this->pdo->prepare('INSERT INTO cliente Values(
																										:id,
																										:nome,
																										:telefone,
																										:senha
																)');
				$stmt->execute($dados);
				$this->pdo = $this->fecharBD();

				//se tudo ocorreu correto retornar true
				$var = true;
			}else{
				$var = false;
			}
			return $var;
		}

		public function buscaClienteTelefone($telefone){
			try{
			if($this->pdo == null){
				$this->pdo = $this->abrirBD();
			}
			$array = $this->pdo->query("select * from cliente where telefone = '". $telefone . "'")->fetch(PDO::FETCH_OBJ);
			return $array;
			}catch(PDOExcepetion $ex){
				return false;
			}
		}

	}

?>
