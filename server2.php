<?php

require_once './database/BDCliente.php';
require_once './database/BDIngrediente.php';
require_once './database/BDLocalizacao.php';
require_once './database/BDPedido.php';
require_once './database/BDPreco.php';
require_once './database/BDTipo.php';

//FUNÇÕES DO WEBSERVICE!
function cardapio() {
    $ingrediente = new BDIngrediente();
    $var = json_encode($ingrediente->cardapio()->fetchAll(PDO::FETCH_OBJ));
    return $var;
}

function localizacao() {
    $localizacao = new BDLocalizacao();
    $var = json_encode($localizacao->findAll());
    return $var;
}

function preco() {
    $preco = new BDPreco();
    $valor = $preco->listarPrecoId()->fetch(PDO::FETCH_OBJ)->valor;
    $var = json_encode($valor);
    return $var;
}

function cliente($array) {
    $cliente = new BDCliente();

    //arrau que sera enviado para o banco de dados
    $dados = array(
        'id' => null,
        'nome' => $array['nome'],
        'telefone' => $array['telefone'],
        'senha' => $array['senha'],
        'status' => 1,
    );

    $var = $cliente->adicionarCliente($dados);
    return json_encode($var);
}

function login($array) {
    $cliente = new BDCliente();
    $var = $cliente->loginCliente($array['telefone'], $array['senha']);
    return json_encode($var);
}

// ADICIONA PEDIDO E OS INGREDIENTES QUE O CLIENTE QUER
function pedido($array) {
    //Prepara os dados para o cadastro=
    $cliente = new BDCliente();
    $localizacao = new BDLocalizacao();
    $pedido = new BDPedido();

    $id_cliente = $cliente->buscaClientetelefone($array['telefone'])->id;
    $localizacao = $localizacao->buscarLocalizacao($array['localizacao_id'])->descricao;
    $dados = array(
        'id' => null,
        'cliente_id' => $id_cliente,
        'localizacao_id' => $array['localizacao_id'],
        'data_hora' => date('Y-m-d G:i:s'),
        'obs' => $array['obs'],
        'status' => 1,
    );

    if ($array['localizacao_id'] == 1) {
        $dados['localizacao'] = $array['localizacao'];
    } else {
        $dados['localizacao'] = $localizacao;
    }

    $res = $pedido->cadastrarPedido($dados);
    if ($res == true) {
        //Pega o id do ultimo pedido cadastrado
        $id_pedido = $pedido->lastPedido($id_cliente);


        foreach ($array['ingrediente'] as $id) {
            //prepara os dados para adicionar os ingrediente

            $dados = array(
                'pedido_id' => $id_pedido,
                'ingrediente' => $id,
            );
            $pedido->adicionarPedidoIngrediente($dados);
        }
        return json_encode(true);
    } else {
        return json_encode(false);
    }
}

//variaveis importantes
$possible_url = array("cardapio", "cliente", "login", "pedido", "preco", "localizacao");
$value = "";

//se o nome method existir e o valor dele estiver dentro do array $possible_url entra no IF
if (isset($_GET['method']) && in_array($_GET['method'], $possible_url)) {
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

        case 'preco':
            $value = preco();
            break;

        case 'localizacao':
            $value = localizacao();
            break;
    }
} else {
    $value = "erro1";
}


//return JSON array
exit(json_encode($value));
?>
