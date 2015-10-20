<?php

// passando o endere�o do servidor
$client = new SoapClient(null, array(
	'location' => 'http://localhost/MarmitasX/web/webservice/server.php',  // ex.: http://localhost/imasters/soap/server.php
	'uri' => 'http://localhost/MarmitasX/web/webservice',  				// ex.: http://localhost/imasters/soap/
	'trace' => 1));
// chamada do servi�o SOAP
$array = array(
	'nome' => 'vandemberg',
	'endereco' => 'Rua Adelia Em�lia Florencio, n�mero 311',
	'referencia' => 'Depois da casa da sua m�e!',
	'telefone' => '(81) - 9 9696-1947');
$result = $client->adicionarCliente(); 			 
// verifica erros na execu��o do servi�o e exibe o resultado
if (is_soap_fault($result)){
	trigger_error("SOAP Fault: (faultcode: {$result->faultcode},
	faultstring: {$result->faulstring})", E_ERROR);
}else{
	if($result == 1){
		echo "Cadastro realizado!";
	}else{
		echo "Erro no cadastro f�!";
	}
}
?>

