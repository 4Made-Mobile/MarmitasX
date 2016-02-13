<?php
	class BdCardapio{

		private $pdo = null;


		private function abrirBD(){
			$pdo = new PDO("mysql:host=localhost;dbname=fourmade_marmita","fourmade_marmita","p2ssw0rd");
			return $pdo;
		}

		private function fecharBD(){
			return null;
		}

		public function lista(){
			$this->pdo = $this->abrirBD();
			$data = date("Y-m-d");
			$query = $this->pdo->query("SELECT id, descricao, tipo_id FROM  ingrediente WHERE data1 <= '$data' AND  data2 >=  '$data'")->fetchAll();
			$this->pdo = $this->fecharBD();
			if(!$query){
				return "not found";
			}else{
				return $query;
			}
		}

	}

?>
