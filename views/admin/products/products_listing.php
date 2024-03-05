<div id="categories-list">

    <?php


    if ($products) {
        echo " 
                        <div class='table-container'>
                            <div class='table-headings'>
                            <div class='table-heading table-id'>id</div>
                            <div class='table-heading table-image'>Imagen</div>
                            <div class='table-heading table-name'>Nombre</div>
                            <div class='table-heading table-price'>Precio</div>
                            <div class='table-heading table-stock'>Stock</div>
                            <div class='table-heading table-category'>Categoría</div>
                            <div class='table-heading table-saga'>Saga</div>
                            <div class='table-heading table-action'>Acción</div>
                        </div>
                    ";
        foreach ($products as $product) {
            

            echo "                 
                            <div class='table-rows'> 
                                <div class='table-cell table-id'>{$product['id']}</div>
                                <div class='table-cell table-image'><img src=". base_url . "uploads/images/products/" .$product['image']."></div>
                                <div class='table-cell table-name'>{$product['name']}</div>
                                <div class='table-cell table-price'>{$product['price']}</div>
                                <div class='table-cell table-stock'>{$product['stock']}</div>
                                <div class='table-cell table-category'>{$product['category_name']}</div>
                                <div class='table-cell table-saga'>{$product['saga_name']}</div>
                                <div class='table-cell table-action'> 
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