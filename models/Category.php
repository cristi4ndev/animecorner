<?php

class Category
{
    private $id;
    private $name;
    private $parent;
    private $menu;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }



    /**
     * Get the value of parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the value of parent
     */
    public function setParent($parent): self
    {
        $this->parent = $parent;

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
     * Get the value of menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set the value of menu
     */
    public function setMenu($menu): self
    {
        $this->menu = $menu;

        return $this;
    }


    public function getOne()
    {
        $sql = "SELECT * FROM categories WHERE id={$this->getId()}";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categories ORDER BY name";

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


    public function getCategories()
    {
        $sql = "SELECT * FROM categories WHERE parent={$this->getParent()}";

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


    // Metodo para devolver el listado de productos
    public function getProducts()
    {
        $sql = "SELECT p.*, cat.name as cat_name, s.name as saga_name FROM products p 
    JOIN categories cat ON p.category_id = cat.id 
    JOIN sagas s ON p.saga_id = s.id 
    where p.category_id = {$this->getId()} and p.deleted=0";

        if (isset($_GET['character'])) {
            $sql =  "SELECT p.*, cat.name as cat_name, s.name as saga_name, pc.character_id as character_id, c.name as character_name FROM products p 
        JOIN categories cat ON p.category_id = cat.id 
        JOIN sagas s ON p.saga_id = s.id 
        JOIN product_characters pc ON p.id = pc.product_id 
        JOIN characters c ON pc.character_id = c.id 
        where p.category_id = {$this->getId()} and p.deleted=0 and pc.character_id={$_GET['character']}";
        }

        if (isset($_GET['saga'])) {
            $sql .=  " and p.saga_id={$_GET['saga']}";
        }

        $sql .=  " ORDER BY p.id DESC";
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
    // Metodo para devolver el listado de sagas base según productos de una saga
    public function getBaseSagas()
    {
        $sql = "SELECT p.*, cat.name as cat_name, s.name as saga_name 
    FROM products p 
    JOIN categories cat ON p.category_id = cat.id JOIN sagas s ON p.saga_id = s.id 
    where p.category_id = {$this->getId()} and p.deleted=0";



        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $base_categories = array();
            while ($row = $result->fetch_assoc()) {
                $base_categories[] = $row;
            }

            return $base_categories;
        } else {
            return false;
        }
    }
    // Metodo para devolver el listado de personajes base según productos de una saga
    public function getBaseCharacters()
    {
        $sql = "SELECT p.*, cat.name as cat_name, s.name as saga_name, pc.character_id as character_id, c.name as character_name FROM products p 
    JOIN categories cat ON p.category_id = cat.id 
    JOIN sagas s ON p.saga_id = s.id 
    JOIN product_characters pc ON p.id = pc.product_id 
    JOIN characters c ON pc.character_id = c.id 
    where p.category_id = {$this->getId()} and p.deleted=0";



        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $base_characters = array();
            while ($row = $result->fetch_assoc()) {
                $base_characters[] = $row;
            }

            return $base_characters;
        } else {
            return false;
        }
    }

    

    // CRUD

    public function createCategory()
    {
        $sql = "INSERT INTO categories VALUES (null,'{$this->getName()}','{$this->getParent()}',0)";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM categories WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if ($result) return true;
        else return false;
    }
    public function edit()
    {
        $sql = "UPDATE categories SET name='{$this->getName()}' ,parent='{$this->getParent()}' WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if ($result) return true;
        else return false;
    }
    public function editMenu()
    {
        $sql = "UPDATE categories SET menu='{$this->getMenu()}' WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if ($result) return true;
        else return false;
    }

    // Función para mantener la integridad de la base de datos. Si se quiere eliminar una categoría con subcategorías, estas se setean a "Inicio"
    public function setParentCategory()
    {
        $sql = "UPDATE categories SET parent=1 WHERE parent={$this->getParent()}";
        $result = $this->db->query($sql);
        if ($result) return true;
        else return false;
    }
}
