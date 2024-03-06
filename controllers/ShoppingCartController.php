<?php

require_once 'models/ShoppingCart.php';

class ShoppingCartController
{
    public function index()
    {

        require_once 'views/shopping-cart/index.php';
    }
    public function add()
    {
        // Ver si $_SESSION['cart'] está definido
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Verificar si el producto ya está en el carrito
        $id = $_GET['id'];
        if (isset($_SESSION['cart'][$id])) {
            // Incrementar la cantidad
            $_SESSION['cart'][$id]['quantity'] += 1;
            $_SESSION['cart'][$id]['subtotal'] =  $_SESSION['cart'][$id]['quantity'] *  $_SESSION['cart'][$id]['price'];
        } else {
            // Si no lo está, agregar un nuevo elemento al carrito
            $_SESSION['cart'][$id] = array(
                'image' => $_GET['image'],
                'ref' => $_GET['ref'],
                'quantity' => 1,
                'price' => $_GET['price'],
                'name' => $_GET['name'],
                'subtotal' => $_GET['price']
            );
        }
    }
    public function remove()
    {

        // Verificar si el producto ya está en el carrito
        $id = $_GET['id'];
        if (isset($_SESSION['cart'][$id])) {
            // Decrementar la cantidad
            $_SESSION['cart'][$id]['quantity'] -= 1;
            $_SESSION['cart'][$id]['subtotal'] =  $_SESSION['cart'][$id]['quantity'] *  $_SESSION['cart'][$id]['price'];
        }
    }

    public function delete()
    {
        // Ver si $_SESSION['cart'] está definido
        if (isset($_SESSION['cart'])) {
            Utils::deleteSession('cart');
        }
        
    }
}
