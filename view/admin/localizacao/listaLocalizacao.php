<?php
include_once "../../../fachada/Fachada.php";
include_once '../../../assets/php/mpdf/mpdf.php';
$fachada = new Fachada();
$fachada->verificarLogin();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title> Marmita </title>

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
                                <form method="POST" action="">
                                    <h4><i class="fa fa-user"></i> Localizações </h4>
                                </form>
                                <section id="unseen">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Nome do Bairro </th>
                                                <th class="numeric"> Detalhes </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $lista = $fachada->listarLocalizacao();
                                            foreach ($lista AS $linha) {
                                                if ($linha->descricao != null) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $linha->id; ?></td>
                                                        <td><?php echo $linha->descricao; ?></td>
                                                        <td><a href="detalheLocalizacao.php?id=<?php echo $linha->id; ?>"<button class="btn btn-theme"> Detalhes </button></a></td>
                                                        <td><a href="removeLocalizacao.php?id=<?php echo $linha->id; ?>"<button class="btn btn-danger"> Remover </button></a></td>
                                                    </tr>
                                                    <?php
                                                }
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

    </body>
</html>
