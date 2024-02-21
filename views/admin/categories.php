<div id="account-content">
    <?php require_once 'views/admin/category-block.php' ?>
    <div id='main-content-account'>
        <div id="category-panel">
            <div id="create-block">
                <h3>Crear nueva categoría</h3>
                <form method="POST" action="<?= base_url ?>admin/create" class="st2-form">
                    <div style="display: none;" class="st2-form-group">
                        <label for="entity">Entidad</label>
                        <input value="category" type="hidden" name="entity" required>
                    </div>
                    <div class="st2-form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" required>
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

                    <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Crear</button>
                </form>
                <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>

            </div>
            <div id="category-tree">
                <h3>Árbol de Categorías</h3>
                <?php Utils::printCategoriesTree($all_categories); ?>
            </div>
        </div>
        <div id="categories-container">
            <div>
                <?php
                if (isset($_GET['id'])) {
                    $category_name = Utils::getCategoryName($all_categories, $_GET['id']);
                    echo "<h1>{$category_name}</h1>";
                } else     echo "<h1>Inicio</h1>"
                ?>

            </div>

            <div id="categories-list">

                <?php


                if ($category_list) {
                    echo " 
                        <div class='table-container'>
                            <div class='table-headings'>
                            <div class='table-heading'>id</div>
                            <div class='table-heading'>Nombre</div>
                            <div class='table-heading'>Categoría</div>
                            <div class='table-heading'>Acción</div>
                        </div>
                    ";
                    foreach ($category_list as $category) {
                        $parent_name = Utils::getCategoryName($all_categories, $category['parent']);

                        echo "                 
                            <div class='table-rows'> 
                                <div class='table-cell'>{$category['id']}</div>
                                <div class='table-cell'><a href='" . base_url . "admin/categories&id={$category['id']}'> {$category['name']} </a></div>
                                <div class='table-cell'> {$parent_name} </div>
                                <div class='table-cell'> 
                                    
                                        <button class='edit-cat edit-button'><i class='fa-solid fa-pen-to-square'></i></button> 
                                    
                                    <a href='" . base_url . "admin/delete&id={$category['id']}&parent={$category['parent']}&entity=category'>
                                        <button class='delete-button'><i class='fa-solid fa-trash'></i></button> 
                                    </a>

                            ";
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                        }
                        
                        
                        echo " </div> ";
                        require 'views/admin/modify-block-php';
                        echo " </div> ";
                        
                        
                        
                    }
                } else {
                    echo "<p style='text-align:center'>Todavía no hay subcategorías para esta categoría, <strong>¡Empieza creando una!</strong></p>";
                }
                ?>

            </div>
        </div>


    </div>
    </div>
</div>