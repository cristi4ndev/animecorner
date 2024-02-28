<div class="filter-products">
    <form method="POST" action="<?= base_url ?>admin/products" class="st2-form">
        <div class="filter-by-category">
            <h3>Filtrar por Categoría</h3>

            <div class="st2-form-group">
                <label for="category">Seleccionar categoría:</label>
                <select name="category" id="category">
                    <option value=""> - </option>;
                    <?php
                    // Eliminar duplicados del array basado en 'category_id'
                    $uniqueProducts = array_unique(array_column($products, 'category_id'));


                    foreach ($uniqueProducts as $categoryId) {

                        $categoryName = '';
                        foreach ($products as $product) {
                            if ($product['category_id'] === $categoryId) {
                                $categoryName = $product['category_name'];
                                break;
                            }
                        }

                        echo "<option value='$categoryId'>$categoryName</option>";
                    }
                    ?>
                </select>
            </div>



            <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>

        </div>
        <div class="filter-by-saga">
            <h3>Filtrar por Saga</h3>

            <div class="st2-form-group">
                <label for="saga">Seleccionar saga:</label>
                <select name="saga" id="saga">
                    <option value=""> - </option>;

                    <?php
                    // Eliminar duplicados del array basado en 'category_id'
                    $uniqueProducts = array_unique(array_column($products, 'saga_id'));


                    foreach ($uniqueProducts as $sagaId) {

                        $sagaName = '';
                        foreach ($products as $product) {
                            if ($product['saga_id'] === $sagaId) {
                                $sagaName = $product['saga_name'];
                                break;
                            }
                        }

                        echo "<option value='$sagaId'>$sagaName</option>";
                    }
                    ?>
                </select>
            </div>



            <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>

        </div>
        <button class="primary-button" type="submit"><i class="fa-solid fa-filter"></i>Filtrar</button>
        
    </form>
    <a href="<?=base_url?>admin/products">
    <button class="delete-button" ><i class="fa-solid fa-filter-circle-xmark"></i>Reiniciar filtros</button>
    </a>
</div>