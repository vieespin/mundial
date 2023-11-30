<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bodega".
 *
 * @property int $id
 * @property string|null $nombre
 * @property int $repartidor_id
 *
 * @property Movimiento[] $movimientos
 * @property Repartidor $repartidor
 * @property Stock[] $stocks
 */
class Bodega extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bodega';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['repartidor_id'], 'required'],
            [['repartidor_id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
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
            'nombre' => 'Nombre',
            'repartidor_id' => 'Repartidor ID',
        ];
    }

    /**
     * Gets query for [[Movimientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientos()
    {
        return $this->hasMany(Movimiento::class, ['bodega_id' => 'id']);
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

    /**
     * Gets query for [[Stocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::class, ['bodega_id' => 'id']);
    }
}
