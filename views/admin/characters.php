<div id="account-content">
    <?php require_once 'views/admin/category-block.php' ?>
    <div id='main-content-account'>
        <div id="saga-panel">
            <div class="create-block">
                <h3>Crear nuevo Personaje</h3>
                <form method="POST" action="<?= base_url ?>admin/create" class="st2-form">
                    <div style="display: none;" class="st2-form-group">
                        <label for="entity">Entidad</label>
                        <input value="character" type="hidden" name="entity" required>
                    </div>
                    <div class="st2-form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" required>
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

                    <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Crear</button>
                </form>
                <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>

            </div>
            <div class="create-block">
                <h3>Crear nueva Saga</h3>
                <form method="POST" action="<?= base_url ?>admin/create" class="st2-form">
                    <div style="display: none;" class="st2-form-group">
                        <label for="entity">Entidad</label>
                        <input value="saga" type="hidden" name="entity" required>
                    </div>
                    <div class="st2-form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" required>
                    </div>
                    

                    <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Crear</button>
                </form>
                <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>

            </div>
            
        </div>
        <div id="categories-container">
            <div>
            <?php
                if (isset($_GET['id'])) {
                    $category_name = Utils::getEntityName($all_sagas, $_GET['id']);
                    echo "<h1>{$category_name}</h1>";
                } else     echo "<h1>Sagas</h1>"
                ?>

            </div>

            <div id="categories-list">

                <?php


                if ($character_list) {
                    echo " 
                        <div class='table-container'>
                            <div class='table-headings'>
                            <div class='table-heading'>id</div>
                            <div class='table-heading'>Nombre</div>
                            <div class='table-heading'>Acción</div>
                        </div>
                    ";
                    foreach ($character_list as $character) {
                        

                        echo "                 
                            <div class='table-rows'> 
                                <div class='table-cell'>{$character['id']}</div>
                                <div class='table-cell'><a href='" . base_url . "admin/sagas&id={$character['id']}'> {$character['name']} </a></div>
                                
                                <div class='table-cell'> 
                                    
                                        <button class='edit-cat edit-button'><i class='fa-solid fa-pen-to-square'></i></button> 
                                    
                                    <a href='" . base_url . "admin/delete&id={$character['id']}&entity=saga'>
                                        <button class='delete-button'><i class='fa-solid fa-trash'></i></button> 
                                    </a>

                            ";
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                        }
                        
                        
                        echo " </div> ";
                        require 'views/admin/edit-character-block.php';
                        echo " </div> ";
                        
                        
                        
                    }
                } else {
                    echo "<p style='text-align:center'>Todavía no hay Personajes para esta Serie / Manga, <strong>¡Empieza creando uno!</strong></p>";
                }
                ?>

            </div>
        </div>


    </div>
    </div>
</div>