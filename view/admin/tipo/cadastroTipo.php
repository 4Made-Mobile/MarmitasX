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
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h2 class="mb" style="text-align: center"><i class="fa fa-user"></i> Tipo de alimentos</h2>
                                <form class="form-horizontal style-form" method="POST" action="" autocomplete="off">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Descrição do tipo de Alimento</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nome" class="form-control" placeholder="">
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

        <?= $fachada->rodape(); ?>

        <?php
        if (!empty($_POST['enviar'])) {
            $array = array(
                'id' => null,
                'descricao' => $_POST['nome'],
                'status' => 1,
            );
            $res = $fachada->adicionarTipo($array);
            if ($res == 1) {
                echo "<script>window.alert('Cadastrado com sucesso')</script>";
                echo "<script>window.location = 'listaTipo.php'</script>";
            } else if ($res == 0) {
                echo "<script>window.alert('Já cadastrado')</script>";
            }
        } else if (!empty($_POST['limpar'])) {
            unset($_POST);
        }
        ?>

    </body>
</html>
