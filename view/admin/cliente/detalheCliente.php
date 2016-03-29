<?php
require_once '../../../autoload.php';
$fachada = new Fachada();
$fachada->verificarLogin();
if (!empty($_GET)) {
    $busca = $fachada->buscarClienteID($_GET['id'])->fetch(PDO::FETCH_OBJ);
} else {
    header("Location: ../index/index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

    <?= $fachada->header(); ?>

    <body>

        <section id="container" >
            <?= $fachada->headerLayout(); ?>
            <?php $fachada->sideLayout(); ?>
            <section id="main-content">
                <section class="wrapper">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h2 class="mb" style="text-align: center"><i class="fa fa-user"></i> Alterar Cliente</h2>
                                <form class="form-horizontal style-form" method="POST" action="" autocomplete="off">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="<?= $busca->nome ?>" name="nome" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Telefone</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="<?php $busca->telefone ?>" name="telefone" class="form-control" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Senha</label>
                                        <div class="col-sm-10">
                                            <input type="password" value="<?php $busca->senha ?>" name="senha" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-theme"> Cadastrar </button>
                                    <a class="btn btn-theme" href="listaCliente.php">Sair</a>
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
        if (!empty($_POST)) {
            $array = array(
                ':id' => $busca->id,
                ':nome' => $_POST['nome'],
                ':telefone' => $_POST['telefone'],
                ':senha' => $_POST['senha'],
            );

            $res = $fachada->alterarCliente($array);
            if ($res == 1) {
                echo "<script>window.alert('Cadastrado com sucesso')</script>";
                echo "<script> window.location('listaCliente.php'); </script>";
            }
        }
        ?>

        <?= $fachada->rodape(); ?>

    </body>
</html>
