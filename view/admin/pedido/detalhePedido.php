<?php
require_once '../../../autoload.php';
include_once '../../../assets/php/mpdf/mpdf.php';
$fachada = new Fachada();
$fachada->verificarLogin();
$pedido = $fachada->buscarPedidoId($_GET['id']);
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
                            <div class="content-panel">
                                <h2>Cliente: <?= $pedido[0]->cliente; ?></h2>
                                <h2>Telefone: <?= $pedido[0]->telefone; ?></h2>
                                <h2>Localização: <?= $pedido[0]->localizacao; ?></h2>
                                <h2>Observação: <?= $pedido[0]->obs; ?></h2>
                                <?php
                                foreach ($pedido AS $item) {
                                    echo "<h3>" . $item->tipo . ": " . $item->ingrediente . "</h3>";
                                }
                                ?>
                                <h3 style="align-items: center"><a class="btn-danger" href="listaPedido.php">voltar</a></h3>
                            </div>
                        </div>
                    </div>

                </section>
            </section>
            <?= $fachada->rodape(); ?>
    </body>
</html>
