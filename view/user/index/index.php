<?php
require_once '../../../autoload.php';
$fachada = new Fachada();
if (!empty($_POST)) {
    if ($_POST['login'] == "carlos.menezes" && $_POST['senha'] == '12345@qwe') {
        session_start();
        $_SESSION['login'] = 1;
        header("Location: ../../../view/admin/");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?php $fachada->header(); ?>
    <body>
        <section id="container" >
            <?php $fachada->headerLayout(); ?>
            <section id="main-content">
                <section class="wrapper">
                </section>
            </section>
        </section>
        <?= $fachada->rodape(); ?>
    </body>
</html>
