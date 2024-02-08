<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/** @var yii\web\View $this */
/** @var app\models\PedidoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<!-- <div class="col-md-6">

<div class="card card-success">
<div class="card-header">
<h3 class="card-title">Different Height</h3>
</div>
<div class="card-body">
<input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
<br>
<input class="form-control" type="text" placeholder="Default input">
<br>
<input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
</div>

</div>

<div class="card card-danger">
<div class="card-header">
<h3 class="card-title">Different Width</h3>
</div>
<div class="card-body">
<div class="row">
<div class="col-3">
<input type="text" class="form-control" placeholder=".col-3">
</div>
<div class="col-4">
<input type="text" class="form-control" placeholder=".col-4">
</div>
<div class="col-5">
<input type="text" class="form-control" placeholder=".col-5">
</div>
</div>
</div>

</div>


<div class="card card-warning">
<div class="card-header">
<h3 class="card-title">General Elements</h3>
</div>

<div class="card-body">
<form>
<div class="row">
<div class="col-sm-6">

<div class="form-group">
<label>Text</label>
<input type="text" class="form-control" placeholder="Enter ...">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Text Disabled</label>
<input type="text" class="form-control" placeholder="Enter ..." disabled="">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">

<div class="form-group">
<label>Textarea</label>
<textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Textarea Disabled</label>
<textarea class="form-control" rows="3" placeholder="Enter ..." disabled=""></textarea>
</div>
</div>
</div>

<div class="form-group">
<label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
success</label>
<input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
</div>
<div class="form-group">
<label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
warning</label>
<input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
</div>
<div class="form-group">
<label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
error</label>
<input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
</div>
<div class="row">
<div class="col-sm-6">

<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="checkbox">
<label class="form-check-label">Checkbox</label>
</div>
<div class="form-check">
<input class="form-check-input" type="checkbox" checked="">
<label class="form-check-label">Checkbox checked</label>
</div>
<div class="form-check">
<input class="form-check-input" type="checkbox" disabled="">
<label class="form-check-label">Checkbox disabled</label>
</div>
</div>
</div>
<div class="col-sm-6">

<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="radio" name="radio1">
<label class="form-check-label">Radio</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="radio1" checked="">
<label class="form-check-label">Radio checked</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" disabled="">
<label class="form-check-label">Radio disabled</label>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">

<div class="form-group">
<label>Select</label>
<select class="form-control">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Select Disabled</label>
<select class="form-control" disabled="">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">

<div class="form-group">
<label>Select Multiple</label>
<select multiple="" class="form-control">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Select Multiple Disabled</label>
<select multiple="" class="form-control" disabled="">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
</div>
</div>
</form>
</div>

</div>


<div class="card card-secondary">
<div class="card-header">
<h3 class="card-title">Custom Elements</h3>
</div>

<div class="card-body">
<form>
<div class="row">
<div class="col-sm-6">

<div class="form-group">
<div class="custom-control custom-checkbox">
<input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
<label for="customCheckbox1" class="custom-control-label">Custom Checkbox</label>
</div>
<div class="custom-control custom-checkbox">
<input class="custom-control-input" type="checkbox" id="customCheckbox2" checked="">
<label for="customCheckbox2" class="custom-control-label">Custom Checkbox checked</label>
</div>
<div class="custom-control custom-checkbox">
<input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled="">
<label for="customCheckbox3" class="custom-control-label">Custom Checkbox disabled</label>
</div>
<div class="custom-control custom-checkbox">
<input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" checked="">
<label for="customCheckbox4" class="custom-control-label">Custom Checkbox with custom color</label>
</div>
<div class="custom-control custom-checkbox">
<input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" id="customCheckbox5" checked="">
<label for="customCheckbox5" class="custom-control-label">Custom Checkbox with custom color outline</label>
</div>
</div>
</div>
<div class="col-sm-6">

<div class="form-group">
<div class="custom-control custom-radio">
<input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
<label for="customRadio1" class="custom-control-label">Custom Radio</label>
</div>
<div class="custom-control custom-radio">
<input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked="">
<label for="customRadio2" class="custom-control-label">Custom Radio checked</label>
</div>
<div class="custom-control custom-radio">
<input class="custom-control-input" type="radio" id="customRadio3" disabled="">
<label for="customRadio3" class="custom-control-label">Custom Radio disabled</label>
</div>
<div class="custom-control custom-radio">
<input class="custom-control-input custom-control-input-danger" type="radio" id="customRadio4" name="customRadio2" checked="">
<label for="customRadio4" class="custom-control-label">Custom Radio with custom color</label>
</div>
<div class="custom-control custom-radio">
<input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" id="customRadio5" name="customRadio2">
<label for="customRadio5" class="custom-control-label">Custom Radio with custom color outline</label>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">

<div class="form-group">
<label>Custom Select</label>
<select class="custom-select">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Custom Select Disabled</label>
<select class="custom-select" disabled="">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">

<div class="form-group">
<label>Custom Select Multiple</label>
<select multiple="" class="custom-select">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Custom Select Multiple Disabled</label>
<select multiple="" class="custom-select" disabled="">
<option>option 1</option>
<option>option 2</option>
<option>option 3</option>
<option>option 4</option>
<option>option 5</option>
</select>
</div>
</div>
</div>
<div class="form-group">
<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input" id="customSwitch1">
<label class="custom-control-label" for="customSwitch1">Toggle this custom switch element</label>
</div>
</div>
<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
<input type="checkbox" class="custom-control-input" id="customSwitch3">
<label class="custom-control-label" for="customSwitch3">Toggle this custom switch element with custom colors danger/success</label>
</div>
</div>
<div class="form-group">
<div class="custom-control custom-switch">
<input type="checkbox" class="custom-control-input" disabled="" id="customSwitch2">
<label class="custom-control-label" for="customSwitch2">Disabled custom switch element</label>
</div>
</div>
<div class="form-group">
<label for="customRange1">Custom range</label>
<input type="range" class="custom-range" id="customRange1">
</div>
<div class="form-group">
<label for="customRange2">Custom range (custom-range-danger)</label>
<input type="range" class="custom-range custom-range-danger" id="customRange2">
</div>
<div class="form-group">
<label for="customRange3">Custom range (custom-range-teal)</label>
<input type="range" class="custom-range custom-range-teal" id="customRange3">
</div>
<div class="form-group">

<div class="custom-file">
<input type="file" class="custom-file-input" id="customFile">
<label class="custom-file-label" for="customFile">Choose file</label>
</div>
</div>
<div class="form-group">
</div>
</form>
</div>

</div>

</div> -->






<div class="pedido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class='row'>

        <!-- <?= $form->field($model, 'id') ?> -->

        <div class="card bg-light text-dark">
            <div class="card-header">
                <h3 class="card-title">Barra de busqueda</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                    <?= $form->field($model, 'fecha', ['template' => '
                    <div >
                        {label}
                        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            {input}
                            <!-- <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span> -->
                        </div>{error}{hint}
                    </div>'])->widget(DateRangePicker::className(),[
            'model'=>$model,
            'convertFormat'=>true,
            'presetDropdown'=>true,
            'startAttribute'=>'inicio_rango',
            'endAttribute'=>'fin_rango',
            'options' => ['placeholder' => 'Todas las fechas'],
            'pluginOptions'=>[
                'locale'=>['format' => 'd-m-Y'],
                'opens'=>'right'
            ]
        ])->label('Fecha creación')?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'nombre') ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'sector') ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'fono') ?>
                    </div>
                    <div class="col-3">
                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                        
                        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                    </div>
                    
                </div>
            </div>

        </div>

        
    
        

        

     
    </div>



    <?php // echo $form->field($model, 'repartidor') ?>

    <?php // echo $form->field($model, 'calle') ?>

    <?php // echo $form->field($model, 'numero') ?>

    <?php // echo $form->field($model, 'cliente_id') ?>

    <?php // echo $form->field($model, 'repartidor_id') ?>

    <?php // echo $form->field($model, 'estado_pedido_id') ?>

    

    <?php ActiveForm::end(); ?>

</div>
