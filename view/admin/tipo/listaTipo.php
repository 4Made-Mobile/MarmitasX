<?php
include_once "../../../fachada/Fachada.php";
include_once '../../../assets/php/mpdf/mpdf.php';
$fachada = new Fachada();
$fachada->verificarLogin();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?php $fachada->header(); ?>
    <body>

        <section id="container" >
            <?php $fachada->headerLayout(); ?>
            <?php $fachada->sideLayout(); ?>
            <section id="main-content">
                <section class="wrapper">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="content-panel">
                                <form method="POST" action="">
                                    <h4><i class="fa fa-user"></i> Lista dos Tipos de Ingredientes </h4>
                                </form>
                                <section id="unseen">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Descrição </th>
                                                <th class="numeric"> Detalhes </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $lista = $fachada->listarTipo()->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($lista AS $linha) {
                                                if ($linha->descricao != null) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $linha->id; ?></td>
                                                        <td><?= $linha->descricao; ?></td>
                                                        <td><a href="detalheTipo.php?id=<?= $linha->id; ?>"<button class="btn btn-theme"> Detalhes </button></a></td>
                                                        <td><a href="removeTipo.php?id=<?= $linha->id; ?>"<button class="btn btn-danger"> Remover </button></a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
            </section>

            <?= $fachada->rodape(); ?>

    </body>
</html>
