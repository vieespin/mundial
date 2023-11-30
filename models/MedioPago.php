<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medio_pago".
 *
 * @property int $id
 * @property string|null $nombre
 * @property int|null $vigente
 *
 * @property Pago[] $pagos
 */
class MedioPago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medio_pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vigente'], 'integer'],
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
            'vigente' => 'Vigente',
        ];
    }

    /**
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::class, ['medio_pago_id' => 'id']);
    }
}
