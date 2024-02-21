<?php
class Saga  {
    private $id;
    private $name;
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
        $sql = "SELECT * FROM sagas ORDER BY name";

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
        $sql = "INSERT INTO sagas VALUES (null,'{$this->getName()}')";
        $result = $this->db->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(){
        $sql = "DELETE FROM sagas WHERE id={$this->id}";
        $result = $this->db->query($sql);
        if($result) return true; else return false;
    }
    public function edit(){
        $sql = "UPDATE sagas SET name='{$this->getName()}' WHERE id={$this->id}";
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