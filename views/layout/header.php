<div id="main-container">
    <?php require_once 'views/layout/before.php'; ?>
    <header id="header">
        <div id="logo-div">
            <a href="<?= base_url ?>"><img id="logo" src="<?= base_url ?>/uploads/images/logo-ninja-3.png"></a>
            
        </div>
        
        <div class="search-bar">
            <form method="POST" action="<?=base_url?>search/query">
                <div><input name="query" id="query" type="search" placeholder="Realiza tu búsqueda..."></div>
                <div> <button type="submit" id="search-button"><i class="fa-solid fa-magnifying-glass"></i></div>
            </form>
        </div>
        <div id="user-panel">


            <?php
            if (isset($_SESSION['logged']) && $_SESSION['logged'] == true && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') {
                echo "<a href='" . base_url . "admin/'>
                                <div class='flex'>
                                    <div class='icon-container-up'><i class='icon-up fa-solid fa-wrench'></i></div>
                                    <span>Administración</span>
                                </div>
                        </a>";
            } else echo "<a href='" . base_url . "user/'>
                                <div class='flex'>
                                <div class='icon-container-up'><i class='icon-up fa-solid fa-user'></i></div>
                                    <span>Mi cuenta</span>
                                </div>
                            </a>";
            ?>




            <a href="<?= base_url ?>shoppingcart/">
                <div class="flex" style="position: relative;">
                    <div class="icon-container-up" style="position: relative;">

                        <i class="icon-up fa-solid fa-cart-shopping"></i>
                        <?php

                        

                        if (isset($_SESSION['cart'])) {
                            // Sacar el número de productos del carrito e imprimirlo
                            
                            echo "<div id='cart-icon-div'><span>"
                                . ShoppingCartController::productsCount() .
                                "</span></div>";
                        }
                        ?>
                    </div>

                    <span>
                        Carrito
                    </span>
                </div>

            </a>




            <a href='" . base_url . "admin/'>
                <div class='flex'>
                    <div class='icon-container-up'><i class="icon-up fa-solid fa-message"></i></div>
                    <span>Contacto</span>
                </div>
            </a>


    </header>