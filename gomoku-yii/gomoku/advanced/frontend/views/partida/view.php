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

if ($vencedor == "false") {
       $this->registerJs('
        setInterval(function() {
        recarregar = document.getElementById("recarregar");
        recarregar.click();
        }, 1500);
    ');
}else{
    echo"tem vencedor";
}
?>

<?php Pjax::begin(); ?>
<div class="partida-view">
    <?php
    /*
        echo "$vencedor<br>";
        for($i=0; $i<count($jogadas); $i++){
            for($j=0; $j<count($jogadas); $j++){
                echo"[ ".$jogadas[$i][$j]." ] ";
            }
            echo"<br/>";
        }*/
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                //'id',
        ['label'=>'<img id="jogador_1" class="jogador" src="img/1.png" width=32 /> Jogador1 ',
        'value'=>$model->idUser1->username,
        'format'=>'raw'],

        ['label'=>'<img id="jogador_2" class="jogador" src="img/2.png" width=32 /> Jogador2 ',
        'value'=>$model->idUser2?$model->idUser2->username:"Aguardando...",
        'format'=>'raw'],

        ['attribute'=>'vencedor',
        'value'=>$model->vencedor0?$model->vencedor0->username:"Vencedor não definido!"],
        ],
        ])
        ?>
        <!-- Link usado pelo Pjax, para carregar o tabuleiro a cada segundo -->
        <?= Html::a('Recarregar',['partida/view','id'=>$model->id],['id'=>'recarregar','style'=>'display:none']) ?>

        <div class="container">



            <table class='tabuleiro'>
                <?php

                if($ultimo_jogador == $model->id_user_1){
                    $imagem = "img/2.png";
                } else if ($ultimo_jogador == $model->id_user_2){
                    $imagem = "img/1.png";
                }
                 
                for ($row=0; $row<15; $row++) {
                    echo "<tr>";
                    for ($col=0; $col<15; $col++) {

                        $url = Url::to(['partida/view', 'id'=>$model->id, 'linha'=>$row, 'coluna'=>$col]);
                        if (empty($model->vencedor)){ 
                            if  ($ultimo_jogador != Yii::$app->user->id){
                                if($jogadas[$row][$col] != 0){
                                    if ($jogadas[$row][$col] == $model->id_user_1) {
                                        echo '<td><img src="img/1.png" width=32 /></td>';
                                    }
                                    else if ($jogadas[$row][$col] == $model->id_user_2) {
                                        echo '<td><img src="img/2.png" width=32 /></td>';
                                    }
                                } else {
                                    echo "<td>
                                        <a href= \"".$url."\" onclick = 'insereImagem(\"".$row.$col."\" , \"".$imagem."\")'>
                                        <img id = \"".$row.$col."\" src='img/0.png' width = 32 />
                                    </td>";
                                }
                            }else{
                                if($jogadas[$row][$col] != 0){
                                    if ($jogadas[$row][$col] == $model->id_user_1) {
                                        echo '<td><img src="img/1.png" width=32 /></td>';
                                    }
                                    else if ($jogadas[$row][$col] == $model->id_user_2) {
                                        echo '<td><img src="img/2.png" width=32 /></td>';
                                    }
                                } else {
                                    echo "<td>
                                    <img id = \"".$row.$col."\" src='img/0.png' width = 32 />
                                </td>";
                                }
                            }
                        }else{
                            if ($ultimo_jogador != Yii::$app->user->id){
                                if($jogadas[$row][$col] != 0){
                                    if ($jogadas[$row][$col] == $model->id_user_1) {
                                        echo '<td><img src="img/1.png" width=32 /></td>';
                                    }
                                    else if ($jogadas[$row][$col] == $model->id_user_2) {
                                        echo '<td><img src="img/2.png" width=32 /></td>';
                                    }
                                } else {
                                    echo "<td>
                                        <img id = \"".$row.$col."\" src='img/0.png' width = 32 />
                                    </td>";
                                }
                            }else{
                                if($jogadas[$row][$col] != 0){
                                    if ($jogadas[$row][$col] == $model->id_user_1) {
                                        echo '<td><img src="img/1.png" width=32 /></td>';
                                    }
                                    else if ($jogadas[$row][$col] == $model->id_user_2) {
                                        echo '<td><img src="img/2.png" width=32 /></td>';
                                    }
                                } else {
                                    echo "<td>
                                    <img id = \"".$row.$col."\" src='img/0.png' width = 32 />
                                </td>";
                            }
                        }
                    }      
                }
                echo "</tr>";
            }


            ?>
        </table>
    </div>
</div>
<?php Pjax::end(); ?>

