<?php

require_once '../../../autoload.php';
include_once '../../../assets/php/mpdf/mpdf.php';
$fachada = new Fachada();
$lista = $fachada->listarPedido();

// preenche os objetos e afins
if (!empty($_GET['ingrediente']) && $_GET['ingrediente'] != null && $_GET['ingrediente'] != 0) {
    $lista = $fachada->listarPedido($_GET['ingrediente'], $_GET['localizacao']);
} else if (!empty($_GET['pedido']) && $_GET['pedido'] != null && $_GET['pedido'] != 0) {
    $pedido = $fachada->buscarPedidoId($_GET['pedido']);
}

// gera o pdf
if (empty($_GET['pedido'])) {
    $fachada->imprimirLista($lista);
} else {
    $fachada->imprimirPedido($pedido);
}