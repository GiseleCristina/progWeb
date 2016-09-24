<?php

namespace frontend\controllers;

use Yii;
use common\models\Partida;
use common\models\Jogada;
use common\models\PartidaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PartidaController implements the CRUD actions for Partida model.
 */
class PartidaController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Partida models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartidaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partida model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id , $linha = NULL, $coluna = NULL)
    {
        $quant_linhas_tabuleiro=15;
        $quant_colunas_tabuleiro=15;
        // Carregando o modelo de Partidas
        $model = $this->findModel($id);

        // Verificando se o usuário corrente (Yii::$app->user->id)
        // já está participando do jogo corrente. Se não estiver
        // participando, eu incluo o usuário na partida.
        if ($model->id_user_1 != Yii::$app->user->id && !$model->id_user_2) {
            $model->id_user_2 = Yii::$app->user->id;
            $model->save();
        }

        // Se a linha/coluna foi enviada via PJAX, quer dizer que o
        // usuário corrente fez uma jogada. Desta forma, eu
        // adiciono a jogada do usuário na tabela jogada.
        if ($linha != NULL && $coluna != NULL) {
            $jogada_model = new Jogada();
            $jogada_model->id_user = Yii::$app->user->id;
            $jogada_model->id_partida = $id;
            $jogada_model->linha = $linha;
            $jogada_model->coluna = $coluna;
            $jogada_model->save();
        }

        // Carrego todas as jogadas da presente partida na variável $jogadas
        $jogadas = Jogada::find()
        ->where(['id_partida'=>$id])
        ->andWhere('id_user IS NOT NULL')
        ->orderBy('id ASC')
        ->all();

        // Inicializando a variável $ultimo_jogador com $model->id_user_2.
        // O valor dessa variável poderá ser mudado depois
        $ultimo_jogador = $model->id_user_2;

        // Crio um array $jogadas_array que será enviado para a view e que conterá
        // todas as jogadas da partida atual
        $jogadas_array = [];

        // Inicializo todas as casas do vetor com zero.
        for ($row=0; $row<$quant_linhas_tabuleiro; $row++) {
            for ($col=0; $col<$quant_colunas_tabuleiro; $col++) {
                $jogadas_array[$row][$col] = 0;
            }
        }

        // Atualizo $jogadas_array com as jogadas já realizadas. Veja
        // que todas as casas do tabuleiro que ainda não foram
        // usadas por nenhum jogador ficaram com $jogadas_array[$row][$col] = 0
        foreach ($jogadas as $jogada) {
            $jogadas_array[$jogada->linha][$jogada->coluna] = $jogada->id_user;
            // O valor de $ultimo_jogador será igual ao do usuário da última jogada
            $ultimo_jogador = $jogada->id_user;
        }

        // Verifico se algum jogador já venceu a partida. Isso é feito
        // através da função verificaVencedor, que deve ser criada dentro do
        // controlador.
        $vencedor = $this->verificaVencedor($jogadas_array,$ultimo_jogador);
        if ($vencedor == "true") {
            $model->vencedor = $ultimo_jogador;
            $model->save();
        }

        // Atualizo a variável $jogador_da_vez de acordo com o valor da
        // variável $ultimo_jogador
        // Inicializando a variável $ultimo_jogador com $model->id_user_2.
        // O valor dessa variável poderá ser mudado depois


        return $this->render('view', [
            'model' => $this->findModel($id),
            'jogadas' => $jogadas_array,
            'ultimo_jogador' => $ultimo_jogador,
            'vencedor' => $vencedor
        ]);
    }

    
    /**
     * Creates a new Partida model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function verificaVencedor($jogadas_array, $ultimo_jogador){
        for ($i = 0; $i < 15; $i++){
            for ($j = 0; $j < 15; $j++){
                if(($j<4 && $ultimo_jogador == $jogadas_array[$i][$j]) && $jogadas_array[$i][$j]>0)
                    if($jogadas_array[$i][$j] == $jogadas_array[$i][$j+1]
                        &&$jogadas_array[$i][$j+1] == $jogadas_array[$i][$j+2]
                        &&$jogadas_array[$i][$j+2] == $jogadas_array[$i][$j+3]
                        &&$jogadas_array[$i][$j+3] == $jogadas_array[$i][$j+4])
                        return "true";
                if(($j>4 && $ultimo_jogador == $jogadas_array[$i][$j]) && $jogadas_array[$i][$j]>0)    
                    if($jogadas_array[$i][$j] == $jogadas_array[$i+1][$j-1]
                        &&$jogadas_array[$i+1][$j-1] == $jogadas_array[$i+2][$j-2]
                        &&$jogadas_array[$i+2][$j-2] == $jogadas_array[$i+3][$j-3]
                        &&$jogadas_array[$i+3][$j-3] == $jogadas_array[$i+4][$j-4])
                        return "true";
                  if(($i<4 && $ultimo_jogador == $jogadas_array[$i][$j]) && $jogadas_array[$i][$j]>0)    
                    if($jogadas_array[$i][$j] == $jogadas_array[$i+1][$j]
                        &&$jogadas_array[$i+1][$j] == $jogadas_array[$i+2][$j]
                        &&$jogadas_array[$i+2][$j] == $jogadas_array[$i+3][$j]
                        &&$jogadas_array[$i+3][$j] == $jogadas_array[$i+4][$j])
                        return "true";
                  if(($j<4 && $ultimo_jogador == $jogadas_array[$i][$j]) && $jogadas_array[$i][$j]>0)    
                    if($jogadas_array[$i][$j] == $jogadas_array[$i+1][$j+1]
                        &&$jogadas_array[$i+1][$j+1] == $jogadas_array[$i+2][$j+2]
                        &&$jogadas_array[$i+2][$j+2] == $jogadas_array[$i+3][$j+3]
                        &&$jogadas_array[$i+3][$j+3] == $jogadas_array[$i+4][$j+4])
                        return "true";   
            }
        }
        return "false";
    }    



    public function actionCreate()
    {
        $model = Partida::find()
            ->where(['id_user_1'=>Yii::$app->user->id])
            ->andWhere('vencedor IS NULL')
            ->one();
       
        if (!$model) {
            $model = new Partida();
            $model->id_user_1 = Yii::$app->user->id;
            $model->save();
        }
        return $this->redirect(['partida/view', 'id' => $model->id]);
    }

    /**
     * Updates an existing Partida model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Partida model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partida model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partida the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partida::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}