<?php

class Category
{
    private $id;
    private $name;
    private $parent;
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

    public function createCategory()
    {
        $sql = "INSERT INTO categories VALUES (null,'{$this->getName()}','{$this->getParent()}')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(){
        $sql = "DELETE FROM categories WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if($result) return true; else return false;
    }
    public function edit(){
        $sql = "UPDATE categories SET name='{$this->getName()}' ,parent='{$this->getParent()}' WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if($result) return true; else return false;
    }

    // Función para mantener la integridad de la base de datos. Si se quiere eliminar una categoría con subcategorías, estas se setean a "Inicio"
    public function setParentCategory(){
        $sql = "UPDATE categories SET parent=1 WHERE parent={$this->getParent()}";
        $result = $this->db->query($sql);
        if($result) return true; else return false;
    }
}
