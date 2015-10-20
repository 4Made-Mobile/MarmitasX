<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PedidoCardapio */

$this->title = 'Create Pedido Cardapio';
$this->params['breadcrumbs'][] = ['label' => 'Pedido Cardapios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-cardapio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
