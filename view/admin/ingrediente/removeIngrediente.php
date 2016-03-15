<?php

require_once '../../../fachada/Fachada.php';
$fachada = new Fachada();
$fachada->verificarLogin();

// remove e pega a resposta
$res = $fachada->removerIngrediente($_GET['id']);
if ($res) {
    echo "<script>window.alert('Removido com sucesso')</script>";
    echo "<script>window.location = 'listaIngrediente.php'</script>";
} else {
    echo "<script>window.alert('Não foi removido com sucesso')</script>";
    echo "<script>window.location = 'cadastroTipo.php'</script>";
}

