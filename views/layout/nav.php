<nav id="navbar">
    <ul id="categories-nav-list" class="flex-list">
    <?php
        require_once 'helpers/Utils.php';
        $categories = Utils::getMenu();
        if ($categories) {
            foreach ( $categories as $menu_item) {
                echo "<li>{$menu_item['name']}</li>";
                echo "<li><i class='fa-solid fa-heart'></i></li>";
            }
        }else {
            echo "Empiece asignando categorías al menú en el panel de administrador";
        }
        
    ?>

    </ul>
    <ul id="sagas-nav-list" class="flex-list">
        
        <li id="sagas">SAGAS</li>
        
        
        
    </ul>


</nav>
<div id="content">