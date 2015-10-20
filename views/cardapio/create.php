<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cardapio */

$this->title = 'Create Cardapio';
$this->params['breadcrumbs'][] = ['label' => 'Cardapios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cardapio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
