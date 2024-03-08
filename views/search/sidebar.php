<aside id="sidebar">
   
    <h1>Buscador</h1>
    <h1>Sagas</h1>
    <ul id="category-block">
        <?php

        if ($products) {
            // Array para almacenar categorías únicas
            $unique_sagas = array();

            // Iterar sobre los productos para construir el array de categorías únicas
            foreach ($products as $product) {
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
                echo "<li><a href='" . base_url . "saga/&id=" . $saga_id . "'>" . $saga_name . "</a></li>";
            }
        } else echo "No existen sagas para filtrar";

        ?>
    </ul>

    <h3>Personajes</h3>
    <ul id="category-block">
        <?php

        if ($products) {
            // Array para almacenar categorías únicas
            $unique_chars = array();

            // Iterar sobre los productos para construir el array de categorías únicas
            foreach ($products as $product) {
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
                echo "<li><a href='" . base_url . "saga/&id=" . $char_id . "&character=" . $char_id . "'>" . $char_name . "</a></li>";
            }
        } else echo "No existen personajes para filtrar"

        ?>
    </ul>

</aside>