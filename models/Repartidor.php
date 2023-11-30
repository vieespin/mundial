<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "repartidor".
 *
 * @property int $id
 * @property int $usuario_id
 *
 * @property Bodega[] $bodegas
 * @property Garantia[] $garantias
 * @property Pedido[] $pedidos
 * @property Usuario $usuario
 */
class Repartidor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'repartidor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'required'],
            [['usuario_id'], 'integer'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * Gets query for [[Bodegas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBodegas()
    {
        return $this->hasMany(Bodega::class, ['repartidor_id' => 'id']);
    }

    /**
     * Gets query for [[Garantias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGarantias()
    {
        return $this->hasMany(Garantia::class, ['repartidor_id' => 'id']);
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::class, ['repartidor_id' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::class, ['id' => 'usuario_id']);
    }
}
