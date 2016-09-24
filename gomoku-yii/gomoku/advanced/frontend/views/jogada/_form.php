<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Jogada */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jogada-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'id_partida')->textInput() ?>

    <?= $form->field($model, 'linha')->textInput() ?>

    <?= $form->field($model, 'coluna')->textInput() ?>

    <?= $form->field($model, 'data_hota')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
