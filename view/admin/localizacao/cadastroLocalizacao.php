<?php
include_once "../../../fachada/Fachada.php";
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
                        </div>
                    </div>
                </section>
            </section>
        </section>
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
                echo "<script>window.location = 'listaLocalizacao.php'</script>";
            } else if ($res == 0) {
                echo "<script>window.alert('Já cadastrado')</script>";
            } else if ($res == 2) {
                echo "<script>window.alert('Erro interno')</script>";
            } else if ($res == 3) {
                echo "<script>window.alert('Erro no banco de dados')</script>";
            }
        } else if (!empty($_POST['limpar'])) {
            unset($_POST);
        }
        ?>
        <?= $fachada->rodape(); ?>
    </body>
</html>
