<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2


/** @var yii\web\View $this */
/** @var app\models\Bodega $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="bodega-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

   
    <?php echo $form->field($model, 'repartidor_id')->widget(Select2::classname(), [
        'data' => $repartidor,
        'options' => ['placeholder' => 'Seleccione repartidor'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Repartidor')?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
