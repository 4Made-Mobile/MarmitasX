<?php

class ControllerLayout {

    public function importacao() {
        
    }

    public function sideLayout() {
        ?>
        <aside>
            <div id="sidebar"  class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">

                    <li class="mt">
                        <a class="active" href="../index/index.php">
                            <i class="fa fa-dashboard"></i>
                            <span>Painel de Controle</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;" >
                            <i class="fa fa-desktop"></i>
                            <span><strong> Pedido </strong></span>
                        </a>
                        <ul class="sub">
                            <li><a  href="../pedido/listaPedido.php"> lista </a></li>
                            <li><a  href="../pedido/cadastroPedido.php"> cadastro </a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;" >
                            <i class="fa fa-cogs"></i>
                            <span><strong> Cliente </strong></span>
                        </a>
                        <ul class="sub">
                            <li><a  href="../cliente/cadastroCliente.php"> cadastro </a></li>
                            <li><a  href="../cliente/listaCliente.php"> lista Geral</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;" >
                            <i class="fa fa-book"></i>
                            <span> <strong> Ingrediente </strong></span>
                        </a>
                        <ul class="sub">
                            <li><a  href="../ingrediente/cadastroIngrediente.php"> cadastro </a></li>
                            <li><a  href="../ingrediente/listaIngrediente.php"> lista </a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;" >
                            <i class="fa fa-book"></i>
                            <span> <strong> Tipo </strong></span>
                        </a>
                        <ul class="sub">
                            <li><a  href="../tipo/cadastroTipo.php"> cadastro </a></li>
                            <li><a  href="../tipo/listaTipo.php"> lista </a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;" >
                            <i class="fa fa-book"></i>
                            <span> <strong> Localização </strong></span>
                        </a>
                        <ul class="sub">
                            <li><a  href="../localizacao/cadastroLocalizacao.php"> cadastro </a></li>
                            <li><a  href="../localizacao/listaLocalizacao.php"> lista </a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;" >
                            <i class="fa fa-book"></i>
                            <span> <strong> Preco </strong></span>
                        </a>
                        <ul class="sub">
                            <li><a  href="../preco/listaPreco.php"> lista </a></li>
                        </ul>
                    </li>

                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <?php
    }

    public function headerLayout() {
        ?>
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Menu"></div>
            </div>
            <!--logo start-->
            <a href="../index/index.php" class="logo"><b>Galego da Marmita</b></a>
            <!--logo end-->
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <?php if (empty($_SESSION['login'])) { ?>
                        <li><form method="POST" class="form-inline" role="form">
                                <br/>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2"> Login </label>
                                    <input type="login" name="login" class="form-control" id="exampleInputEmail2" placeholder="login">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword2"> Senha </label>
                                    <input type="password" name="senha" class="form-control" id="exampleInputPassword2" placeholder="Senha">
                                </div>
                                <button type="submit" class="btn btn-theme">Enviar</button>
                            </form></li>
                    <?php } else { ?>
                        <li>
                            <button class="btn btn-small"> SAIR </button>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </header><?php
    }

    public function header() {
        ?>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="Dashboard">
            <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

            <title>Galego da Marmita</title>

            <link href="../../../assets/css/bootstrap.css" rel="stylesheet">

            <link href="../../../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
            <link rel="stylesheet" type="text/css" href="../../../assets/css/zabuto_calendar.css">
            <link rel="stylesheet" type="text/css" href="../../../assets/js/gritter/css/jquery.gritter.css" />
            <link rel="stylesheet" type="text/css" href="../../../assets/lineicons/style.css">

            <link href="../../../assets/css/style.css" rel="stylesheet">
            <link href="../../../assets/css/style-responsive.css" rel="stylesheet">

            <script src="../../../assets/js/chart-master/Chart.js"></script>
        </head>
        <?php
    }

    public function rodape() {
        ?>
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
    <?php
    }

}