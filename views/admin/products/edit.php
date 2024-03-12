<div id="account-content">
    <?php require_once 'views/admin/category-block.php' ?>
    <div id='main-content-account'>

        <div id="create-product">
            <form class="create-product" method="POST" action="<?= base_url ?>admin/edit" enctype="multipart/form-data">
                <input type="hidden" value="product" name="entity" id="entity">
                <input type="hidden" value="<?=$product['id']?>" name="id" id="id">
                <div id="product-title">
                    <input type="text" name="name" id="name" placeholder="Escribe el nombre del producto..." value="<?= $product['name'] ?>">
                </div>
                <div style="display: flex; ">
                    <div id="first-column">
                        <div id="product-image-block">
                            <div id="product-image">
                                <img width="100%" src="<?= base_url . "uploads/images/products/" . $product['image'] ?>">
                            </div>
                            <div style="display:flex; flex-direction:column">
                                <label for="image">Reemplazar imagen:</label>
                                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.gif,.png">
                            </div>
                        </div>
                        <div class="st2-form-group">
                            <h2 for="category">Categoría Padre:</h2>
                            <select name="category" id="category">
                                <option value="1">Inicio</option>
                                <?php
                                $parentCategories = Utils::getCategories();
                                foreach ($parentCategories as $category) {
                                    echo "<option " . (($category['id'] == $product['category_id']) ? 'selected' : '') . " value='" . $category["id"] . "'>" . $category["name"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <h2 for="stock">Stock:</h2>
                            <input type="number" id="stock" name="stock" value="<?= $product['stock'] ?>">
                        </div>
                        <div>
                            <h2 for="price">Precio:</h2>
                            <input type="number" step="0.01" id="price" name="price" value="<?= $product['price'] ?>">
                        </div>
                        <div><button class="primary-button" type="submit"><i class="fa-solid fa-square-check"></i>Actualizar</button></div>
                    </div>
                    <div id="second-column">
                        <div>
                            <h2 for="description">Descripción:</h2>
                            <textarea id="description" name="description" rows="20" cols="100" placeholder="Escribe una descripción..."><?= $product['description'] ?> </textarea>
                        </div>
                        <div>
                            <div class="st2-form-group">
                                <h2 for="saga">Saga:</h2>
                                <select name="saga" id="saga">
                                    <?php
                                    $productSagas = Utils::getSagas();
                                    // Filtrar los datos para no que aparezcan duplicados por el inner join
                                    foreach ($productSagas as $saga) {
                                        echo "<option " . (($saga['id'] == $product['saga_id']) ? 'selected ' : '') . "value='" . $saga["id"] . "'>" . $saga["name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h2>Personaje/s:</h2>
                                <div id="characters-container">
                                   
                                        <?php
                                        
                                    
                                       
                                        function characterChecked($character, $product){
                                            $characters = Utils::getCharsByProduct($product['id']);
                                            if ($characters){
                                                foreach($characters as $item) {
                                                    if (in_array($character['id'],$item)){
                                                        return "checked ";
                                                    }
                                                }
                                            }
                                            
                                        }
                                       

                                        $characters = Utils::getCharactersById($product['saga_id']);
                                        if ($characters!=null){
                                            foreach ($characters as $character) {
                                                echo "
                                                <input type='checkbox'" . characterChecked($character,$product) . "id='{$character['id']}' value='{$character['id']}?>' name='characters[]'>
                                                <label for='{$character['name']}'>{$character['name']}</label>
                                                
                                                ";
                                            }
                                        }
                                        
                                        
                                        ?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>