<?php

include_once "../../../fachada/Fachada.php";
include_once '../../../assets/php/mpdf/mpdf.php';
$fachada = new Fachada();
$lista = $fachada->listarPedido()->fetchAll(PDO::FETCH_OBJ);

// preenche os objetos e afins
if (!empty($_GET['ingrediente']) && $_GET['ingrediente'] != null && $_GET['ingrediente'] != 0) {
    $lista = $fachada->listarPedidoCarne($_GET['ingrediente']);
} else if (!empty($_GET['pedido']) && $_GET['pedido'] != null && $_GET['pedido'] != 0) {
    $pedido = $fachada->buscarPedidoId($_GET['pedido']);
}

// gera o pdf
if (empty($_GET['pedido'])) {
    $fachada->imprimirLista($lista);
} else {
    $fachada->imprimirPedido($pedido);
}
?>