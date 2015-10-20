<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoCardapio */

$this->title = 'Update Pedido Cardapio: ' . ' ' . $model->id_pedido;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Cardapios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pedido, 'url' => ['view', 'id_pedido' => $model->id_pedido, 'id_cardapio' => $model->id_cardapio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedido-cardapio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
