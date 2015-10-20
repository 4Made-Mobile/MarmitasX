<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cardapio".
 *
 * @property integer $id
 * @property string $data_inicio
 * @property string $data_fim
 * @property integer $status
 * @property integer $ingrediente_id
 *
 * @property Ingrediente $ingrediente
 * @property PedidoCardapio[] $pedidoCardapios
 * @property Pedido[] $idPedidos
 */
class Cardapio extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cardapio';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['data_inicio', 'data_fim'], 'safe'],
            [['status', 'ingrediente_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'data_inicio' => 'Data de Início',
            'data_fim' => 'Data de encerramento',
            'status' => 'Status',
            'ingrediente_id' => 'Ingrediente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngrediente() {
        return $this->hasOne(Ingrediente::className(), ['id' => 'ingrediente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoCardapios() {
        return $this->hasMany(PedidoCardapio::className(), ['id_cardapio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPedidos() {
        return $this->hasMany(Pedido::className(), ['id' => 'id_pedido'])->viaTable('pedido_cardapio', ['id_cardapio' => 'id']);
    }

}
