<?php

class Search
{
    private $query;
    
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }


  

    public function search()
    {
     
        $sql =  "SELECT p.*, cat.name as cat_name, s.name as saga_name, pc.character_id as character_id, c.name as character_name FROM products p 
        JOIN categories cat ON p.category_id = cat.id 
        JOIN sagas s ON p.saga_id = s.id 
        JOIN product_characters pc ON p.id = pc.product_id 
        JOIN characters c ON pc.character_id = c.id 
        where (p.name LIKE '%{$this->getQuery()}%' OR s.name LIKE '%{$this->getQuery()}%' OR c.name LIKE '%{$this->getQuery()}%') AND p.deleted = 0 GROUP BY p.id";
        

       
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

    
   

    /**
     * Get the value of query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set the value of query
     */
    public function setQuery($query): self
    {
        $this->query = $query;

        return $this;
    }
}
