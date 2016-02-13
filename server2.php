<?php

  require_once "bd/bdcardapio.php";
  require_once "bd/bdcliente.php";
  require_once "bd/bdpedido.php";

    //FUNÇÕES DO WEBSERVICE!
	function cardapio(){
        $cardapio = new BdCardapio();
        $var = json_encode($cardapio->lista());
        return $var;
	}

	function cliente($array){
 		$cliente = new BdCliente();

    //arrau que sera enviado para o banco de dados
    $dados = array(
      'id' => null,
      'nome' => $array['nome'],
      'telefone' => $array['telefone'],
      'senha' => $array['senha'],
    );

    $var = $cliente->add($dados);
    return json_encode($var);
	}

	function login($array){
    $cliente = new BdCliente();
    $var = $cliente->verificaLogin($array['telefone'], $array['senha']);
    return json_encode($var);
	}

  // ADICIONA PEDIDO E OS INGREDIENTES QUE O CLIENTE QUER
	function pedido($array){
    //Prepara os dados para o cadastro=
    $cliente = new BdCliente();
    $id_cliente = $cliente->buscaClienteTelefone($array['telefone'])->id;
 		$pedido = new BDPedido();
    $dados = array(
      'id' => null,
      'cliente_id' => $id_cliente,
      'localizacao' => $array['localizacao'],
      'data_hora' => date('Y-m-d G:i:s'),
      'obs' => $array['obs'],
      'status' => 1
    );
    //adiicona os dados, se tudo ocorreu bem retorna true, se não retorna false
    $res = $pedido->add($dados);
    if($res == true){
      //Pega o id do ultimo pedido cadastrado
      $id_pedido = $pedido->lastPedido($id_cliente);


      foreach ($array['ingrediente'] as $id) {
        //prepara os dados para adicionar os ingrediente

        $dados = array(
          'pedido_id' => $id_pedido,
          'ingrediente' => $id,
        );
        $pedido->pedidoIngrediente($dados);
      }
      return json_encode(true);
    }else{
      return json_encode(false);
    }
	}

	//variaveis importantes
    $possible_url = array("cardapio", "cliente", "login" ,"pedido");
    $value = "";

    //se o nome method existir e o valor dele estiver dentro do array $possible_url entra no IF
    if (isset($_GET['method']) && in_array($_GET['method'], $possible_url)){
    	switch ($_GET['method']) {

    		case 'cardapio':
    			$value = cardapio();
    			break;

    		case 'cliente':
    			$value = cliente($_GET['value']);
    			break;


    		case 'login':
    			$value = login($_GET['value']);
    			break;


    		case 'pedido':
    			$value = pedido($_GET['value']);
    			break;

    	}
    }else{
    	$value = "erro1";
    }


    //return JSON array
    exit(json_encode($value));
?>
