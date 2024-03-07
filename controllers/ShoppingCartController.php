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
            $_SESSION['cart'][$id]['subtotal'] =  number_format($_SESSION['cart'][$id]['quantity'] *  $_SESSION['cart'][$id]['price'],2);
        } else {
            // Si no lo está, agregar un nuevo elemento al carrito
            $_SESSION['cart'][$id] = array(
                'id' => $id,
                'image' => $_GET['image'],
                'ref' => $_GET['ref'],
                'quantity' => 1,
                'price' => $_GET['price'],
                'name' => $_GET['name'],
                'subtotal' => $_GET['price']
            );
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    public function remove()
    {

        // Verificar si el producto ya está en el carrito
        $id = $_GET['id'];
        if (isset($_SESSION['cart'][$id])) {
            if ($_SESSION['cart'][$id]['quantity'] == 1) {
                unset($_SESSION['cart'][$_GET['id']]);
                if (empty($_SESSION['cart'])) {
                    Utils::deleteSession('cart');
                }
            } else {
                // Decrementar la cantidad
                $_SESSION['cart'][$id]['quantity'] -= 1;
                $_SESSION['cart'][$id]['subtotal'] =  number_format($_SESSION['cart'][$id]['quantity'] *  $_SESSION['cart'][$id]['price'],2);
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function delete()
    {
        // Ver si nos llega un id de producto
        if (isset($_GET['id'])) {
            unset($_SESSION['cart'][$_GET['id']]);
            if (empty($_SESSION['cart'])) {
                Utils::deleteSession('cart');
            }
        } else {
            // Ver si $_SESSION['cart'] está definido
            if (isset($_SESSION['cart'])) {
                Utils::deleteSession('cart');
            }
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    static function total() {
        $total = 0;
        foreach ($_SESSION['cart'] as $products) {
            $total += $products['quantity'] * $products['price'];
        }

        return number_format($total,2);
    }
    static function productsCount() {
        $count = 0;
        foreach ($_SESSION['cart'] as $products) {
            $count += $products['quantity'];
        }

        return $count;
    }
}
