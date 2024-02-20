<div id="account-content">
    <?= require_once 'views/user/category-block.php' ;
    if (isset($_SESSION['error'])) echo "<p> {$_SESSION['error']} </p>"
    ?>

    <div id="main-content-account">
        <div id="create-address" >
            <h3>Crear Nueva Dirección</h3>
            <form method="POST" action="<?= base_url ?>address/create" class="st2-form">
                <div class="st2-form-group">
                    <label for="alias">Alias</label>
                    
                    <input type="text" name="alias" required>
                </div>
                <div class="st2-form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" required>
                </div>
                <div class="st2-form-group">
                    <label for="locality">Localidad</label>
                    <input type="text" name="locality" required>
                </div>
                <div class="st2-form-group">
                    <label for="province">Provincia</label>
                    <input type="text" name="province" required>
                </div>
                <div class="st2-form-group">
                    <label for="postal_code">Código Postal</label>
                    <input type="number" name="postal_code" required>
                </div>
                <div class="st2-form-group">
                    <label for="country">País</label>
                    <input type="text" name="country" required>
                </div>
                <div class="st2-form-group">
                    <label for="phone">Teléfono</label>
                    <input type="number" name="phone" required>
                </div>
                <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Crear</button>
                
            </form>
            <?php if (isset($_SESSION['error'])) echo $_SESSION['error'];
            
            ?>

        </div>
        <div id="address-container">
            <div><h1>Mis direcciones</h1></div>
        
        <div id="address-list">
            
            <?php require_once 'views/addresses/addresses_by_user.php' ?>
        </div>
        </div>
    </div>
    </div>

    