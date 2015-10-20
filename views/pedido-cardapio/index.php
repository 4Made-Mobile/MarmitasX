<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedido Cardapios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-cardapio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pedido Cardapio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_pedido',
            'id_cardapio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
