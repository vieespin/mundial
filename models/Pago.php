<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago".
 *
 * @property int $id
 * @property int|null $monto
 * @property string|null $fecha
 * @property int $pedido_id
 * @property int $medio_pago_id
 *
 * @property MedioPago $medioPago
 * @property Pedido $pedido
 */
class Pago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['monto', 'pedido_id', 'medio_pago_id'], 'integer'],
            [['fecha'], 'safe'],
            [['pedido_id', 'medio_pago_id'], 'required'],
            [['medio_pago_id'], 'exist', 'skipOnError' => true, 'targetClass' => MedioPago::class, 'targetAttribute' => ['medio_pago_id' => 'id']],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::class, 'targetAttribute' => ['pedido_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'monto' => 'Monto',
            'fecha' => 'Fecha',
            'pedido_id' => 'Pedido ID',
            'medio_pago_id' => 'Medio Pago ID',
        ];
    }

    /**
     * Gets query for [[MedioPago]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedioPago()
    {
        return $this->hasOne(MedioPago::class, ['id' => 'medio_pago_id']);
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
}
