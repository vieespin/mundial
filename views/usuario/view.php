<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Usuario $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'rut',
            'username',
            'apellido_paterno',
            'apellido_materno',
            'email:email',
            'fono',
            'status',
            'attempts',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'created_at',
            'update_at',
            'token',
            'token_expiration',
            'refresh_token',
            'refresh_person_id',
            'sector',
            'calle',
            'numero',
        ],
    ]) ?>

</div>
