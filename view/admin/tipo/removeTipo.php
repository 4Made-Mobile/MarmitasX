<?php

include_once "../../../fachada/Fachada.php";
$fachada = new Fachada();
$fachada->verificarLogin();
if (!empty($_GET['id'])) {
    $fachada->removerBairro($_GET['id']);
    header("Location: listaBairro.php");
} else {
    header("Location : ../index/index.php");
}
?>
