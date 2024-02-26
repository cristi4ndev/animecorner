<div id="account-content">
    <?php require_once 'views/admin/category-block.php' ?>
    <div id='main-content-account'>
        <div class="secondary-admin-menu">
            <?php require_once 'views/admin/products/new_product_block.php' ?>
            <?php require_once 'views/admin/products/filter_products_block.php' ?>
        </div>
        <div id="create-product">
            <form class="create-product" method="POST" action="<?= base_url ?>admin/create" enctype="multipart/form-data">
            <input type="hidden" value="product" name="entity" id="entity">    
            <div id="product-title" >
                    <input type="text" name="name" id="name" placeholder="Escribe el nombre del producto...">

                </div>
                <div style="display: flex; ">
                    <div id="first-column">
                        <div id="product-image-block">
                            <div id="product-image">
                                <img src="<?= base_url ?>uploads/images/image-placeholder.png">
                            </div>
                            <div style="display:flex; flex-direction:column">
                                <label for="image">Subir una imagen:</label>
                                <input type="file" id="image" name="image"  accept=".jpg,.jpeg,.gif,.png">
                            </div>
                        </div>



                        <div class="st2-form-group">
                            <h2 for="category">Categoría Padre:</h2>
                            <select name="category" id="category">
                                <option value="1">Inicio</option>
                                <?php
                                $categories = Utils::getCategories();
                                foreach ($categories as $category) {
                                    echo "<option value='" . $category["id"] . "'>" . $category["name"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div>
                            <h2 for="stock">Stock:</h2>
                            <input type="number" id="stock" name="stock">
                        </div>
                        <div>
                            <h2 for="price">Precio:</h2>
                            <input type="number" step="0.01" id="price" name="price">
                        </div>
                        <div><button class="primary-button" type="submit"><i class="fa-solid fa-floppy-disk"></i>Guardar</button></div>  
                    </div>
                    <div id="second-column">


                        <div>
                            <h2 for="description">Descripción:</h2>
                            <textarea id="description" name="description" rows="20" cols="100" placeholder="Escribe una descripción..."> </textarea>
                        </div>
                        <div>

                            <div class="st2-form-group">
                                <h2 for="saga">Saga:</h2>
                                <select name="saga" id="saga">
                                    
                                    <?php
                                    $sagas = Utils::getSagas();
                                    // Filtrar los datos para no que aparezcan duplicados por el inner join
                                    
                                    foreach ($sagas as $saga) {
                                        echo "<option value='" . $saga["id"] . "'>" . $saga["name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h2>Personaje/s:</h2>
                                <div id="characters-container">
                                <p>No existen personajes para esta Saga, por favor, vaya al panel de administración para crear personajes nuevos.</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>

        

    </div>
                                 
    </form>
</div>

