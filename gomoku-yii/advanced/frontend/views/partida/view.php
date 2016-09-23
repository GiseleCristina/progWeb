<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Partida */

$this->title = $model->idUser1->username . " X ";
$this->title .= $model->idUser2?$model->idUser2->username:"...";
$this->params['breadcrumbs'][] = ['label' => 'Partidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Insiro os estilos CSS criados para a aplicação feita em javascript
$this->registerCssFile('css/estilos.css');

// Carrego o javascript do jogo
$this->registerJsFile('js/script.js');

if (!$vencedor) {
    $this->registerJs('
    setInterval(function() {
        recarregar = document.getElementById("recarregar");
        recarregar.click();
    }, 1000);
');
}

?>

<?php Pjax::begin(); ?>
<div class="partida-view">

    <h1><?= Html::encode($this->title) ?></h1
    <div>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                ['label'=>'<img id="jogador_1" class="jogador" src="img/1.png" width=32 /> Jogador1 ',
                    'value'=>$model->idUser1->username,
                    'format'=>'raw'],

                ['label'=>'<img id="jogador_2" class="jogador" src="img/2.png" width=32 /> Jogador2 ',
                    'value'=>$model->idUser2?$model->idUser2->username:"...",
                    'format'=>'raw'],
                'vencedor',
            ],
        ])
        ?>

        <!-- Link usado pelo Pjax, para carregar o tabuleiro a cada segundo -->
        <?= Html::a('Recarregar',['partida/view','id'=>$model->id],['id'=>'recarregar','style'=>'display:none']) ?>

        <div class="container">

            <table class='tabuleiro'>
                <?php
                for ($row=0; $row<15; $row++) {
                    echo "<tr>";
                    for ($col=0; $col<15; $col++) {

                        $url = Url::to(['partida/view', 'id'=>$model->id, 'linha'=>$row, 'coluna'=>$col]);
                        if ($vencedor != 0) {
                            if ($jogadas[$row][$col] == $model->id_user_1) {
                                echo '<td><img src="img/1.png" width=32 /></td>';
                            }
                            else if ($jogadas[$row][$col] == $model->id_user_2) {
                                echo '<td><img src="img/2.png" width=32 /></td>';
                            }
                            else {
                                echo '<td><img src="img/0.png" width=32 /></td>';
                            }
                        }
                        else if (!$jogador_da_vez == Yii::$app->user->id) {
                            echo "<td id='c_".$row."_".$col."'><a href='".$url."' onClick='Clicked(".$row.",".$col.",".Yii::$app->user->id.")'><img src='img/0.png' width=32 /></a></td>";
                        }
                        else {
                            echo "<td id='c_".$row."_".$col."'><img src='img/0.png' width=32 /></td>";
                        }

                        if ($jogadas[$row][$col]!=0) {
                            $this->registerJs("Clicked(".$row.",".$col.",".$jogadas[$row][$col].");");
                        }
                    }
                    echo "</tr>";
                }
                ?>
    
            </table>
            <span id="jog_1" data-user="<?= $model->id_user_1 ?>" style="display:none "/>
            <span id="jog_2" data-user="<?= $model->id_user_2 ?>" style="display:none"/>
            <span id="vencedor" data-user="<?= $vencedor?>" style="display:none"/>

    </div>


</div>

<?php Pjax::end(); ?>

