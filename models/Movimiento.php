<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movimiento".
 *
 * @property int $id
 * @property int $producto_id
 * @property string|null $tipo
 * @property string|null $fecha
 * @property int|null $cantidad
 * @property int $bodega_id
 *
 * @property Bodega $bodega
 * @property Producto $producto
 */
class Movimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['producto_id', 'bodega_id'], 'required'],
            [['producto_id', 'cantidad', 'bodega_id'], 'integer'],
            [['fecha'], 'safe'],
            [['tipo'], 'string', 'max' => 45],
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
            'producto_id' => 'Producto ID',
            'tipo' => 'Tipo',
            'fecha' => 'Fecha',
            'cantidad' => 'Cantidad',
            'bodega_id' => 'Bodega ID',
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
