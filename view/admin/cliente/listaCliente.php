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
                                    <h4><i class="fa fa-user"></i> Lista dos Tipos de Clientes </h4>
                                </form>
                                <section id="unseen">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Nome </th>
                                                <th> Telefone </th>
                                                <th class="numeric"> Detalhes </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $lista = $fachada->listarCliente()->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($lista AS $linha) {
                                                if ($linha->telefone != null) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $linha->id; ?></td>
                                                        <td><?= $linha->nome; ?></td>
                                                        <td><?= $linha->telefone; ?></td>
                                                        <td><a href="detalheCliente.php?id=<?= $linha->id; ?>"<button class="btn btn-theme"> Detalhes </button></a></td>
                                                        <td><a href="removerCliente.php?id=<?= $linha->id; ?>"<button class="btn btn-danger"> Remover </button></a></td>
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
        </section>

        <?= $fachada->rodape(); ?>

    </body>
</html>
