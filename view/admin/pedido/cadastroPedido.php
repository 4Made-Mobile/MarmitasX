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
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>Galego da Marmita</title>

        <!-- Bootstrap core CSS -->
        <link href="../../../assets/css/bootstrap.css" rel="stylesheet">
        <!--external css-->
        <link href="../../../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../../../assets/css/zabuto_calendar.css">
        <link rel="stylesheet" type="text/css" href="../../../assets/js/gritter/css/jquery.gritter.css" />
        <link rel="stylesheet" type="text/css" href="../../../assets/lineicons/style.css">

        <!-- Custom styles for this template -->
        <link href="../../../assets/css/style.css" rel="stylesheet">
        <link href="../../../assets/css/style-responsive.css" rel="stylesheet">

        <script src="../../../assets/js/chart-master/Chart.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <section id="container" >
            <!-- **********************************************************************************************************************************************************
            TOP BAR CONTENT & NOTIFICATIONS
            *********************************************************************************************************************************************************** -->
            <!--header start-->
            <?php $fachada->headerLayout(); ?>
            <!--header end-->

            <!-- **********************************************************************************************************************************************************
            MAIN SIDEBAR MENU
            *********************************************************************************************************************************************************** -->
            <!--sidebar start-->
            <?php $fachada->sideLayout(); ?>
            <!--sidebar end-->

            <!-- **********************************************************************************************************************************************************
            MAIN CONTENT
            *********************************************************************************************************************************************************** -->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- BASIC FORM ELELEMNTS -->
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
                                                        <option value="<?php echo $linha->id; ?>"><?php echo $linha->nome; ?></option>
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
                                                        <option value="<?php echo $linha->id; ?>"><?php echo $linha->descricao; ?></option>
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
                                                        <option value="<?php echo $linha->id; ?>"><?php echo $linha->descricao; ?></option>
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
                                                                    <td><?php echo $linha->id; ?></td>
                                                                    <td><?php echo $linha->descricao; ?></td>
                                                                    <td><button type="submit" name="remover" value="<?php echo $linha->id; ?>" class="btn btn-theme">Remover</button>
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
                        </div><!-- col-lg-12-->
                    </div><!-- /row -->


                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
        </section>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../../../assets/js/jquery.js"></script>
        <script src="../../../assets/js/jquery-1.8.3.min.js"></script>
        <script src="../../../assets/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../../../assets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../../../assets/js/jquery.scrollTo.min.js"></script>
        <script src="../../../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="../../../assets/js/jquery.sparkline.js"></script>


        <!--common script for all pages-->
        <script src="../../../assets/js/common-scripts.js"></script>

        <script type="text/javascript" src="../../../assets/js/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="../../../assets/js/gritter-conf.js"></script>

        <!--script for this page-->
        <script src="../../../assets/js/sparkline-chart.js"></script>
        <script src="../../../assets/js/zabuto_calendar.js"></script>

    </body>
</html>
