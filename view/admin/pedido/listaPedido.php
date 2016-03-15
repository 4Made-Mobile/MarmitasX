<?php
include_once "../../../fachada/Fachada.php";
include_once '../../../assets/php/mpdf/mpdf.php';

$fachada = new Fachada();
$fachada->verificarLogin();
$localizacao = $fachada->listarLocalizacao();
$carnes = $fachada->listarIngredienteCarnes();
$lista = $fachada->listarPedido($_GET['carne'], $_GET['localizacao']);
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

                                <!-- Filtrar -->
                                <form method="GET" action="">
                                    <h4><i class="fa fa-user"></i> Lista dos Tipos de Pedidos </h4>

                                    <!-- Selecionar tipo de carne -->
                                    <select name="carne">
                                        <option selected="<?= $_GET['ingrediente'] == "todas"; ?>" value="">Todas</option>
                                        <?php
                                        foreach ($carnes as $item) {
                                            ?>
                                            <option
                                                value="<?= $item->id; ?>"><?= $item->descricao; ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>

                                    <select name="localizacao">
                                        <option selected="<?= $_GET['localizacao'] == "todas"; ?>" value="">Todas</option>
                                        <?php
                                        foreach ($localizacao as $item) {
                                            ?>
                                            <option
                                                value="<?php echo $item->id; ?>"><?= $item->descricao; ?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>

                                    <!-- botão com o filtrar -->
                                    <button type="submit" class="btn btn-default">filtrar</button>
                                </form>
                                <br>
                                <form method="POST" action="imprimirSelecionados.php">
                                    <?php
                                    // Encaminha para impressão
                                    if (!empty($_GET['ingrediente'])) {
                                        ?>
                                        <a target="_blank" href="imprimirPdf.php?ingrediente=<?= $_GET['ingrediente']; ?>"<button class="btn btn-theme"> Imprimir </button></a>
                                    <?php } else { ?>
                                        <a target="_blank" href="imprimirPdf.php" <button class="btn btn-theme"> Imprimir </button></a>
                                    <?php } ?>
                                    <button target="_blank" type="submit" class="btn btn-default">Imprimir Selecionados </button>
                                    <section id="unseen">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th> ID </th>
                                                    <th> Cliente </th>
                                                    <th> carne </th>
                                                    <th> Localização </th>
                                                    <th> Tamanho </th>
                                                    <th> Observação </th>
                                                    <th> foi impresso? </th>
                                                    <th class="numeric"> Detalhes </th>
                                                    <th> Remover </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($lista AS $linha) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $linha->id; ?></td>
                                                        <td><?= $linha->cliente; ?></td>
                                                        <td><?= $linha->carne; ?></td>
                                                        <td><?= $linha->localizacao; ?></td>
                                                        <td><?= $linha->tamanho; ?></td>
                                                        <td><?= $linha->obs; ?></td>
                                                        <td><?= ($linha->status == 2 ? "sim" : "não") ?></td>
                                                        <td><a href="detalhePedido.php?id=<?= $linha->id; ?>"<button class="btn btn-theme"> Detalhes </button></a></td>
                                                        <td><a href="removePedido.php?id=<?= $linha->id; ?>"<button class="btn btn-danger"> Remover </button></a></td>
                                                        <td><input type="checkbox" name="<?= $linha->id; ?>" value="<?= $linha->id; ?>"/></td>

                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </section>

            <?= $fachada->rodape(); ?>
    </body>
</html>
