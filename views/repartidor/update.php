<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Repartidor $model */

$this->title = 'Update Repartidor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Repartidors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repartidor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
