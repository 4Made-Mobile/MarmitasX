<?php

include_once "../../../database/BDPedido.php";

class ControllerPedido {

    public function __construct() {
//vazio
    }

    public function cadastrarPedido($array) {
        try {
            $pedido = new BDPedido();
            $res = $pedido->cadastrarPedido($array);
            return res;
        } catch (Exception $ex) {
            return 2;
        }
    }

    public function impressoPedido($id) {
        $bd = new BDPedido();
        $bd->impressoPedido($id);
    }

    public function adicionarPedidoIngrediente($id_pedido, $id_ingrediente) {
        try {

            $array = array(
                'pedido_id' => $id_pedido,
                'ingrediente' => $id_ingrediente,
            );

            $pedido = new BDPedido();
            $res = $pedido->adicionarPedidoIngrediente($array);
            return $res;
        } catch (Exception $ex) {
            return 2;
        }
    }

    public function buscarPedidoID($id) {
        try {
            $pedido = new BDPedido();
            $busca = $pedido->findById($id);
            return $busca;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function listarPedido($carne = NULL, $localizacao = NULL) {
        try {
            $obj = new BDPedido();

            // Aquela velha verificação estilosa
            if ($carne == NULL && $localizacao == NULL) {
                $lista = $obj->findAll();
            } else if ($carne != NULL && $localizacao == NULL) {
                $lista = $obj->FindByCarne($carne);
            } else if ($carne == NULL && $localizacao != NULL) {
                $lista = $obj->findByLocalizacao($localizacao);
            } else {
                $lista = $obj->findByLocalizacaoCarne($carne, $localizacao);
            }
            return $lista;
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

    public function removerPedido($id) {
        try {
            $pedido = new BDPedido();
            $res = $pedido->removerPedido($id);
            return $res;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function lastPedido($id) {
        try {
            $pedido = new BDPedido();
            $res = $pedido->lastPedido($id);
            return $res;
        } catch (Exception $ex) {
            return "erro: $ex";
        }
    }

    public function imprimirLista($lista) {
        try {
            $mpdf = new mPDF('', 'A7');
            $mpdf->allow_charset_conversion = true;
// Gerando conteúdo do PDF
            ob_start();
            $html = ob_get_clean();
            $html = utf8_encode($html);
            foreach ($lista as $linha) {
                $this->impressoPedido($linha->id);
                $obj = $this->buscarPedidoID($linha->id);
                $html .= "<b>Cliente: " . $obj[0]->cliente . "</b><br>";
                $html .= "Telefone: " . $obj[0]->telefone . "<br>";
                $html .= "Localização: " . $obj[0]->localizacao . "<br>";
                $html .= "Observação: " . $obj[0]->obs . "<br>";
                $html .= "<b>INGREDIENTES</b><br>";
                foreach ($obj as $item) {
                    $html .= "<b>" . $item->tipo . "</b>: " . $item->ingrediente;
                    $html .= "<br>";
                }
                $html .= "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
                $html .= $obj[0]->cliente . "<br>";
                $html .= "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
            }
            // GERANDO PDF
            $mpdf->WriteHTML($html);
            $mpdf->Output('pedido' . '.pdf', 'I');
            exit();
        } catch (Exception $ex) {
            echo "Erro: $ex";
        }
    }

}

?>
