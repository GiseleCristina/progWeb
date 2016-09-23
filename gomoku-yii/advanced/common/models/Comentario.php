<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property integer $id
 * @property string $nome
 * @property string $sexo
 * @property string $comentarios
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'sexo', 'comentarios'], 'required'],
            [['comentarios'], 'string'],
            [['nome'], 'string', 'max' => 45],
            [['sexo'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'sexo' => 'Sexo',
            'comentarios' => 'Comentarios',
        ];
    }
}
