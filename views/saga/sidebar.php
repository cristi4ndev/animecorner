<aside id="sidebar">
    <?php if (!$products) {
        echo "<h1>" . Utils::getSagaById($_GET['id']) . "</h1>";
    } else echo "<h1>" . $products[0]['saga_name'] . "</h1>";
    ?>


    <h3>Filtrar por Personaje</h3>
    <ul id="category-block">
        <?php

        if ($saga_characters) {
            // Array para almacenar categorías únicas
            $unique_chars = array();

            // Iterar sobre los productos para construir el array de categorías únicas
            foreach ($saga_characters as $product) {
                $char_id = $product['character_id'];
                $char_name = $product['character_name'];
                // Verificar si la categoría ya está en el array único
                if (!isset($unique_cats[$char_id])) {
                    // Si no está, agregarla con su nombre y su ID correspondiente
                    $unique_chars[$char_id] = $char_name;
                }
            }

            // Iterar sobre el array de categorías únicas para generar la lista de enlaces
            foreach ($unique_chars as $char_id => $char_name) {
                echo "<li><a href='" . base_url . "saga/&id=" . $_GET['id'] . "&character=" . $char_id . "'>" . $char_name . "</a></li>";
            }
        } else echo "No existen personajes para filtrar"

        ?>
    </ul>
    <h3>Filtrar por Categoría</h3>
    <ul id="category-block">
        <?php

        if ($saga_categories) {
            // Array para almacenar categorías únicas
            $unique_cats = array();

            // Iterar sobre los productos para construir el array de categorías únicas
            foreach ($saga_categories as $product) {
                $cat_id = $product['category_id'];
                $cat_name = $product['cat_name'];
                // Verificar si la categoría ya está en el array único
                if (!isset($unique_cats[$cat_id])) {
                    // Si no está, agregarla con su nombre y su ID correspondiente
                    $unique_cats[$cat_id] = $cat_name;
                }
            }

            // Iterar sobre el array de categorías únicas para generar la lista de enlaces
            foreach ($unique_cats as $cat_id => $cat_name) {
                echo "<li><a href='" . base_url . "saga/&id=" . $_GET['id'] . "&category=" . $cat_id . "'>" . $cat_name . "</a></li>";
            }
        }else echo "No existen categorías para filtrar";

        ?>
    </ul>
</aside>