<?php
require_once '../../../autoload.php';
$fachada = new Fachada();
$fachada->verificarLogin();
if (!empty($_GET)) {
    $busca = $fachada->buscarTipoID($_GET['id'])->fetch(PDO::FETCH_OBJ);
} else {
    header("Location: ../index/index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?= $fachada->header(); ?>

    <body>

        <section id="container" >
            <?php $fachada->headerLayout(); ?>
            <?php $fachada->sideLayout(); ?>
            <section id="main-content">
                <section class="wrapper">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h2 class="mb" style="text-align: center"><i class="fa fa-user"></i> Cadastro Tipo de Ingrediente</h2>
                                <form class="form-horizontal style-form" method="POST" action="" autocomplete="off">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Tipo de Ingrediente</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo $busca->descricao; ?>"type="text" name="nome" class="form-control" >
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-theme"> Cadastrar </button>
                                    <a class="btn btn-theme" href="listaTipo.php">Sair</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </section>

        <?= $fachada->rodape(); ?>

        <?php
        if (!empty($_POST)) {
            $array = array(
                'id' => $busca->id,
                'descricao' => $_POST['nome'],
            );

            $res = $fachada->alterarTipo($array);
            if ($res == 1) {
                echo "<script>window.alert('Cadastrado com sucesso')</script>";
                echo "<script> window.location('listaTipo.php'); </script>";
            }
        }
        ?>

    </body>
</html>
