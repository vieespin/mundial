<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Repartidor $model */

$this->title = 'Crear Repartidor';
$this->params['breadcrumbs'][] = ['label' => 'Repartidor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repartidor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'usuario' => $usuario,
    ]) ?>

</div>
