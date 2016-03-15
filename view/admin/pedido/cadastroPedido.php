<?php
// inicia a sessão
session_start();

include_once "../../../fachada/Fachada.php";
$fachada = new Fachada();
$fachada->verificarLogin();
if (!empty($_POST)) {

    //Se escolher o botão de adicionar no carrinho
    if (!empty($_POST['adicionar'])) {
        if (!empty($_SESSION['lista_ingredientes'])) {
            $_SESSION['lista_ingredientes'][] = $_POST['id_ingrediente'];
        } else {
            $_SESSION['lista_ingredientes'] = array();
            $_SESSION['lista_ingredientes'][] = $_POST['id_ingrediente'];
        }

        //Se escolher cadastro o ROP
    } else if (!empty($_POST['enviar'])) {
        // Preparando array para adiconar no banco de dados
        $array = array(
            'id' => null,
            'cliente_id' => $_POST['cliente_id'],
            'localizacao_id' => $_POST['localizacao_id'],
            'data_hora' => date('Y-m-d G:i:s'),
            'obs' => $_POST['obs'],
            'status' => 1,
            'localizacao' => '',
            'tamanho' => 'P',
        );

        if ($array['localizacao_id'] == 1) {
            $array['localizacao'] = $_POST['localizacao'];
        } else {
            $localizacao = $fachada->buscarLocalizacao($array['localizacao_id']);
            $array['localizacao'] = $localizacao->descricao;
        }

        //cadastro o pedido primeiro, se conseguir retorna 1, se não retorna 0
        $res = $fachada->cadastrarPedido($array);

        //Se cadastro feito com sucesso adicionar lista de ingredientes
        if ($res) {
            //Pegar ID do último cadastro feito no pedido
            //E passar como parametro junto com a lista dos ingredintes
            $id = $fachada->lastPedido($array['cliente_id']);
            foreach ($_SESSION['lista_ingredientes'] AS $linha) {
                $res2 = $fachada->adicionarPedidoIngrediente($id, $linha);
            }
            // limpar tudo antes de sair. obrigado
            unset($_POST);
            unset($_SESSION['lista_ingredientes']);
            header("Location: ../");
        } else if ($res == 0) {
            // Avisa aê
            echo "<script>window.alert('Erro ao cadastrar')</script>";
        }
        //Se escolher tirar o carrinho
    } else if (!empty($_POST['remover'])) {
        foreach ($_SESSION['lista_ingredientes'] as $key => $tag_name) {
            if ($tag_name == $_POST['remover']) {
                unset($_SESSION['lista_ingredientes'][$key]);
            }
        }
    } else if (!empty($_POST['limpar'])) {
        unset($_POST);
        unset($_SESSION['lista_ingredientes']);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?= $fachada->header(); ?>

    <body>

        <section id="container" >
            <?php $fachada->headerLayout(); ?>
            <?php $fachada->sideLayout(); ?>
            <section id="main-content">
                <section class="wrapper">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h2 class="mb" style="text-align: center"><i class="fa fa-user"></i> Realizar Pedido</h2>
                                <form class="form-horizontal style-form" method="POST" action="" autocomplete="off">

                                    <!-- adicionar cliente -->
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"> Cliente </label>
                                        <div class="col-sm-10">
                                            <!-- não pense que a cabeça aguenta se você parar! -->
                                            <select name="cliente_id" class="form-control">
                                                <option> seleciona uma opção </option>
                                                <?php
                                                $clientes = $fachada->listarCliente()->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($clientes as $linha) {
                                                    if ($linha->nome != '') {
                                                        ?>
                                                        <option value="<?= $linha->id; ?>"><?= $linha->nome; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- adicionar localizacao -->
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"> Localização </label>
                                        <div class="col-sm-10">
                                            <!-- não pense que a cabeça aguenta se você parar! -->
                                            <select name="localizacao_id" class="form-control">
                                                <option> seleciona uma opção </option>
                                                <?php
                                                $locais = $fachada->listarLocalizacao();
                                                foreach ($locais as $linha) {
                                                    if ($linha->descricao != '') {
                                                        ?>
                                                        <option value="<?= $linha->id; ?>"><?= $linha->descricao; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- localizacao extra -->
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"> Extra-Localização </label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="localizacao" placeholder="só preencher se a localização for 'OUTROS'"></textarea>
                                        </div>
                                    </div>

                                    <!-- adicionar ingredientes -->
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"> Ingrediente </label>
                                        <div class="col-sm-10">
                                            <select name="id_ingrediente" class="form-control">
                                                <option> seleciona uma opção </option>
                                                <?php
                                                $ingredientes = $fachada->carpadio()->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($ingredientes as $linha) {
                                                    if ($linha->descricao != '') {
                                                        ?>
                                                        <option value="<?= $linha->id; ?>"><?= $linha->descricao; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <button type="submit" class="btn btn-theme" name="adicionar" value="1"> Adicionar ao Pedido </button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label"> Ingredientes Adicionados </label>
                                        <div class="col-sm-10">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td> <strong> ID  </strong> </td>
                                                        <td> <strong> Descrição </strong> </td>
                                                        <td> <strong> Remover </strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $lista = $fachada->carpadio()->fetchAll(PDO::FETCH_OBJ);
                                                    if (!empty($_SESSION['lista_ingredientes'])) {
                                                        $ingredientes = $_SESSION['lista_ingredientes'];
                                                        foreach ($lista AS $linha) {
                                                            if (in_array($linha->id, $ingredientes)) {
                                                                ?>
                                                                <tr>
                                                                    <td><?= $linha->id; ?></td>
                                                                    <td><?= $linha->descricao; ?></td>
                                                                    <td><button type="submit" name="remover" value="<?= $linha->id; ?>" class="btn btn-theme">Remover</button>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="submit" name="enviar" class="btn btn-theme" value="1"> Cadastrar </button>
                                    <button type="clear" name="limpar" value="2" class="btn btn-theme"> Limpar </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </section>

        <?= $fachada->rodape(); ?>
    </body>
</html>
