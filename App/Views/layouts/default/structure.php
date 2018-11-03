<?php $this->layout('layouts::base', ['title' => $title]) ?>

<header>
    <?= $this->insert('layouts::header', ['title' => $title]) ?>
</header>
<main>
    <?= $this->section('content') ?>
</main>
<footer class="page-footer">
    <?= $this->insert('layouts::footer') ?>
</footer>