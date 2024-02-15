
<?php require_once 'views/layout/before.php'; ?>
<header id="header">
        <a href="<?=base_url?>"><img id="logo" src="<?=base_url?>/uploads/images/animecornerlogo.png"></a>
        <div class="search-bar">
            <form>
                <div><input type="search" placeholder="Realiza tu búsqueda..."></div>
                <div><button><i class="fas fa-search"></i></button> </div>
            </form>
        </div>
        <div id="user-panel">
            <ul class="flex-list">
            <a href="<?=base_url?>user/"><li><i class="fa-solid fa-user"></i>Mi cuenta</li></a>
                <li><i class="fa-solid fa-cart-shopping"></i>Carrito</li>
                <li><i class="fa-solid fa-message"></i></i>Contacto</li>
            </ul>
        </div>
    </header>
    