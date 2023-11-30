<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MedioPago $model */

$this->title = 'Update Medio Pago: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Medio Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medio-pago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
