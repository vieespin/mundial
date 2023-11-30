<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UsuarioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'rut') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'apellido_paterno') ?>

    <?php // echo $form->field($model, 'apellido_materno') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'fono') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'attempts') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'token_expiration') ?>

    <?php // echo $form->field($model, 'refresh_token') ?>

    <?php // echo $form->field($model, 'refresh_person_id') ?>

    <?php // echo $form->field($model, 'sector') ?>

    <?php // echo $form->field($model, 'calle') ?>

    <?php // echo $form->field($model, 'numero') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
