

    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper container">
                <a href="<?= $isLogged?APP_URL: APP_URL.'home'?>" class="brand-logo">Money Tracking</a>
                <a href="<?= $isLogged?APP_URL: APP_URL.'home'?>" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?php if($isLogged): ?>
                    <li><a href="<?php echo APP_URL?>accounts">Cuentas</a></li>
                    <li><a href="<?php echo APP_URL?>categories">Categorías</a></li>
                    <li><a href="<?php echo APP_URL?>transactions">Transactions</a></li>
                    <li><a href="<?php echo APP_URL?>home/logout">Salir de sesión</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo APP_URL?>home/login">Inicia sesión</a></li>
                        <li><a href="<?php echo APP_URL?>home/signup">Regístrate</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>


    <ul class="sidenav" id="mobile-demo">
        <?php if($isLogged): ?>
            <li>
                <p class="flow-text" style="padding-left: 20px;">Bienvenido <?= $userName? $userName: $email ?></p>
            </li>
            <li><a href="<?php echo APP_URL?>accounts">Cuentas</a></li>
            <li><a href="<?php echo APP_URL?>categories">Categorías</a></li>
            <li><a href="<?php echo APP_URL?>transactions">Transactions</a></li>
            <li><a href="<?php echo APP_URL?>home/logout">Salir de sesión</a></li>
        <?php else: ?>
            <li><a href="<?php echo APP_URL?>home/login">Inicia sesión</a></li>
            <li><a href="<?php echo APP_URL?>home/signup">Regístrate</a></li>
        <?php endif; ?>
    </ul>




