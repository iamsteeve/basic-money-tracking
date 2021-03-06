<?php $this->layout('layouts::structure', [ "title" => $title]) ?>
<div class="container">
    <h2>Lista de Usuarios</h2>
    <a class="btn" href="<?= APP_URL ?>users/add">Agregar Usuario</a>
    <button class="btn" onclick="$('.tap-target').tapTarget('open');">Ayuda!</button>
    <table class="highlight responsive-table" border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Nombre a mostrar</th>
            <th>Correo electrónico</th>
            <th>Password</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->e($user->getId()) ?></td>
                <td><?= $this->e($user->getName()) ?></td>
                <td><?= $this->e($user->getDisplayName()) ?></td>
                <td><?= $this->e($user->getEmail()) ?></td>
                <td><?= $this->e($user->getPassword()) ?></td>
                <td><a class="waves-effect waves-teal btn-flat"
                       href="<?php echo APP_URL ?>users/update/<?= $this->e($user->getId()) ?>"><i class="material-icons ">edit</i></a>
                    | <a class="waves-effect waves-teal btn-flat"
                         href="<?php echo APP_URL ?>users/delete/<?= $this->e($user->getId()) ?>"><i class="material-icons">delete</i></a>
                </td>

            </tr>

        <?php endforeach ?>
        </tbody>
    </table>
</div>
<div class="fixed-action-btn">
    <a id="floating" href="<?php echo APP_URL ?>categories/add" class="btn-floating btn-large waves-effect waves-light red">
        <i class="material-icons">add</i>
    </a>
</div>

<div class="tap-target blue darken-2" data-target="floating">
    <div class="tap-target-content">
        <h5 class="white-text text-darken-2">Haz click para agregar Categorias</h5>
    </div>
</div>