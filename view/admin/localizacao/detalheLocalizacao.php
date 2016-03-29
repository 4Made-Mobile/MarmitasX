<?php
include_once "../../../autoload.php";
$fachada = new Fachada();
$fachada->verificarLogin();
if (!empty($_GET)) {
    $busca = $fachada->buscarLocalizacaoID($_GET['id'])->fetch(PDO::FETCH_OBJ);
} else {
    header("Location: ../index/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?= $fachada->header(); ?>
    <body>

        <section id = "container" >
            <?= $fachada->headerLayout(); ?>
            <?= $fachada->sideLayout(); ?>

            <section id="main-content">
                <section class="wrapper">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <form class="form-horizontal style-form" method="POST" action="" autocomplete="off">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Localização</label>
                                        <div class="col-sm-10">
                                            <input value="<?= $busca->descricao; ?>"type="text" name="nome" class="form-control" >
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
       
        <?= $fachada->rodape(); ?>


    </body>
</html>
