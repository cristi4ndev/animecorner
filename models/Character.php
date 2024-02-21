<?php
class Character  {
    private $id;
    private $name;
    private $saga_id;
    private $db;
    
    public function __construct() {
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


    public function getOne()
    {
        $sql = "SELECT * FROM sagas WHERE id={$this->getId()}";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM characters ORDER BY name";

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $sagas = array();
            while ($row = $result->fetch_assoc()) {
                $sagas[] = $row;
            }

            return $sagas;
        } else {
            return false;
        }
    }

    


    

    public function create()
    {
        $sql = "INSERT INTO characters VALUES (null,'{$this->getName()}','{$this->getSagaId()}')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(){
        $sql = "DELETE FROM characters WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if($result) return true; else return false;
    }
    public function edit(){
        $sql = "UPDATE characters SET name='{$this->getName()}', saga_id='{$this->getSagaId()}' WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if($result) return true; else return false;
    }

    // Función para mantener la integridad de la base de datos. 
    // Si se quiere eliminar una saga con productos relacionados, estas se setean a null
    /*public function resetProductSaga(){
        $sql = "UPDATE sagas SET parent=1 WHERE parent={$this->()}";
        $result = $this->db->query($sql);
        if($result) return true; else return false;
    }*/
  

 
}