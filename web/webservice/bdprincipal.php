<?php
	
	class BDPrincipal{

		private $pdo;

		private function abrirBD(){
			try{
				$this->pdo = new PDO();
			}catch(PDOExcepetion $ex){
				echo "Erro";
			}
		}

		private function fecharBD(){
			$this->pdo = null;
		}

		public function buscaUsuario($telefone){

		}

		public function cadastrarUsuari($array){

		}

		public function cadastraPedido($array){

		}		

		public function cadastraPedidoCardapio(){

		}

		public function listaCardapioDia(){
			
		}

	}

?>