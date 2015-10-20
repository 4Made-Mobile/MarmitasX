<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cardapio */

$this->title = 'Update Cardapio: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cardapios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cardapio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
