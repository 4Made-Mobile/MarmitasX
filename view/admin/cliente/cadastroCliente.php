<?php
require_once '../../../autoload.php';
$fachada = new Fachada();
$fachada->verificarLogin();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?= $fachada->header(); ?>
    <body>

        <section id="container" >
            <?= $fachada->headerLayout(); ?>            
            <?= $fachada->sideLayout(); ?>

            <section id="main-content">
                <section class="wrapper">
                    <!-- BASIC FORM ELELEMNTS -->
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h2 class="mb" style="text-align: center"><i class="fa fa-user"></i> Cliente </h2>
                                <form class="form-horizontal style-form" method="POST" action="" autocomplete="off">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Nome</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nome" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Telefone</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="telefone" class="form-control" placeholder="não utilizar espaços ou simbolos (- /)">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Senha</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="senha" class="form-control" placeholder="">
                                        </div>
                                    </div>

                                    <button type="submit" name="enviar" value="1" class="btn btn-theme">Cadastrar</button>
                                    <button type="clear" name="limpar" value="2" class="btn btn-theme">Limpar</button>
                                </form>
                            </div>
                        </div>
                    </div>


                </section>
            </section>            
        </section>

        <?php
        if (!empty($_POST['enviar'])) {
            $array = array(
                'id' => null,
                'nome' => $_POST['nome'],
                'telefone' => $_POST['telefone'],
                'senha' => $_POST['senha'],
                'status' => 1,
            );
            $res = $fachada->adicionarCliente($array);
            if ($res == 1) {
                echo "<script>window.alert('Cadastrado com sucesso')</script>";
                echo "<script>window.location = 'listaCliente.php'</script>";
            } else if ($res == 0) {
                echo "<script>window.alert('Já cadastrado')</script>";
            }
        } else if (!empty($_POST['limpar'])) {
            unset($_POST);
        }
        ?>

        <?= $fachada->rodape(); ?>

    </body>
</html>
