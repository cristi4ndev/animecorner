<div class="edit-category-block" style="display: none;">
    <h3>Modificar categoría</h3>
    <form method="POST" action="<?= base_url . 'admin/edit&entity=category' . '&id=' . $category['id'] ?>" class="st2-form">
        
        <div class="st2-form-group">
            <label for="name">Nombre</label>
            <input value="<?=$category['name']?>" type="text" name="name" required>
        </div>
        <div class="st2-form-group">
            <label for="parent">Categoría Padre:</label>
            <select name="parent" id="parent">
                <option value="1">Inicio</option>
                <?php
                foreach ($all_categories as $category) {
                    echo "<option " . ($category['id'] == $_GET['id'] ? 'selected' : '') . " value='" . $category["id"] . "'>" . $category["name"] . "</option>";
                }
                ?>
            </select>
        </div>

        <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Guardar</button>
    </form>
    <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>

</div>