<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Partida */

$this->title = 'Create Partida';
$this->params['breadcrumbs'][] = ['label' => 'Partidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partida-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
