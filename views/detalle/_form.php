<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Detalle $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detalle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'pedido_id')->textInput() ?>

    <?= $form->field($model, 'producto_id')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
