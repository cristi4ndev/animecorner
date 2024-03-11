<?php

require_once 'models/Order.php';
require_once 'helpers/Utils.php';

class OrderController
{
    public function create()
    {
        require_once 'models/Order.php';
        require_once 'models/OrderProduct.php';
        try {
            //Creamos el pedido        
            $order_model = new Order();
            $order_model->setTotal(ShoppingCartController::total())
                ->setUserId($_SESSION['user']['id'])
                ->setCarrierId($_POST['carrier'])
                ->setPaymentMethod($_POST['payment-method'])
                ->setAddressId($_POST['address']);
            $order_create = $order_model->create();

            //Creamos las relaciones de los productos con el pedido
            if ($order_create) {
                //Deserializamos los productos que nos llegan por post para poder usarlos
                $products = unserialize(base64_decode($_POST['cart']));

                $op_model = new OrderProduct();
                foreach ($products as $product) {
                    $op_model->setProductId($product['id'])
                        ->setOrderId($order_model
                            ->getLastInsertedId())
                        ->setQuantity($product['quantity'])
                        ->setSubtotal($product['subtotal']);
                    $create_relations = $op_model->create();
                }
            } else echo "Error en la creación del pedido";
            Utils::deleteSession('cart');
            header("Location: " . base_url . "order/complete");
        } catch (\Throwable $th) {
            throw $th;
            header("Location: " . base_url . "shoppingcart/checkout");
        }
    }

    public function complete() {
        require_once 'views/order/complete.php';
    }
    
}
