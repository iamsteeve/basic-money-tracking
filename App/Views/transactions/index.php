<?php $this->layout('layouts::structure', ['title' => $title]) ?>

<div class="container">
    <h2>Lista de Transacciones</h2>
    <a class="btn" href="<?= APP_URL ?>transactions/add">Agregar Transacciones</a>
    <button class="btn" onclick="$('.tap-target').tapTarget('open');">Ayuda!</button>
    <table class="highlight responsive-table" border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Categoría</th>
            <th>Cuenta</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= $this->e($transaction->getId()) ?></td>
                <td><?= $this->e($transaction->getDescription()) ?></td>
                <td><?= $this->e($transaction->getDate('d-m-Y')) ?></td>
                <td><?= $this->transactions()->getAmountFormat(number_format($transaction->getAmount(),2), true, '$')?></td>
                <td><?= $this->e($transaction->getCategory()->getName()) ?></td>
                <td><?= $this->e($transaction->getAccount()->getName()) ?></td>

                <td><a class="waves-effect waves-teal btn-flat"
                       href="<?php echo APP_URL ?>transactions/update/<?= $this->e($transaction->getId()) ?>"><i class="material-icons ">edit</i></a>
                    | <a class="waves-effect waves-teal btn-flat"
                         href="<?php echo APP_URL ?>transactions/delete/<?= $this->e($transaction->getId()) ?>"><i class="material-icons">delete</i></a>
                </td>

            </tr>

        <?php endforeach ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Balance $<?= $this->e(number_format($balance,2))?></td>
            <td><p class="green-text">Ingresos $<?= $this->e(number_format($ingress,2))?></p></td>
            <td><p class="red-text">Egresos $<?= $this->e(number_format($egress,2))?></p></td>
        </tr>
        </tbody>
    </table>

    <div class="fixed-action-btn">
        <a id="floating" href="<?php echo APP_URL ?>transactions/add" class="btn-floating btn-large waves-effect waves-light red">
            <i class="material-icons">add</i>
        </a>
    </div>

    <div class="tap-target blue darken-2" data-target="floating">
        <div class="tap-target-content">
            <h5 class="white-text text-darken-2">Haz click para agregar Transacciones</h5>
        </div>
    </div>
</div>