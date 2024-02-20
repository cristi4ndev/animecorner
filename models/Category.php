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

    public static function printCategories($categories, $parent_id = 1, $level = 0) {
        echo "<ul class='level-$level'>";
        foreach ($categories as $category) {
            if ($category['parent'] == $parent_id) {
                echo "<li>{$category['name']}</li>";
                Category::printCategories($categories, $category['id'], $level + 1);
            }
        }
        echo "</ul>";
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
}
