<?php

include_once '../../../assets/php/mpdf/mpdf.php';
include_once "../../../controller/ControllerLayout.php";
include_once "../../../controller/ControllerTipo.php";
include_once "../../../controller/ControllerIngrediente.php";
include_once "../../../controller/ControllerCliente.php";
include_once "../../../controller/ControllerPedido.php";
include_once "../../../controller/ControllerLocalizacao.php";
include_once "../../../controller/ControllerPreco.php";

class Fachada {

    public function __construct() {
        //vazio
    }

    public function imprimirLista($lista) {
        $pedido = new ControllerPedido();
        $pedido->imprimirLista($lista);
    }

    public function cadastrarPedido($array) {
        $pedido = new ControllerPedido();
        $res = $pedido->cadastrarPedido($array);
        return $res;
    }

    public function adicionarPedidoIngrediente($id_pedido, $id_ingrediente) {
        $pedido = new ControllerPedido();
        $res = $pedido->adicionarPedidoIngrediente($id_pedido, $id_ingrediente);
        return $res;
    }

    public function cadastrarPedidoIngrediente($array, $id) {
        $pedido = new ControllerPedido();
        $res = $pedido->cadastrarPedidoIngrediente($array, $id);
        return $res;
    }

    public function lastPedido($id) {
        $pedido = new ControllerPedido();
        $res = $pedido->lastPedido($id);
        return $res;
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

    public function carpadio() {
        $ingredientes = new ControllerIngrediente();
        $lista = $ingredientes->cardapio();
        return $lista;
    }

    public function listarIngredienteCarnes() {
        $ingredientes = new ControllerIngrediente();
        $lista = $ingredientes->listarIngredienteCarnes();
        return $lista;
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

    public function buscarClienteTelefone($telefone) {
        $cliente = new ControllerCliente();
        return $cliente->buscarClienteTelefone($telefone);
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

    // deixar apenas um metodo para retornar qualquer tipo de lista
    public function listarPedido($carne = NULL, $localizacao = NULL) {
        $pedido = new ControllerPedido();
        $res = $pedido->listarPedido($carne, $localizacao);
        return $res;
    }

    public function buscarPedidoId($id) {
        $pedido = new ControllerPedido();
        $res = $pedido->buscarPedidoId($id);
        return $res;
    }

    // CRUD da localização
    public function cadastrarLocalizacao($array) {
        $localizacao = new ControllerLocalizacao();
        $res = $localizacao->cadastrar($array);
        return $res;
    }

    public function alterarLocalizacao($array) {
        $localizacao = new ControllerLocalizacao();
        $res = $localizacao->alterarLocalizacao($array);
        return $res;
    }

    public function listarLocalizacao() {
        $localizacao = new ControllerLocalizacao();
        $lista = $localizacao->listar();
        return $lista;
    }

    public function buscarLocalizacao($id) {
        $localizacao = new ControllerLocalizacao();
        $busca = $localizacao->buscarLocalizacao($id);
        return $busca;
    }

    public function removerLocalizacao($id) {
        $localizacao = new ControllerLocalizacao();
        $res = $localizacao->removerLocalizacao($id);
        return $res;
    }

    // Alterar e exibir preço
    public function buscarPrecoID($id) {
        $preco = new ControllerPreco();
        $res = $preco->buscarPrecoID($id);
        return $res;
    }

    public function alterarPreco($array) {
        $preco = new ControllerPreco();
        $res = $preco->alterarPreco($array);
        return $res;
    }

    public function listarPreco() {
        $preco = new ControllerPreco();
        $res = $preco->listarPreco();
        return $res;
    }

    public function listarPrecoId() {
        $preco = new ControllerPreco();
        $res = $preco->listarPrecoId();
        return $res;
    }

    public function loginCliente($telefone, $senha) {
        $cliente = new ControllerCliente();
        $res = $cliente->loginCliente();
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

    public function removerTipo($id) {
        $tipo = new ControllerTipo();
        $res = $tipo->removerTipo($id);
        return $res;
    }

    public function removerIngrediente($id) {
        $ingrediente = new ControllerIngrediente();
        $res = $ingrediente->removerIngrediente($id);
        return $res;
    }

    public function removerPedido($id) {
        $pedido = new ControllerPedido();
        $res = $pedido->removerPedido($id);
        return $res;
    }

    public function removerCliente($id) {
        $cliente = new ControllerCliente();
        $res = $cliente->removerCliente($id);
        return $res;
    }

    //Isso aqui também
    public function deslogar() {
        session_abort('login');
        header("Location: ../../../");
    }

}
