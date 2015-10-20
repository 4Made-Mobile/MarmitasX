<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoCardapio */

$this->title = $model->id_pedido;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Cardapios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-cardapio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_pedido' => $model->id_pedido, 'id_cardapio' => $model->id_cardapio], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_pedido' => $model->id_pedido, 'id_cardapio' => $model->id_cardapio], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pedido',
            'id_cardapio',
        ],
    ]) ?>

</div>
