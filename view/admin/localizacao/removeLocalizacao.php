<?php

include_once "../../../autoload.php";
$fachada = new Fachada();
$fachada->verificarLogin();

// remove e pega a resposta
$res = $fachada->removerLocalizacao($_GET['id']);
if ($res) {
    echo "<script>window.alert('Removido com sucesso')</script>";
    echo "<script>window.location = 'listaLocalizacao.php'</script>";
} else {
    echo "<script>window.alert('Não foi removido com sucesso')</script>";
    echo "<script>window.location = 'cadastroTipo.php'</script>";
}
?>

