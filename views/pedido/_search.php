<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PedidoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pedido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'sector') ?>

    <?= $form->field($model, 'fono') ?>

    <?php // echo $form->field($model, 'repartidor') ?>

    <?php // echo $form->field($model, 'calle') ?>

    <?php // echo $form->field($model, 'numero') ?>

    <?php // echo $form->field($model, 'cliente_id') ?>

    <?php // echo $form->field($model, 'repartidor_id') ?>

    <?php // echo $form->field($model, 'estado_pedido_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
