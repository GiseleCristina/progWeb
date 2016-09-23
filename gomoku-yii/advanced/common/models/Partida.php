<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partida".
 *
 * @property integer $id
 * @property integer $id_user_1
 * @property integer $id_user_2
 * @property integer $vencedor
 *
 * @property Jogada[] $jogadas
 * @property User $idUser1
 * @property User $idUser2
 * @property User $vencedor0
 */
class Partida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user_1', 'id_user_2', 'vencedor'], 'integer'],
            [['id_user_1'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user_1' => 'id']],
            [['id_user_2'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user_2' => 'id']],
            [['vencedor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['vencedor' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user_1' => 'Id User 1',
            'id_user_2' => 'Id User 2',
            'vencedor' => 'Vencedor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJogadas()
    {
        return $this->hasMany(Jogada::className(), ['id_partida' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser1()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser2()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVencedor0()
    {
        return $this->hasOne(User::className(), ['id' => 'vencedor']);
    }
}
