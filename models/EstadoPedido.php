<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_pedido".
 *
 * @property int $id
 * @property string|null $nombre
 *
 * @property Pedido[] $pedidos
 */
class EstadoPedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::class, ['estado_pedido_id' => 'id']);
    }
}
