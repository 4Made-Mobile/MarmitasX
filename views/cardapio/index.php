<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cardapios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cardapio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cardapio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data_inicio',
            'data_fim',
            'status',
            'ingrediente.nome',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
