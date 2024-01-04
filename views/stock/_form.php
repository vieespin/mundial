<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Stock $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?php echo $form->field($model, 'bodega_id')->widget(Select2::classname(), [
            'data' => $bodega,
            'options' => ['placeholder' => 'Seleccione una bodega'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Bodega')?>

    <?php echo $form->field($model, 'producto_id')->widget(Select2::classname(), [
            'data' => $producto,
            'options' => ['placeholder' => 'Seleccione un producto'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Producto')?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
