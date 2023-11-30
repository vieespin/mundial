<?php

use app\models\Usuario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\export\ExportMenu;


/** @var yii\web\View $this */
/** @var app\models\UsuarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?php 
        $columnas = [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'rut',
            'nombre',
            
            
            'apellido_paterno',
            //'apellido_materno',
            'email:email',
            'fono',
            //'status',
            //'attempts',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'created_at',
            //'update_at',
            //'token',
            //'token_expiration',
            //'refresh_token',
            //'refresh_person_id',
            //'sector',
            //'calle',
            //'numero',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Usuario $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ]
        ];
    ?>

        <?php echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $columnas,
                // 'hiddenColumns'=>[0, 4, 9], 
                // 'disabledColumns'=>[1, 2],
                'clearBuffers' => true,
                'showConfirmAlert' => false,
                'exportConfig' => [
                    ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_PDF => false,
                    ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_EXCEL => false,
                    ExportMenu::FORMAT_CSV => false,
                ],
                'filename' => 'Usuarios',
            ])?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columnas,
        
    ]); ?>




</div>
