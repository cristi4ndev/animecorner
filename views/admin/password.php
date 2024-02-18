<div id="account-content">
    <?= require_once 'views/admin/category-block.php' ;
    
    ?>

<div id="main-content-account">
        <div id="create-address" >
            <h3>Cambia tu contraseña</h3>
            <form method="POST" action="<?= base_url ?>admin/passwordChange" class="st2-form">
                <div class="st2-form-group">
                    <label for="old-password">Contreña Actual</label>
                    
                    <input type="password" name="old-password" required>
                </div>
                <div class="st2-form-group">
                    <label for="new-password">Contraseña nueva</label>
                    <input type="password" name="new-password" required>
                </div>
                <div class="st2-form-group">
                    <label for="new-password2">Vuelve a introducir la contraseña</label>
                    <input type="password" name="new-password2" required>
                </div>
                
                <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Cambiar contraseña</button>
                
            </form>
            <?php if (isset($_SESSION['error'])) echo $_SESSION['error'];
            if (isset($_SESSION['response'])) echo $_SESSION['response'];
            
            ?>

        </div>
        
        </div>
    </div>
   

    