<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ingrediente;

/* @var $this yii\web\View */
/* @var $model app\models\Cardapio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cardapio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_inicio')->textInput(array('placeholder' => 'Ex: 07-10-2015')) ?>

    <?= $form->field($model, 'data_fim')->textInput(array('placeholder' => 'Ex: 07-10-2015')) ?>

    <?= $form->field($model, 'ingrediente_id')->dropDownList(ArrayHelper::map(Ingrediente::find()->all(), 'id', 'nome')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
