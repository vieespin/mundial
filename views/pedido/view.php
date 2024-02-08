<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Pedido $model */

$this->title = $model->nombre." ".$model->fono;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pedido-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    


    <div class ="card">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'fecha',
                'nombre',
                'sector',
                'fono',
                [
                    'value' => $model->repartidor->usuario->username,
                    'label' => 'Repartidor'
                ],
                'calle',
                'numero',
                'observacion',
                [
                    'value' => $model->cliente->nombre,
                    'label' => 'Cliente'
                ],
                //'cliente_id',
                //'repartidor_id',
                [
                    'value' => $model->estadoPedido->nombre,
                    'label' => 'Estado Pedido'
                ],
                //'estado_pedido_id',
                
            ],
        ]) ?>

    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalle</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total=0;
                    foreach ($model->detalles as $i => $detalle): ?>
                    <tr>
                        <td><?php echo $i+1 ?></td>
                        <td><?= $detalle->producto->nombre?></td>
                        <td><?= $detalle->cantidad?></td>
                        <td><?= $detalle->valor/$detalle->cantidad ?></td>
                        <td><?= $detalle->valor?></td>
                        <?php $total += $detalle->valor;?>
                       
                    </tr>
                    <?php
                    endforeach;
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Total</b></td>
                        <td><b>$ <?= $total?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>

        
    </div>

</div>