<?php
include_once "../../../fachada/Fachada.php";
include_once '../../../assets/php/mpdf/mpdf.php';

$fachada = new Fachada();
$fachada->verificarLogin();
$ingrediente = $fachada->listarIngrediente()->fetchAll(PDO::FETCH_OBJ);
$lista = $fachada->listarPedido($_GET['carne'], $_GET['localizacao']);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>Marmita</title>

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
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="content-panel">

                                <!-- Filtrar -->
                                <form method="GET" action="">
                                    <h4><i class="fa fa-user"></i> Lista dos Tipos de Pedidos </h4>

                                    <!-- Selecionar tipo de carne -->
                                    <select name="ingrediente">
                                        <option selected="<?php echo $_GET['ingrediente'] == "todas"; ?>" value="todas">Todas</option>
                                        <?php
                                        foreach ($ingrediente as $item) {

                                            if ($item->tipo_id == 3) {
                                                ?>
                                                <option
                                                    value="<?php echo $item->id; ?>"><?php echo $item->descricao; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        <option selected="<?php echo $_GET['ingrediente'] == "nenhuma"; ?>" value="nenhuma">Nenhuma </option>
                                    </select>

                                    <!-- botão com o filtrar -->
                                    <button type="submit">filtrar</button>
                                </form>


                                <?php
                                // Emitindo E-Mail.
                                if (!empty($_GET['ingrediente'])) {
                                    ?>
                                    <a target="_blank" href="imprimirPdf.php?ingrediente=<?php echo $_GET['ingrediente']; ?>"<button class="btn btn-theme"> Imprimir </button></a>
                                <?php } else { ?>
                                    <a target="_blank" href="imprimirPdf.php" <button class="btn btn-theme"> Imprimir </button></a>
                                <?php } ?>
                                <section id="unseen">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Cliente </th>
                                                <th> carne </th>
                                                <th> Localização </th>
                                                <th> Observação </th>
                                                <th> Impressão </th>
                                                <th class="numeric"> Detalhes </th>
                                                <th class="danger"> Imprimir </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($lista AS $linha) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $linha->id; ?></td>
                                                    <td><?php echo $linha->cliente; ?></td>
                                                    <td><?php echo $linha->carne; ?></td>
                                                    <td><?php echo $linha->localizacao; ?></td>
                                                    <td><?php echo $linha->obs; ?></td>
                                                    <td><?php echo ($linha->status == 2 ? "sim" : "não") ?></td>
                                                    <td><a href="detalhePedido.php?id=<?php echo $linha->id; ?>"<button class="btn btn-theme"> Detalhes </button></a></td>
                                                    <td><a href="removePedido.php?id=<?php echo $linha->id; ?>"<button class="btn btn-danger"> Remover </button></a></td>
                                                    <td><a target="_blank" href="imprimirPdf.php?pedido=<?php echo $linha->id; ?>"<button class="btn btn-theme"> Imprimir </button></a></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </section>
                            </div><!-- /content-panel -->
                        </div><!-- /col-lg-4 -->
                    </div><!-- /row -->

                </section><!--/wrapper -->
            </section><!-- /MAIN CONTENT -->
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

            <script type="application/javascript">
                $(document).ready(function () {
                $("#date-popover").popover({html: true, trigger: "manual"});
                $("#date-popover").hide();
                $("#date-popover").click(function (e) {
                $(this).hide();
                });

                $("#my-calendar").zabuto_calendar({
                action: function () {
                return myDateFunction(this.id, false);
                },
                action_nav: function () {
                return myNavFunction(this.id);
                },
                ajax: {
                url: "show_data.php?action=1",
                modal: true
                },
                legend: [
                {type: "text", label: "Special event", badge: "00"},
                {type: "block", label: "Regular event", }
                ]
                });
                });


                function myNavFunction(id) {
                $("#date-popover").hide();
                var nav = $("#" + id).data("navigation");
                var to = $("#" + id).data("to");
                console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
                }
            </script>


    </body>
</html>
