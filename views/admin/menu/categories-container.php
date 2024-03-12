<div id="categories-container">
    <div>
        <h1>Menú</h1>
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
                                    <a href='" . base_url . "admin/edit&id={$category['id']}&menu=0&entity=menu'>
                                        <button class='delete-button'><i class='fa-solid fa-trash'></i></button> 
                                    </a>

                            ";
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                }


                echo " </div> ";
                require 'views/admin/modify-block.php';
                echo " </div> ";
            }
        } else {
            echo "<p style='text-align:center'>Todavía no hay subcategorías para esta categoría, <strong>¡Empieza creando una!</strong></p>";
        }
        ?>

    </div>
</div>