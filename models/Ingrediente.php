<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingrediente".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $tipo_id
 */
class Ingrediente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingrediente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_id'], 'integer'],
            [['nome'], 'string', 'max' => 45]
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
            'tipo_id' => 'Tipo ID',
        ];
    }
}
