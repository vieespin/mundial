<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $id
 * @property string|null $fecha
 * @property string|null $nombre
 * @property string|null $sector
 * @property string|null $fono
 * @property string|null $repartidor
 * @property string|null $calle
 * @property string|null $numero
 * @property int $cliente_id
 * @property int $repartidor_id
 * @property int $estado_pedido_id
 *
 * @property Cliente $cliente
 * @property Detalle[] $detalles
 * @property EstadoPedido $estadoPedido
 * @property Garantia[] $garantias
 * @property Pago[] $pagos
 * @property Repartidor $repartidor0
 */
class Pedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha'], 'safe'],
            [['cliente_id', 'repartidor_id', 'estado_pedido_id'], 'required'],
            [['cliente_id', 'repartidor_id', 'estado_pedido_id'], 'integer'],
            [['nombre', 'sector', 'fono', 'repartidor', 'calle', 'numero'], 'string', 'max' => 45],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::class, 'targetAttribute' => ['cliente_id' => 'id']],
            [['estado_pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoPedido::class, 'targetAttribute' => ['estado_pedido_id' => 'id']],
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
            'fecha' => 'Fecha',
            'nombre' => 'Nombre',
            'sector' => 'Sector',
            'fono' => 'Fono',
            'repartidor' => 'Repartidor',
            'calle' => 'Calle',
            'numero' => 'Numero',
            'cliente_id' => 'Cliente ID',
            'repartidor_id' => 'Repartidor ID',
            'estado_pedido_id' => 'Estado Pedido ID',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::class, ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Detalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalles()
    {
        return $this->hasMany(Detalle::class, ['pedido_id' => 'id']);
    }

    /**
     * Gets query for [[EstadoPedido]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPedido()
    {
        return $this->hasOne(EstadoPedido::class, ['id' => 'estado_pedido_id']);
    }

    /**
     * Gets query for [[Garantias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGarantias()
    {
        return $this->hasMany(Garantia::class, ['pedido_id' => 'id']);
    }

    /**
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::class, ['pedido_id' => 'id']);
    }

    /**
     * Gets query for [[Repartidor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRepartidor0()
    {
        return $this->hasOne(Repartidor::class, ['id' => 'repartidor_id']);
    }
}
