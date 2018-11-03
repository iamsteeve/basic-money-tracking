<?php $this->layout('layouts::structure', ['title' => $title ]) ?>

<div class="container">
    <div class="row">
        <h2>Agregar Usuario </h2>
        <div class="row">
            <form class="col s12 " action="<?php echo APP_URL?>users/update/<?php echo $user->getId()?>" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" value="<?= $this->e($user->getName()) ?>" id="name" name="name" type="text" required/>
                        <label for="name">Nombre</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="email" value="<?= $this->e($user->getEmail()) ?>" name="email" type="email" required/>
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="displayname" value="<?= $this->e($user->getDisplayName()) ?>" name="displayname" type="text" required/>
                        <label for="displayname">Nombre a mostrar</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="password" value="<?= $this->e($user->getPassword()) ?>" name="password" type="password" required/>
                        <label for="password">Password</label>
                    </div>
                </div>




                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Guardar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>