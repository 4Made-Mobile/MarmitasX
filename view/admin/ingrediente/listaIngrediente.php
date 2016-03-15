<?php
include_once "../../../fachada/Fachada.php";
include_once '../../../assets/php/mpdf/mpdf.php';
$fachada = new Fachada();
$fachada->verificarLogin();
if (!empty($_POST['pdf'])) {
    $fachada->pdfListarBairro();
}
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
                                    <h4><i class="fa fa-user"></i> Lista dos Tipos de Ingredientes </h4>
                                </form>
                                <section id="unseen">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Descrição </th>
                                                <th> Entrada do Ingrediente </th>
                                                <th> Saída do Ingrediente </th>
                                                <th> Tipo </th>
                                                <th class="numeric"> Detalhes </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $lista = $fachada->listarIngrediente()->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($lista AS $linha) {
                                                if ($linha->descricao != null) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $linha->id; ?></td>
                                                        <td><?= $linha->descricao; ?></td>
                                                        <td><?= $linha->data1; ?></td>
                                                        <td><?= $linha->data2; ?></td>
                                                        <td><?= $linha->tipo ?></td>
                                                        <td><a href="detalheIngrediente.php?id=<?= $linha->id; ?>"<button class="btn btn-theme"> Detalhes </button></a></td>
                                                        <td><a href="removeIngrediente.php?id=<?= $linha->id; ?>"<button class="btn btn-danger"> Remover </button></a></td>
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
