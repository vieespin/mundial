<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id
 * @property int $bodega_id
 * @property int $producto_id
 * @property int|null $cantidad
 *
 * @property Bodega $bodega
 * @property Producto $producto
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bodega_id', 'producto_id'], 'required'],
            [['bodega_id', 'producto_id', 'cantidad'], 'integer'],
            [['bodega_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bodega::class, 'targetAttribute' => ['bodega_id' => 'id']],
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
            'bodega_id' => 'Bodega ID',
            'producto_id' => 'Producto ID',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * Gets query for [[Bodega]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBodega()
    {
        return $this->hasOne(Bodega::class, ['id' => 'bodega_id']);
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
