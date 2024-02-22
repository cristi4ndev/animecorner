<nav id="navbar">
    <ul id="categories-nav-list" class="flex-list">
        <?php
        require_once 'helpers/Utils.php';
        $categories = Utils::getMenu();
        if ($categories) {
            foreach ($categories as $menu_item) {
                echo "<li>{$menu_item['name']}</li>";
                echo "<li><i class='fa-solid fa-heart'></i></li>";
            }
        } else {
            echo "Empiece asignando categorías al menú en el panel de administrador";
        }
        ?>
    </ul>
    <div id="sagas-nav-list" class="flex-list" onmouseover="stopCarousel()" onmouseout="startCarousel()">
        <div id="sagas">SAGAS</div>
        <div class="carousel">
            <ul class="slide">
                <?php
                require_once 'helpers/Utils.php';
                $sagas = Utils::getSagas();
                if ($sagas) {
                    foreach ($sagas as $saga) {
                        echo "<li>{$saga['name']}</li>";
                    }
                    
                } else {
                    echo "Empiece asignando categorías al menú en el panel de administrador";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div id="content">
