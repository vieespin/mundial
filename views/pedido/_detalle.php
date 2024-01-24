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