<aside id="sidebar">
    <h1><?=$products[0]['saga_name']?></h1>
    <ul id="category-block">
        <?php
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
        ?>
    </ul>
</aside>
