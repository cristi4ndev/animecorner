<div id="shopping-cart-content">

    <?php
    if (isset($_SESSION['cart'])) {
        require_once 'views/shopping-cart/shopping-list.php';
    } else {
        echo "<h1>Su carrito se encuentra vacío, <strong>¡añade algunos productos!</strong></h1>";
    }
    ?>

</div>