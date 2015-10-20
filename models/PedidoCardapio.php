<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido_cardapio".
 *
 * @property integer $id_pedido
 * @property integer $id_cardapio
 */
class PedidoCardapio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_cardapio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pedido', 'id_cardapio'], 'required'],
            [['id_pedido', 'id_cardapio'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pedido' => 'Id Pedido',
            'id_cardapio' => 'Id Cardapio',
        ];
    }
}
