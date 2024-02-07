<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Pedido $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Pedido '.$realizados +1;
?>


<div class="pedido-form">
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <h3>Cliente</h3>
            <?php $form = ActiveForm::begin(['id' => 'ingreso-cliente']); ?>



        <?= $form->field($model, 'fono')->textInput(['maxlength' => true, 'class'=>"form-control fono"]) ?>
        
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sector')->dropDownList(['Chiguayante' => 'Chiguayante', 
                                                          'Hualqui' => 'Hualqui', 
                                                          'Quilacoya' => 'Quilacoya', 
                                                          'Unihue' => 'Unihue', 
                                                          'Talcamavida' => 'Talcamavida'], 
                                                          ['prompt' => 'Seleccione sector']) ?>

        <?= $form->field($model, 'calle')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

       

        <?php  /*echo $form->field($model, 'medio_pago')->widget(Select2::classname(), [
            'data' => $medioPago,
            'options' => ['placeholder' => 'Seleccione medio de pago'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Medio de Pago')*/?>

        

        <?php echo $form->field($model, 'repartidor')->widget(Select2::classname(), [
            'data' => $repartidores,
            'options' => ['placeholder' => 'Seleccione un repartidor'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Repartidor')?>

        



        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-block js-click']) ?>
        </div>

        <?php ActiveForm::end(); ?>

            
        </div>

        <!-- <form id = "formulario"> -->


            <div class="col-md-8" style="margin-top: 0px;">
                <div class="row">
                    <h3>Detalle</h3>
                    <p style="margin-left: 10px;"><button id="agregar-producto" class="btn btn-success btn-sm">Agregar Producto</button></p>
                </div>
                
                <div id="varios-pagos" class="row">

                    <div class="col-md-12 fila-pago" style="margin-top: 27px;">

                        <div class="row">
                            <div class="col-md-4">
                                <?= Html::dropDownList('s_id',3,$producto,['class' => 'form-control producto'])?>    
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="cantidad" value="1" class="form-control cantidad">
                                
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        <!-- </form> -->
    </div>

    

</div>

<script>
    // function formatear(fono){
    //     if(fono)
    //         fono.replace(searchValue, newValue)
    // }

    $('.fono').focusout(function(e){
        var fono = $(this).val();
        //console.log("pasar datos");
        //fono = formatear(fono);
        //console.log(fono);
        $.ajax({
            url: '<?= Url::to(['cliente/buscar'])?>',
            data: {fono: fono},
            dataType: 'json',
            timeout: 10000,
            beforeSend: function() {
                // $(".se-pre-con").fadeIn("slow");
            },  
            success: function(respuesta) {
                //console.log(respuesta);
                if (respuesta) {
                    $('#pedidoform-nombre').val(respuesta.nombre);
                    $('#pedidoform-sector').val(respuesta.sector);
                    $('#pedidoform-calle').val(respuesta.calle);
                    $('#pedidoform-numero').val(respuesta.numero);
                    $('#pedidoform-observacion').val(respuesta.observacion);

                }
            },
            error: function() {
            }
        });
    });

    $(document).on('click', '#agregar-producto', function(e){
        e.preventDefault();
        //console.log('funciona');

        var producto = <?= json_encode($producto) ?>;

        var select = $('<select />').attr('class', 'form-control producto');

        Object.entries(producto).forEach(entry => {
            const [key, value] = entry;
            select.append($('<option />').attr('value', key).text(value));

        });
        var eliminar = $('<div class="col-md-1" />').append($('<button class="btn btn-danger delete-pago" />').text('X'));
        var nuevo_producto = $('<div class="fila-pago col-md-12" />').append($('<div class="row" />').append($('<div class="col-md-4" />').append(select)).append($('<div class="col-md-4" />').append($('<input type="number" >').attr('class', 'form-control cantidad').val(1))).append(eliminar));
        $("#varios-pagos").append(nuevo_producto);
    });

    //eliminar producto
    $(document).on('click', '.delete-pago', function(e){
        e.preventDefault();
        console.log('funciona');
        $(this).parent().parent().parent().remove();
    });

    $(document).on('click', '.js-click', function(e){
        e.preventDefault();
        e.stopPropagation();
        //var cliente = $('#ingreso-cliente').val();
        var fono = $('#pedidoform-fono').val();
        var nombre = $('#pedidoform-nombre').val();
        var sector = $('#pedidoform-sector').val();
        var calle = $('#pedidoform-calle').val();
        var numero = $('#pedidoform-numero').val();
        var observacion = $('#pedidoform-observacion').val();
        var repartidor = $('#pedidoform-repartidor').val();
        var detalle = obtener_pagos();
        console.log(detalle);
        


        if(detalle == "error"){
            alert("Revisa la wea, asopao");
            return;
        }

        $.ajax({
            url: '<?= Url::to(['pedido/generar'])?>',
            data: {
                'fono' : fono,
                'nombre' : nombre,
                'sector' : sector,
                'calle' : calle,
                'numero' : numero,
                'observacion' : observacion,
                'repartidor' : repartidor,
                'detalle' : detalle
            },
            dataType: 'json',
            timeout: 10000,
            beforeSend: function() {
                // $(".se-pre-con").fadeIn("slow");
            },  
            success: function(data) {
                console.log(data);
                if(data.respuesta){
                    window.location.href = '<?= Url::to(['pedido/index'])?>';
                }

            },
            error: function() {
            }
        });
        
    });

    function obtener_pagos(){
        var producto = "";
        var cantidad = 0;
        var producto_cantidad = "";
        const tableRows = document.querySelectorAll('#varios-pagos div.fila-pago');
        for(let i=0; i<tableRows.length; i++){
            const row = tableRows[i];
            producto = row.querySelector('.producto').value;
            cantidad = row.querySelector('.cantidad').value;
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
        return producto_cantidad;
    }







    </script>
