<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EstadoPedido $model */

$this->title = 'Create Estado Pedido';
$this->params['breadcrumbs'][] = ['label' => 'Estado Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-pedido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
