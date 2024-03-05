<?php ob_start();?>
<nav id="navbar">
    <ul id="categories-nav-list" class="flex-list">
        <?php
        require_once 'helpers/Utils.php';
        $categories = Utils::getMenu();
        if ($categories) {
            foreach ($categories as $menu_item) {
                echo "<li><a href='". base_url . "category/&id=" .  $menu_item['id'] . "'>" . $menu_item['name']. "</a></li>";
                echo "<li><i class='fa-solid fa-heart'></i></li>";
            }
        } else {
            echo "Empiece asignando categorías al menú en el panel de administrador";
        }
        ?>
    </ul>
    

</nav>
<div id="sagas-nav-list">

        <div id="sagas">SAGAS</div>

        <div class="carousel">
            
            <div class="carousel-slide">
                <?php
                require_once 'helpers/Utils.php';
                $sagas = Utils::getSagas();
                if ($sagas) {
                    foreach ($sagas as $saga) {
                        echo "<a href='" . base_url . "saga/&id={$saga['id']}'><div>{$saga['name']}</div></a>";
                    }
                } else {
                    echo "Empiece asignando sagas al menú en el panel de administrador";
                }
                ?>
            </div>
            <div class="carousel-slide">
                <?php
                require_once 'helpers/Utils.php';
                $sagas = Utils::getSagas();
                if ($sagas) {
                    foreach ($sagas as $saga) {
                        echo "<a href='" . base_url . "saga/&id={$saga['id']}'><div>{$saga['name']}</div></a>";
                    }
                } else {
                    echo "Empiece asignando sagas al menú en el panel de administrador";
                }
                ?>
            </div>
            

        </div>

    </div>
<div id="content">