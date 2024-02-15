<div id="account">
    <div id="register">
        <h1>¿No tienes cuenta?</h1>
        <h3>Crea una ahora mismo:</h3>
        <form class="st-form" action="<?=base_url?>user/register" method="POST">
            <div class="st-form-group">
                <label for="name">Nombre: </label>
                <input type="text" name="name" id="name" required />
            </div>
            <div class="st-form-group">
                <label for="surname">Apellidos: </label>
                <input type="text" name="surname" id="surname" required />
            </div>
            <div class="st-form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" required />
            </div>
            <div class="st-form-group">
                <label for="password">Contraseña: </label>
                <input type="text" name="password" id="password" required />
            </div>
            <div class="st-form-group">
                <label for="dni">dni: </label>
                <input type="text" name="dni" id="dni" required />
            </div>
            <div>
                <input type="submit" value="Registrarse" id="register-button">
            </div>
            
            
        </form>
        <?php 
                if ($_SESSION['register']=='failed') {
                    echo "<div><p class='alert'>{$_SESSION['error']}</p></div>";
                }
            ?>
    </div>
    <div id="login">
        <h1>¿Ya tienes cuenta?</h1>
        <h3>Inicia sesión:</h3>
        <form class="st-form" action="<?=base_url?>user/login" method="POST">

            <div class="st-form-group">
                <label for="name">Email: </label>
                <input type="text" name="name" id="name" required />
            </div>
            <div class="st-form-group">
                <label for="name">Contraseña: </label>
                <input type="text" name="name" id="name" required />
            </div>
            <div>
                <input type="submit" value="Iniciar sesión" id="login-button">
            </div>

            </form>
    </div>

    
</div>