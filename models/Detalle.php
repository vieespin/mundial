<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle".
 *
 * @property int $id
 * @property int|null $valor
 * @property int $pedido_id
 * @property int $producto_id
 * @property int|null $cantidad
 *
 * @property Pedido $pedido
 * @property Producto $producto
 */
class Detalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor', 'pedido_id', 'producto_id', 'cantidad'], 'integer'],
            [['pedido_id', 'producto_id'], 'required'],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::class, 'targetAttribute' => ['pedido_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::class, 'targetAttribute' => ['producto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor' => 'Valor',
            'pedido_id' => 'Pedido ID',
            'producto_id' => 'Producto ID',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * Gets query for [[Pedido]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::class, ['id' => 'pedido_id']);
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::class, ['id' => 'producto_id']);
    }
}
