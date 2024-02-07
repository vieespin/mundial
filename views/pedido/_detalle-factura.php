<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;

?>

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
                foreach ($pedido->detalles as $i => $detalle): ?>
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

<div class="pedido-form">
    <div class="row">
        <div class="col-12">
            <h3>Factura</h3>
            <?php $form = ActiveForm::begin(); ?>

            <div class="col-md-6">
                <?= $form->field($pago, 'rut')->textInput(['maxlength' => true, 'class'=>"form-control fono"]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($pago, 'nombre')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-block']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
    $('.fono').keyup(function() {
        var rut = $(this).val().replace(/[^0-9Kk]/g, '');
        if (rut.length > 1) {
            var dv = rut.slice(-1);
            var rutFormateado = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "-" + dv;
            $(this).val(rutFormateado);
        }
    });
});

    </script>