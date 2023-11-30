<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;


/** @var yii\web\View $this */
/** @var app\models\Pago $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pago-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'monto')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'pedido_id')->textInput() ?>

 

    <?php echo $form->field($model, 'medio_pago_id')->widget(Select2::classname(), [
        'data' => $medioPago,
        'options' => ['placeholder' => 'Seleccione un producto'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Medio de Pago')?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
