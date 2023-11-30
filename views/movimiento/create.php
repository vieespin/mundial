<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Movimiento $model */

$this->title = 'Create Movimiento';
$this->params['breadcrumbs'][] = ['label' => 'Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
