<?php $this->layout('layouts::structure', ['title' => $title]) ?>

<div class="container">
    <div class="row">

        <div class="col s12 center-align">
            <h1>Ha ocurrido algo inesperado: Aqui más información</h1>
            <img class="responsive-img" src="<?= APP_URL_IMG ?>wowerror.png" alt="Wooow un error">
        </div>
        <div class="col s12 center-align">
            <h1> <?= $this->e($message) ?> </h1>
        </div>
    </div>
</div>
