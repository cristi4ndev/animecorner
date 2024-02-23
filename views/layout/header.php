<div id="main-container">
<?php require_once 'views/layout/before.php'; ?>
<header id="header">
        <a href="<?=base_url?>"><img id="logo" src="<?=base_url?>/uploads/images/animecornerlogo.png"></a>
        <div class="search-bar">
            <form>
                <div><input type="search" placeholder="Realiza tu búsqueda..."></div>
                <div id="search-button"><i class="fa-solid fa-magnifying-glass"></i></div>
            </form>
        </div>
        <div id="user-panel">
            <ul class="flex-list">
           
            <?php 
            if (isset($_SESSION['logged']) && $_SESSION['logged'] == true && isset($_SESSION['user']['role']) && $_SESSION['user']['role']=='admin') {
                echo "<a href='" . base_url . "admin/'><li><i class='fa-solid fa-wrench'></i>Administración</li></a>";

            } else echo "<a href='" . base_url . "user/'><li><i class='fa-solid fa-user'></i>Mi cuenta</li></a>";
            ?>
                <li><i class="fa-solid fa-cart-shopping"></i>Carrito</li>
                <li><i class="fa-solid fa-message"></i></i>Contacto</li>
            </ul>
        </div>
    </header>
    