<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $fono
 * @property string|null $sector
 * @property string|null $calle
 * @property string|null $numero
 *
 * @property Pedido[] $pedidos
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fono', 'sector', 'calle', 'numero'], 'string', 'max' => 45],
            ['fono', 'unique'],
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
            'fono' => 'Fono',
            'sector' => 'Sector',
            'calle' => 'Calle',
            'numero' => 'Numero',
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::class, ['cliente_id' => 'id']);
    }
}
