<div id="categories-container">
    <div>
        <h1>Transportistas</h1>
    </div>

    <div id="categories-list">

        <?php


        if ($all_carriers) {
            echo " 
                        <div class='table-container'>
                            <div class='table-headings'>
                                <div class='table-heading'>id</div>
                                <div class='table-heading'>Nombre </div>
                                <div class='table-heading'>Precio</div>
                                <div class='table-heading'>Acción</div>
                            </div>
                    ";
            foreach ($all_carriers as $carrier) {
                

                echo "                 
                            <div class='table-rows'> 
                                <div class='table-cell'>{$carrier['id']}</div>
                                <div class='table-cell'> {$carrier['name']} </div>
                                <div class='table-cell'> {$carrier['price']} </div>
                                <div class='table-cell'> 
                                    <a href='" . base_url . "admin/delete&id={$carrier['id']}&entity=carrier'>
                                        <button class='delete-button'><i class='fa-solid fa-trash'></i></button> 
                                    </a>

                            ";
                


                echo " </div> ";
                require 'views/admin/modify-block.php';
                echo " </div> ";
            }
        } else {
            echo "<p style='text-align:center'>Todavía no hay transportis, <strong>¡Empieza creando uno!</strong></p>";
        }
        ?>

    </div>
 
</div>