<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EstadoPedido $model */

$this->title = 'Update Estado Pedido: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estado Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estado-pedido-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
