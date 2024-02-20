<div id="account-content">
    <?php require_once 'views/admin/category-block.php' ?>

    <div id="main-content-account">
        <div class='table-container'>
            <div class='table-headings'>
                <div class='table-heading'>id</div>
                <div class='table-heading'>Nombre</div>
                <div class='table-heading'>Apellidos</div>
                <div class='table-heading'>DNI</div>
            </div>

            <?php
            foreach ($user_list as $user) {
                echo "                 
                        <div class='table-rows'> 
                            <div class='table-cell'>{$user['id']}</div>
                            <div class='table-cell'>{$user['name']}</div>
                            <div class='table-cell'>{$user['surname']}</div>
                            <div class='table-cell'>{$user['dni']}</div>
                        </div>            
                    ";
            }

            ?>


        </div>
    </div>
</div>