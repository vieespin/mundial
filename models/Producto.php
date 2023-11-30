<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id
 * @property string|null $nombre
 * @property int|null $valor
 *
 * @property Detalle[] $detalles
 * @property Garantia[] $garantias
 * @property Movimiento[] $movimientos
 * @property Stock[] $stocks
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
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
            'valor' => 'Valor',
        ];
    }

    /**
     * Gets query for [[Detalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalles()
    {
        return $this->hasMany(Detalle::class, ['producto_id' => 'id']);
    }

    /**
     * Gets query for [[Garantias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGarantias()
    {
        return $this->hasMany(Garantia::class, ['producto_id' => 'id']);
    }

    /**
     * Gets query for [[Movimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientos()
    {
        return $this->hasMany(Movimiento::class, ['producto_id' => 'id']);
    }

    /**
     * Gets query for [[Stocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::class, ['producto_id' => 'id']);
    }
}
