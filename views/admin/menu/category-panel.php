<div id="category-panel">
            <div id="create-block">
                <h3>Añadir categoría al menú</h3>
                <form method="POST" action="<?= base_url ?>admin/edit&menu=1&entity=menu" class="st2-form">
                                     
                    <div class="st2-form-group">
                        <label for="id">Seleccionar Categoría:</label>
                        <select name="id" id="id">
                            <?php
                            foreach ($all_categories as $category) {
                                echo "<option " . ($category['id'] == $_GET['id'] ? 'selected' : '') . " value='" . $category["id"] . "'>" . $category["name"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Añadir</button>
                </form>
                <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>

            </div>
            
        </div>