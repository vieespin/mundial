<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Movimiento $model */

$this->title = 'Actualizar Movimiento: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="movimiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'producto' => $producto,
        'bodega' => $bodega,
    ]) ?>

</div>
