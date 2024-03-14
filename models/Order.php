<?php

class Order
{
    private $id;
    private $total;
    private $created_at;
    private $user_id;
    private $carrier_id;
    private $payment_method;
    private $status;
    private $address_id;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

     /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal($total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of carrier_id
     */
    public function getCarrierId()
    {
        return $this->carrier_id;
    }

    /**
     * Set the value of carrier_id
     */
    public function setCarrierId($carrier_id): self
    {
        $this->carrier_id = $carrier_id;

        return $this;
    }

    /**
     * Get the value of vat
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * Set the value of vat
     */
    public function setPaymentMethod($payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    /**
     * Get the value of address_id
     */
    public function getAddressId()
    {
        return $this->address_id;
    }

    /**
     * Set the value of address_id
     */
    public function setAddressId($address_id): self
    {
        $this->address_id = $address_id;

        return $this;
    }


    


    public function getOne()
    {
        $sql = "SELECT o.*,  u.name as user_name, u.surname as user_surname, u.email as user_email, u.dni as user_dni, c.name as carrier_name, c.price as carrier_price, a.alias, a.country, a.province, a.postal_code, a.locality, a.address, a.phone,  
        (SELECT SUM(quantity) AS numero_de_productos FROM order_products WHERE order_id = o.id) AS prods, 
        (SELECT SUM(subtotal) AS total_de_productos FROM order_products WHERE order_id = o.id) AS total_prods 
        FROM orders o 
        INNER JOIN carriers c ON o.carrier_id = c.id 
        INNER JOIN addresses a ON o.address_id = a.id 
        INNER JOIN users u ON o.user_id = u.id         
        WHERE o.id = {$this->getId()} ORDER BY o.id DESC;";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    public function getAllByUser()
    {
        $sql = "SELECT o.*,  u.name as user_name, u.email as user_email, u.dni as user_dni, c.name as carrier_name, a.alias, a.country, a.province, a.postal_code, a.locality, a.address, a.phone,  
        (SELECT SUM(quantity) AS numero_de_productos FROM order_products WHERE order_id = o.id) AS prods 
        FROM orders o 
        INNER JOIN carriers c ON o.carrier_id = c.id 
        INNER JOIN users u ON o.user_id = u.id 
        INNER JOIN addresses a ON o.address_id = a.id        
        WHERE o.user_id = {$this->getUserId()} ORDER BY o.id DESC;";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows > 0) {
            $orders = array();
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }

            return $orders;
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT o.*,  c.name as carrier_name, a.alias, a.country, a.province, a.postal_code, a.locality, a.address, a.phone,  
        (SELECT SUM(quantity) AS numero_de_productos FROM order_products WHERE order_id = o.id) AS prods 
        FROM orders o 
        INNER JOIN carriers c ON o.carrier_id = c.id 
        INNER JOIN addresses a ON o.address_id = a.id        
         ORDER BY o.id DESC";

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $orders = array();
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }

            return $orders;
        } else {
            return false;
        }
    }



    // CRUD

    public function create()
    {
        
        $sql = "INSERT INTO orders VALUES (null,'{$this->getTotal()}',CURRENT_TIMESTAMP(),{$this->getUserId()}, {$this->getCarrierId()}, '{$this->getPaymentMethod()}', 'pedido confirmado', {$this->getAddressId()})";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getLastInsertedId()
    {
        $sql = "SELECT LAST_INSERT_ID() as last_id";
        $result = $this->db->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['last_id'];
        } else {
            return false;
        }
    }
    public function editStatus()
    {
        $sql = "UPDATE orders SET status = '{$this->getStatus()}' WHERE id = '{$this->getId()}'";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    

   

   

   
}
