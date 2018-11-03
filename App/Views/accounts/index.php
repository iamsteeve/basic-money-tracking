<?php $this->layout('layouts::structure', ['title' => $title]) ?>

<div class="container">
    <h2>Lista de Cuentas</h2>
    <!-- a class="btn" href="<?//php echo APP_URL ?>categories/add">Agregar Categoría</a-->
    <button class="btn" onclick="$('.tap-target').tapTarget('open');">Ayuda!</button>
    <table class="highlight responsive-table" border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>

            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($accounts as $account): ?>
            <tr>
                <td><?php echo $account->getId() ?></td>
                <td><?php echo $account->getName() ?></td>

                <td><a class="waves-effect waves-teal btn-flat"
                       href="<?php echo APP_URL ?>accounts/update/<?= $this->e($account->getId()) ?>"><i class="material-icons ">edit</i></a>
                    | <a class="waves-effect waves-teal btn-flat"
                         href="<?php echo APP_URL ?>accounts/delete/<?= $this->e($account->getId()) ?>"><i class="material-icons">delete</i></a>
                </td>

            </tr>

        <?php endforeach ?>
        </tbody>
    </table>
</div>