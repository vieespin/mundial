<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\GarantiaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="garantia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pedido_id') ?>

    <?= $form->field($model, 'producto_id') ?>

    <?= $form->field($model, 'repartidor_id') ?>

    <?= $form->field($model, 'fecha') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
