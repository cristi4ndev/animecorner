<div id="account">
    
    <div id="login">
        <h1>Zona de Administración</h1>
        <h3>Inicia sesión:</h3>
        <form class="st-form" action="<?= base_url ?>admin/login" method="POST">

            <div class="st-form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" required />
            </div>
            <div class="st-form-group">
                <label for="password">Contraseña: </label>
                <input type="password" name="password" id="password" required />
            </div>
            <div>
                <input class="button" type="submit" value="Iniciar sesión" id="login-button">
            </div>

        </form>
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] == 'failed') {
            echo "<div><p class='alert'>{$_SESSION['error']}</p></div>";
        }
        ?>
    </div>


</div>