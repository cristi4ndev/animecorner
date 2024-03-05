<aside id="sidebar">
    <?php if (!$products) {
        echo "<h1>" . Utils::getCategoryById($_GET['id']) . "</h1>";
    } else echo "<h1>" . $products[0]['cat_name'] . "</h1>";
    ?>
    <h3>Filtrar por Saga</h3>
    <ul id="category-block">
        <?php

        if ($category_sagas) {
            // Array para almacenar categorías únicas
            $unique_sagas = array();

            // Iterar sobre los productos para construir el array de categorías únicas
            foreach ($category_sagas as $product) {
                $saga_id = $product['saga_id'];
                $saga_name = $product['saga_name'];
                // Verificar si la categoría ya está en el array único
                if (!isset($unique_sagas[$saga_id])) {
                    // Si no está, agregarla con su nombre y su ID correspondiente
                    $unique_sagas[$saga_id] = $saga_name;
                }
            }

            // Iterar sobre el array de categorías únicas para generar la lista de enlaces
            foreach ($unique_sagas as $saga_id => $saga_name) {
                echo "<li><a href='" . base_url . "category/&id=" . $_GET['id'] . "&saga=" . $saga_id . "'>" . $saga_name . "</a></li>";
            }
        } else echo "No existen sagas para filtrar";

        ?>
    </ul>

    <h3>Filtrar por Personaje</h3>
    <ul id="category-block">
        <?php

        if ($category_characters) {
            // Array para almacenar categorías únicas
            $unique_chars = array();

            // Iterar sobre los productos para construir el array de categorías únicas
            foreach ($category_characters as $product) {
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
                echo "<li><a href='" . base_url . "category/&id=" . $_GET['id'] . "&character=" . $char_id . "'>" . $char_name . "</a></li>";
            }
        } else echo "No existen personajes para filtrar"

        ?>
    </ul>

</aside>