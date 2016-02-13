<?php

include_once '../../../assets/php/mpdf/mpdf.php';
include_once "../../../controller/ControllerLayout.php";
include_once "../../../controller/ControllerTipo.php";
include_once "../../../controller/ControllerIngrediente.php";
include_once "../../../controller/ControllerCliente.php";
include_once "../../../controller/ControllerPedido.php";

class Fachada {

    public function __construct() {
        //vazio
    }

    public function imprimirLista($lista) {
        $pedido = new ControllerPedido();
        $pedido->imprimirLista($lista);
    }

    public function imprimirPedido($obj) {
        $pedido = new ControllerPedido();
        $pedido->imprimirPedido($obj);
    }

    public function headerLayout() {
        $layout = new ControllerLayout();
        $layout->headerLayout();
    }

    public function sideLayout() {
        $layout = new ControllerLayout();
        $layout->sideLayout();
    }

    public function adicionarTipo($array) {
        $tipo = new ControllerTipo();
        $res = $tipo->adicionarTipo($array);
        return $res;
    }

    public function listarTipo() {
        $tipo = new ControllerTipo();
        $lista = $tipo->listarTipo();
        return $lista;
    }

    public function buscarTipoId($id) {
        $tipo = new ControllerTipo();
        $busca = $tipo->buscarTipoID($id);
        return $busca;
    }

    public function alterarTipo($array) {
        $tipo = new ControllerTipo();
        $res = $tipo->alterarTipo($array);
        return $res;
    }

    public function adicionarIngrediente($array) {
        $ingrediente = new ControllerIngrediente();
        $res = $ingrediente->adicionarIngrediente($array);
        return $res;
    }

    public function buscarIngredienteID($id) {
        $ingrediente = new ControllerIngrediente();
        $res = $ingrediente->buscarIngredienteID($id);
        return $res;
    }

    public function listarIngrediente() {
        $ingrediente = new ControllerIngrediente();
        $res = $ingrediente->listarIngrediente();
        return $res;
    }

    public function alterarIngrediente($array) {
        $ingrediente = new ControllerIngrediente();
        $res = $ingrediente->alterarIngrediente($array);
        return $res;
    }

    public function adicionarCliente($array) {
        $cliente = new ControllerCliente();
        $res = $cliente->adicionarCliente($array);
        return $res;
    }

    public function buscarClienteID($id) {
        $cliente = new ControllerCliente();
        $res = $cliente->buscarClienteID($id);
        return $res;
    }

    public function listarCliente() {
        $cliente = new ControllerCliente();
        $res = $cliente->listarCliente();
        return $res;
    }

    public function alterarCliente($array) {
        $cliente = new ControllerCliente();
        $res = $cliente->alterarCliente($array);
        return $res;
    }

    public function listarPedido() {
        $pedido = new ControllerPedido();
        $res = $pedido->listarPedido();
        return $res;
    }

    public function listarPedidoCarne($ingrediente) {
        $pedido = new ControllerPedido();
        $res = $pedido->listarPedidoCarne($ingrediente);
        return $res;
    }

    public function buscarPedidoId($id) {
        $pedido = new ControllerPedido();
        $res = $pedido->buscarPedidoId($id);
        return $res;
    }

    //Por favor futuro programador, levar isso para o controller depois
    //aproveita e retira e transferir a l�gica dentro da pasta BD para database... se n�o o c�digo fica reduntante
    public function verificarLogin() {
        if (!empty($_SESSION['login'])) {
            if (!$_SESSION['login'] == true) {
                header("Location: ../../..");
            }
        } else {
            session_start();
            if (!$_SESSION['login']) {
                header("Location: ../../../");
            }
        }
    }

    //Isso aqui tamb�m
    public function deslogar() {
        session_abort('login');
        header("Location: ../../../");
    }

}