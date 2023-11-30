<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2


/** @var yii\web\View $this */
/** @var app\models\Repartidor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="repartidor-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?php echo $form->field($model, 'usuario_id')->widget(Select2::classname(), [
        'data' => $usuario,
        'options' => ['placeholder' => 'Seleccione repartidor'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Medio de Pago')?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
