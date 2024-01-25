<?php

use app\models\Pedido;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

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
                    if($model->estado_pedido_id == 3){
                        return "";
                    } else {
                        /*return Html::a('PAGAR',
                            ['pedido/pagar', 'id' => $model->id],
                            [
                                'title' => 'Pagar',
                                'class' => 'btn btn-info',
                                // 'target' => '_blank',
                                //'onclick' => 'window.open("'.$url.'","_blank")'
                            ]);*/

                        $boton_pagar = Html::a('PAGAR',
                        '#',
                        [
                            'title' => 'PAGAR',
                            'class' => 'btn btn-info btn-sm showModalButton',
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'value' => Url::to(['pedido/detalle', 'id' => $model->id]),
                        ]);

                        $boton_factura = Html::a('FACTURA',
                        '#',
                        [
                            'title' => 'FACTURA',
                            'class' => 'btn btn-secondary btn-sm showModalButton',
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'value' => Url::to(['pedido/factura', 'id' => $model->id]),
                        ]);

                        return $boton_pagar.' '.$boton_factura;
                    }
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

<script>
    $(document).on('click', '#agregar-producto', function(e){
        e.preventDefault();
        //console.log('funciona');

        var producto = <?= json_encode($medio_pago) ?>;

        var select = $('<select />').attr('class', 'form-control producto');

        Object.entries(producto).forEach(entry => {
            const [key, value] = entry;
            select.append($('<option />').attr('value', key).text(value));

        });
        var eliminar = $('<div class="col-md-1" />').append($('<button class="btn btn-danger delete-pago" />').text('X'));
        var nuevo_producto = $('<div class="fila-pago col-md-12" />').append($('<div class="row" />').append($('<div class="col-md-6" />').append(select)).append($('<div class="col-md-5" />').append($('<input type="number" >').attr('class', 'form-control cantidad').val(0))).append(eliminar));
        $("#varios-pagos").append(nuevo_producto);
    });

    //eliminar producto
    $(document).on('click', '.delete-pago', function(e){
        e.preventDefault();
        // console.log('funciona');
        $(this).parent().parent().parent().remove();
    });

    function obtener_pagos(){
        var producto = "";
        var cantidad = 0;
        var suma_cantidad = 0;
        var producto_cantidad = "";
        const tableRows = document.querySelectorAll('#varios-pagos div.fila-pago');
        for(let i=0; i<tableRows.length; i++){
            const row = tableRows[i];
            producto = row.querySelector('.producto').value;
            cantidad = row.querySelector('.cantidad').value;

            suma_cantidad = suma_cantidad + parseInt(cantidad);

            if(cantidad < 1){
                return "error";
            } 
            producto_cantidad += producto + "," + cantidad;
            if(i<tableRows.length - 1){
                producto_cantidad += "-";
            }
            producto = "";
            cantidad = 0;
        }

        var total = $("#varios-pagos").attr('data-total-pedido');

        console.log(suma_cantidad);
        console.log(total);

        if(suma_cantidad == total){
            return producto_cantidad;
        } else {
            return "error";
        }
        
    }

    $(document).on('click', '.pagar-pedido', function(e){
        e.preventDefault();
        e.stopPropagation();

        //var id = $(".pagar-pedido").attr('data-id');
        var id = $(this).attr('data-id');

        var detalle = obtener_pagos();
        // console.log(detalle);

        if(detalle == "error"){
            alert("POR FAVOR REVISA LOS MONTOS");
            return;
        }

        $.ajax({
            url: '<?= Url::to(['pedido/pagar-pedido'])?>',
            data: {
                'id' : id,
                'detalles' : detalle
            },
            dataType: 'json',
            timeout: 10000,
            beforeSend: function() {
            },  
            success: function(data) {
                console.log(data);
                if(data){
                    window.location.href = '<?= Url::to(['pedido/index'])?>';
                }

            },
            error: function() {
            }
        });
        
    });
</script>
