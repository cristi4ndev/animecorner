<div class="edit-category-block" style="display: none;">
    <h3>Modificar Personaje</h3>
    <form method="POST" action="<?= base_url . 'admin/edit&entity=character' . '&id=' . $character['id'] ?>" class="st2-form">

        <div class="st2-form-group">
            <label for="name">Nombre</label>
            <input value="<?= $character['name'] ?>" type="text" name="name" required>
        </div>
        <div class="st2-form-group">
            <label for="saga">Categoría Padre:</label>
            <select name="saga" id="saga">
                <option value="1">Inicio</option>
                <?php
                foreach ($all_sagas as $saga) {
                    echo "<option " . ($saga['id'] == $_GET['id'] ? 'selected' : '') . " value='" . $saga["id"] . "'>" . $saga["name"] . "</option>";
                }
                ?>
            </select>
        </div>

        <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Guardar</button>
    </form>
    <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>

</div>