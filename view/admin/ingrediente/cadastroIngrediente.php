<?php
include_once "../../../autoload.php";
$fachada = new Fachada();
$fachada->verificarLogin();
?>
<html lang="pt-br">

    <body>
        <section id="container" >
            <?= $fachada->headerLayout(); ?>
            <?= $fachada->sideLayout(); ?>

            <section id="main-content">
                <section class="wrapper">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h2 class="mb" style="text-align: center"><i class="fa fa-user"></i> Ingrediente </h2>
                                <form class="form-horizontal style-form" method="POST" action="" autocomplete="off">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Descrição do ingrediente de Alimento</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="descricao" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Data entrada do ingrediente</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="data1" class="form-control" placeholder="AAAA-MM-DD">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Data saída do ingrediente</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="data2" class="form-control" placeholder="AAAA-MM-DD">
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
                'descricao' => $_POST['descricao'],
                'data1' => $_POST['data1'],
                'data2' => $_POST['data2'],
                'tipo_id' => $_POST['id_tipo'],
                'status' => 1,
            );
            $res = $fachada->adicionarIngrediente($array);
            if ($res == 1) {
                echo "<script>window.alert('Cadastrado com sucesso')</script>";
                echo "<script>window.location = 'listaIngrediente.php'</script>";
            } else if ($res == 0) {
                echo "<script>window.alert('Já cadastrado')</script>";
            }
        } else if (!empty($_POST['limpar'])) {
            unset($_POST);
        }
        ?>

        <?= $fachada->header(); ?>

    </body>
</html>
