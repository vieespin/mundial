<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MovimientoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="movimiento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'producto_id') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'bodega_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
