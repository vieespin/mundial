<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MedioPago $model */

$this->title = 'Create Medio Pago';
$this->params['breadcrumbs'][] = ['label' => 'Medio Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medio-pago-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
