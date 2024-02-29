<div id="categories-list">

    <?php


    if ($products) {
        echo " 
                        <div class='table-container'>
                            <div class='table-headings'>
                            <div class='table-heading'>id</div>
                            <div class='table-heading'>Imagen</div>
                            <div class='table-heading'>Nombre</div>
                            <div class='table-heading'>Precio</div>
                            <div class='table-heading'>Stock</div>
                            <div class='table-heading'>Categoría</div>
                            <div class='table-heading'>Saga</div>
                            <div class='table-heading'>Acción</div>
                        </div>
                    ";
        foreach ($products as $product) {
            

            echo "                 
                            <div class='table-rows'> 
                                <div class='table-cell'>{$product['id']}</div>
                                <div class='table-cell'><img src=".$product['image']."></div>
                                <div class='table-cell'>{$product['name']}</div>
                                <div class='table-cell'>{$product['price']}</div>
                                <div class='table-cell'>{$product['stock']}</div>
                                <div class='table-cell'>{$product['category_name']}</div>
                                <div class='table-cell'>{$product['saga_name']}</div>
                                <div class='table-cell'> 
                                    <a href='" . base_url . "admin/edit_product&id={$product['id']}'>
                                        <button class='edit-button'><i class='fa-solid fa-pen-to-square'></i></button> 
                                    </a>
                                    <a href='" . base_url . "admin/delete&id={$product['id']}&entity=product'>
                                        <button class='delete-button'><i class='fa-solid fa-trash'></i></button> 
                                    </a>
                                

                            ";
           


            echo " </div> ";
            require 'views/admin/modify-block.php';
            echo " </div> ";
        }
    } else {
        echo "<p style='text-align:center'>Todavía no hay productos para los fitros introducidos, <strong>¡Empieza creando uno!</strong></p>";
    }
    ?>

</div>