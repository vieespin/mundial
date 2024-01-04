<?php

use app\models\Pedido;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PedidoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nuevo Pedido', ['new-pedido'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fono',
            [
                'label' => 'Hora',
                'attribute' => 'fecha',
                'format' => ['time', 'php:H:i:s'],
            ],
            'nombre',
            'sector',
            
            //'repartidor',
            'calle',
            'numero',
            //'cliente_id',
            //'repartidor_id',
            [
                'attribute' => 'estado_pedido_id',
                'value' => 'estadoPedido.nombre',
                'label' => 'Estado',
            ],
            [
                'label' => 'Acción',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $column){
                    $url = Url::to(['pedido/pagar', 'id' => $model->id]);
                    return Html::a('PAGAR',
                        ['pedido/pagar', 'id' => $model->id],
                        [
                            'title' => 'Pagar',
                            'class' => 'btn btn-info',
                            // 'target' => '_blank',
                            //'onclick' => 'window.open("'.$url.'","_blank")'
                        ]);
                },
                'filter'=>false,
                'enableSorting'=>false,
                'headerOptions' => ['style' => 'color: #007bff'],
            ],


            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pedido $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            
        ],
    ]); ?>


</div>
