<?php $this->layout('layouts::structure', [ "title" => $title]) ?>
<div class="container">
    <h2>Lista de Usuarios</h2>
    <!-- a class="btn" href="<?//php echo APP_URL ?>categories/add">Agregar Categoría</a-->
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