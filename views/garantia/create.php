<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Garantia $model */

$this->title = 'Create Garantia';
$this->params['breadcrumbs'][] = ['label' => 'Garantias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="garantia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
