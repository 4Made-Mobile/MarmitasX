<?php
require_once '../../../autoload.php';
$fachada = new Fachada();
$fachada->verificarLogin();
if (!empty($_GET)) {
    $busca = $fachada->buscarIngredienteID($_GET['id'])->fetch(PDO::FETCH_OBJ);
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
                                <h2 class="mb" style="text-align: center"><i class="fa fa-user"></i> Cadastro Ingrediente </h2>
                                <form class="form-horizontal style-form" method="POST" action="" autocomplete="off">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Descrição do ingrediente de Alimento</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="<?= $busca->descricao; ?> " name="descricao" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Data entrada do ingrediente</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="<?= $busca->data1; ?>" name="data1" class="form-control" placeholder="AAAA-MM-DD">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Data saída do ingrediente</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="<?= $busca->data2; ?> " name="data2" class="form-control" placeholder="AAAA-MM-DD">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Bairro</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_tipo">
                                                <?php
                                                $lista = $fachada->listarTipo()->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($lista as $linha) {
                                                    if ($linha->descricao != "") {
                                                        ?>

                                                        <option value="<?= $linha->id; ?>">
                                                            <?= $linha->descricao; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-theme"> Cadastrar </button>
                                    <a class="btn btn-theme" href="listaIngrediente.php">Sair</a>
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
                ':id' => $busca->id,
                ':descricao' => $_POST['descricao'],
                ':data1' => $_POST['data1'],
                ':data2' => $_POST['data2'],
                ':tipo_id' => $_POST['id_tipo'],
            );

            $res = $fachada->alterarIngrediente($array);
            if ($res == 1) {
                echo "<script>window.alert('Cadastrado com sucesso')</script>";
                echo "<script> window.location('listaIngrediente.php'); </script>";
            }
        }
        ?>

        <?= $fachada->rodape(); ?>

    </body>
</html>
