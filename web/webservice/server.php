<?php
include_once "controllerprincipal.php";
include_once "bdprincipal.php";

  function adicionarCliente($json){
  	return 1;
  }

  function autenticacaoCliente($json){
  	//vazio
  }

  function listaCarpadio($json){
  	//vazio
  }

  function adicionarPedido($json){
  	//vazio
  }

$server = new SoapServer(null, array('uri' => "http://localhost/MarmitasX/web/webservice"));  // ex.: http://localhost/imasters/soap/

$server->addFunction("adicionarCliente");

$server->addFunction("autenticacaoCliente");

$server->addFunction("listaCarpadio");

$server->addFunction("adicionarPedido");
// chamada do método para atender as requisição do serviço 
// se a chamada for um POST executa, senão apenas mostra as funções “cadastradas”

if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$server->handle();
} else {
	$functions = $server->getFunctions();
}
?>
