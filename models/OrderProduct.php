<?php

class OrderProduct
{
    private $product_id;
    private $order_id;
    private $quantity;
    private $subtotal;
   
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }



       public function getAll()
    {
        $sql = "SELECT op.*, p.name as name, p.ref as ref, p.image as image, p.price as price FROM order_products op
        INNER JOIN products p ON op.product_id = p.id WHERE order_id={$this->getOrderId()}";

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $categories = array();
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }

            return $categories;
        } else {
            return false;
        }
    }



    // CRUD

    public function create()
    {
        $sql = "INSERT INTO order_products VALUES ('{$this->getProductId()}','{$this->getOrderId()}',{$this->getQuantity()},{$this->getSubtotal()})";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    

   

   

    /**
     * Get the value of product_id
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     */
    public function setProductId($product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of order_id
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Set the value of order_id
     */
    public function setOrderId($order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     */
    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of subtotal
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set the value of subtotal
     */
    public function setSubtotal($subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

  
}
