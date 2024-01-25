<?php

use yii\helpers\Html;
use yii\helpers\Url;

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

<div class="col-md-12" style="margin-top: 0px;">
    <div class="row">
        <h3>PAGAR</h3>
        <p style="margin-left: 10px;"><button id="agregar-producto" class="btn btn-success">Agregar Pagos</button></p>
    </div>
    
    <div id="varios-pagos" class="row" data-total-pedido="<?= $pedido->getTotal() ?>">

        <div class="col-md-12 fila-pago" style="margin-top: 27px;">

            <div class="row">
                <div class="col-md-6">
                    <?= Html::dropDownList('s_id',1,$medio_pago,['class' => 'form-control producto'])?>    
                </div>
                <div class="col-md-5">
                    <input type="number" name="cantidad" value="<?= $pedido->getTotal() ?>" class="form-control cantidad">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-block pagar-pedido mt-3', 'data-id' => $pedido->id]) ?>
            </div>
        </div>
    </div>
</div>


