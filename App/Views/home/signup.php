<?php $this->layout('layouts::structure', ['title' => $title]) ?>

<div class="container">
    <div class="row">
        <h2 class="center-align p2">Registrate a money tracking y obten una cuenta totalmente gratis!</h2>
        <div class="row">
            <form class="col s12 " action="<?php echo APP_URL?>home/signup" method="post">

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input class="validate" id="name" name="name" type="text" required/>
                        <label for="name">Nombre completo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person_pin</i>
                        <input id="displayname" name="displayname" type="text" />
                        <label for="displayname">Nombre a mostrar (opcional)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input class="validate" id="email" name="email" type="email" required/>
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_open</i>
                        <input class="validate" id="password" name="password" type="password" required/>
                        <label for="password">Password</label>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12 center-align">
                        <button class="btn waves-effect waves-light btn-large" type="submit" name="action">Regístrate
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>