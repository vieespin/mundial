<?php

use yii\helpers\Url;



/** @var yii\web\View $this */

$this->title = '';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Gas Mundial</h1>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['pedido/new-pedido']) ?>">Comenzar nuevo pedido</a></p>

    </div>

    
</div>
