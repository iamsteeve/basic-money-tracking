<?php $this->layout('layouts::structure', ['title' => $title ]) ?>

<div class="container">
    <div class="row">
        <h2>Agregar Cuenta </h2>
        <div class="row">
            <form class="col s12 " action="<?php echo APP_URL?>accounts/add" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="name" name="name" type="text" required/>
                        <label for="name">Nombre</label>
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