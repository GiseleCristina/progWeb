<?php
use yii\helpers\Html;
use common\models\Partida;
use common\models\Jogada;
use common\models\PartidaSearch;
/* @var $this yii\web\View */

$this->title = 'Gomoku Game!';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Gomoku Game!</h1>

        <?= Html::a(Html::img('img/gomoku.png',  ['style'=>'width:100px']), ['site/index'])?>
        <p class="lead">Jogo clássico para dois jogadores, onde um após o outro marca cruzes e
            quadrados num quadro com treze casas horizontais e treze verticais.</p>

        <?php if(!Yii::$app->user->isGuest): ?>
        <p><?= Html::a('Iniciar Nova Partida',['partida/create'],['class'=>'btn btn-lg btn-success'])?></p>

            <h3>Jogadores aguardando desafiantes</h3>

            <?php
            $partidas = Partida::find()
                ->where('id_user_1 IS NOT NULL')
                ->andWhere('id_user_1 != ' . Yii::$app->user->id)
                ->andWhere('id_user_2 IS NULL')
                ->all();

            foreach ($partidas as $partida) {
                echo Html::a($partida->id_user_1,['partida/view','id'=>$partida->id],['class'=>'btn btn-lg btn-success']);
            }
            ?>

        <?php endif; ?>
    </div>

</div>
