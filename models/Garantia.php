<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "garantia".
 *
 * @property int $id
 * @property int $pedido_id
 * @property int $producto_id
 * @property int $repartidor_id
 * @property string|null $fecha
 *
 * @property Pedido $pedido
 * @property Producto $producto
 * @property Repartidor $repartidor
 */
class Garantia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'garantia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedido_id', 'producto_id', 'repartidor_id'], 'required'],
            [['pedido_id', 'producto_id', 'repartidor_id'], 'integer'],
            [['fecha'], 'safe'],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::class, 'targetAttribute' => ['pedido_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::class, 'targetAttribute' => ['producto_id' => 'id']],
            [['repartidor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Repartidor::class, 'targetAttribute' => ['repartidor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pedido_id' => 'Pedido ID',
            'producto_id' => 'Producto ID',
            'repartidor_id' => 'Repartidor ID',
            'fecha' => 'Fecha',
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

    /**
     * Gets query for [[Repartidor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRepartidor()
    {
        return $this->hasOne(Repartidor::class, ['id' => 'repartidor_id']);
    }
}
