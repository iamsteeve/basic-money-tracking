<?php $this->layout('layouts::structure', ['title' => $title ]) ?>

<div class="container">
    <div class="row">
        <h2>Agregar una Transacción</h2>
        <div class="row">
            <form class="col s12 " action="<?php echo APP_URL?>transactions/add" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <select name="account_id" >
                            <option disabled selected>Elegir Una Cuenta</option>
                            <?php foreach ($accounts as $account):?>
                                <option value="<?php echo $account->getId()?>"><?php echo $account->getName()?></option>
                            <?php  endforeach?>
                        </select>
                        <label >Cuenta</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select name="category_id" >
                            <option disabled selected>Elegir Una categoría</option>
                            <?php foreach ($categories as $category):?>
                                <option value="<?php echo $category->getId()?>"><?php echo $category->getName()?></option>
                            <?php  endforeach?>
                        </select>
                        <label >Categoría</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input class="validate" id="description" name="description" type="text" required/>
                        <label for="description">Descripción</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input step="any" class="validate" id="amount" name="amount" type="number" value="0" required/>
                        <label for="amount">Monto</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label>Fecha</label>
                        <input class="datepicker"  type="text" name="date" value="<?php echo date("Y-m-d"); ?>"/>
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