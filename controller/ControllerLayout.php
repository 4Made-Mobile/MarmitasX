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

                    <p class="centered"><a href="../index/index.php"><img src="../../../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                    <h5 class="centered">Usuário</h5>

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

}

;
