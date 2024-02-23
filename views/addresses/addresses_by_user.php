<?php
require_once 'controllers/AddressController.php';

// Crear una instancia del controlador de direcciones
$addressController = new AddressController();

$addressinstance = new Address();

$addressinstance->setUserId($_SESSION['user']['id']);

// Obtener todas las direcciones del usuario actual
$addresses = $addressinstance->getAll(); ?>


<?php foreach ($addresses as $address) : ?>
    <div>
        <form method="POST"  action="<?=base_url?>address/update" class="st2-form">
            <div class="st2-form-group" style="display: none;">
                <label for="id">Id</label>
                <input  name="id" value="<?php echo $address['id']; ?>">
            </div>
            <div class="st2-form-group">
                <label for="alias">Alias</label>
                <input disabled type="text" name="alias" value="<?php echo $address['alias']; ?>">
            </div>
            <div class="st2-form-group">
                <label for="address">Dirección</label>
                <input disabled type="text" name="address" value="<?php echo $address['address']; ?>">
            </div>
            <div class="st2-form-group">
                <label for="locality">Localidad</label>
                <input disabled type="text" name="locality" value="<?php echo $address['locality']; ?>">
            </div>
            <div class="st2-form-group">
                <label for="province">Provincia</label>
                <input disabled type="text" name="province" value="<?php echo $address['province']; ?>">
            </div>
            <div class="st2-form-group">
                <label for="postal_code">Código Postal</label>
                <input disabled type="text" name="postal_code" value="<?php echo $address['postal_code']; ?>">
            </div>
            <div class="st2-form-group">
                <label for="country">País</label>
                <input disabled type="text" name="country" value="<?php echo $address['country']; ?>">
            </div>
            <div class="st2-form-group">
                <label for="phone">Teléfono</label>
                <input disabled type="tel" name="phone" value="<?php echo $address['phone']; ?>">
            </div>
            <div style="display: flex; justify-content:center;gap:10px;">
                <button  style="display: inline-block;" class="button edit-address">
                    <i class="fa-solid fa-pen-to-square"></i>Editar
                </button>

                <button style="display: none;" type="submit" class="button update-address" id="update-address" >
                    <i class="fa-solid fa-circle-check"></i>Guardar
                </button>

                <button type="submit" class="button" formaction="<?= base_url ?>address/delete">
                    <i class="fa-solid fa-trash-can"></i>Borrar
                </button>
            </div>


        </form>

    </div>

<?php endforeach; ?>