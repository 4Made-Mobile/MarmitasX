<?php
include_once "../../../fachada/Fachada.php";
include_once '../../../assets/php/mpdf/mpdf.php';
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
                            <div class="content-panel">
                                <form method="POST" action="">
                                    <h4><i class="fa fa-user"></i> Localizações </h4>
                                </form>
                                <section id="unseen">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Nome do Bairro </th>
                                                <th class="numeric"> Detalhes </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $lista = $fachada->listarLocalizacao();
                                            foreach ($lista AS $linha) {
                                                if ($linha->descricao != null) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $linha->id; ?></td>
                                                        <td><?= $linha->descricao; ?></td>
                                                        <td><a href="detalheLocalizacao.php?id=<?= $linha->id; ?>"<button class="btn btn-theme"> Detalhes </button></a></td>
                                                        <td><a href="removeLocalizacao.php?id=<?= $linha->id; ?>"<button class="btn btn-danger"> Remover </button></a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </section>
                            </div><!-- /content-panel -->
                        </div><!-- /col-lg-4 -->
                    </div><!-- /row -->

                </section><!--/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <?= $fachada->rodape(); ?>

    </body>
</html>
