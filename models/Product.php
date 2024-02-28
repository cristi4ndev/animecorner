<?php

class Product
{
    private $id;
    private $image;
    private $stock;
    private $price;
    private $created_at;
    private $name;
    private $description;
    private $category_id;
    private $saga_id;
    private $deleted;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
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
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     */
    public function setStock($stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price): self
    {
        $this->price = $price;

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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     */
    public function setCategoryId($category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of saga_id
     */
    public function getSagaId()
    {
        return $this->saga_id;
    }

    /**
     * Set the value of saga_id
     */
    public function setSagaId($saga_id): self
    {
        $this->saga_id = $saga_id;

        return $this;
    }

    /**
     * Get the value of deleted
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set the value of deleted
     */
    public function setDeleted($deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getOne()
    {
        $sql = "SELECT * FROM products WHERE id={$this->getId()}";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT products.*, categories.name AS category_name, sagas.name AS saga_name FROM products JOIN categories ON products.category_id = categories.id JOIN sagas ON products.saga_id = sagas.id WHERE deleted=0";

        // Agregar condiciones de filtrado si se proporcionan category_name y/o saga_name
        if ($this->getCategoryId()) {
            $sql .= " AND category_id = '{$this->getCategoryId()}'";
        }
        if ($this->getSagaId()) {
            $sql .= " AND saga_id = '{$this->getSagaId()}'";
        }
        

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $products = array();
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }

            return $products;
        } else {
            return false;
        }
    }

    public function create()
    {
        $sql = "INSERT INTO products 
        VALUES (null,'{$this->getImage()}','{$this->getStock()}','{$this->getPrice()}',CURRENT_TIMESTAMP(),'{$this->getName()}','{$this->getDescription()}','{$this->getCategoryId()}','{$this->getSagaId()}',0)";
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

    public function delete()
    {
        $sql = "DELETE FROM products WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if ($result) return true;
        else return false;
    }
    public function edit()
    {
        $sql = "UPDATE products SETimage='{$this->getImage()}', stock='{$this->getStock()}',price='{$this->getPrice()}',name='{$this->getName()}',description='{$this->getDescription()}',category_id='{$this->getCategoryId()}',saga_id='{$this->getSagaId()}',0 WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if ($result) return true;
        else return false;
    }
}
