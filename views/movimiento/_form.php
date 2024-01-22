<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;


/** @var yii\web\View $this */
use \app\models\Movimiento;
/** @var yii\widgets\ActiveForm $form */
?>

<div class="movimiento-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php echo $form->field($model, 'producto_id')->widget(Select2::classname(), [
            'data' => $producto,
            'options' => ['placeholder' => 'Seleccione un producto'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Producto')?>

    
    <?= $form->field($model, 'tipo')->dropDownList(Movimiento::tipos, ['prompt' => 'Seleccione Tipo' ])?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?php echo $form->field($model, 'bodega_id')->widget(Select2::classname(), [
            'data' => $bodega,
            'options' => ['placeholder' => 'Seleccione una bodega'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Bodega')?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
