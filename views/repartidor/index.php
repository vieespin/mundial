<?php

use app\models\Repartidor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RepartidorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Repartidor';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repartidor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Repartidor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'usuario_id',
            [
                'attribute' => 'usuario_id',
                'value' => 'usuario.nombre',
                'label' => 'Nombre',

            ],
            [
                'attribute' => 'usuario_id',
                'value' => 'usuario.apellido_paterno',
                'label' => 'Apellido',

            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Repartidor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
