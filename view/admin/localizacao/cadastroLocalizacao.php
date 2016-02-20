<?php
include_once "../../../fachada/Fachada.php";
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
                                <h2 class="mb" style="text-align: center"><i class="fa fa-user"></i> Localização </h2>
                                <form class="form-horizontal style-form" method="POST" action="" autocomplete="off">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Descrição do local</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="descricao" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <button type="submit" name="enviar" value="1" class="btn btn-theme">Cadastrar</button>
                                    <button type="clear" name="limpar" value="2" class="btn btn-theme">Limpar</button>
                                </form>
                            </div>
                        </div><!-- col-lg-12-->
                    </div><!-- /row -->


                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
        </section>
        <!-- cadastro de usuário -->
        <?php
        if (!empty($_POST['enviar'])) {
            // monta um array para cadastrar os dados
            $array = array(
                'id' => null,
                'descricao' => $_POST['descricao'],
            );

            $res = $fachada->cadastrarLocalizacao($array);
            if ($res == 1) {
                echo "<script>window.alert('Cadastrado com sucesso')</script>";
            } else if ($res == 0) {
                echo "<script>window.alert('Já cadastrado')</script>";
            }else if($res == 2){
            	echo "<script>window.alert('Erro interno')</script>";
            }else if($res == 3){
            	echo "<script>window.alert('Erro no banco de dados')</script>";
            }
        } else if (!empty($_POST['limpar'])) {
            unset($_POST);
        }
        ?>
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
