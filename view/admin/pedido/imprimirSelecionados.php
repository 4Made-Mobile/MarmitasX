<?php

require_once '../../../autoload.php';

$fachada = new Fachada();
$fachada->verificarLogin();

if (empty($_POST)) {
    header("Location: listaPedido.php");
} else {

    $lista = array(
    );

    // Cria uma lista dos IDs que devem ser impressos
    foreach ($_POST AS $linha) {
        $lista[]['id'] = $linha;
    }

    // Transforma o segundo array em objeto ;)
    foreach ($lista as $key => $value) {
        $lista[$key] = (object) $value;
    }

    $fachada->imprimirLista($lista);
}