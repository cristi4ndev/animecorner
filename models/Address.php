<?php

class Address
{
    private $id;
    private $alias;
    private $country;
    private $province;
    private $postal_code;
    private $locality;
    private $address;
    private $phone;
    private $user_id;
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
     * Get the value of alias
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set the value of alias
     */
    public function setAlias($alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     */
    public function setCountry($country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of province
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set the value of province
     */
    public function setProvince($province): self
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get the value of postal_code
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set the value of postal_code
     */
    public function setPostalCode($postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * Get the value of locality
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set the value of locality
     */
    public function setLocality($locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     */
    public function setAddress($address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     */
    public function setPhone($phone): self
    {
        $this->phone = $phone;

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



    public function create()
    {

        $sql = "INSERT INTO addresses VALUES (null,'{$this->getAlias()}','{$this->getCountry()}','{$this->getProvince()}','{$this->getPostalCode()}','{$this->getLocality()}','{$this->getAddress()}','{$this->getPhone()}','{$this->getUserId()}')";
        $creation = $this->db->query($sql);
        return $creation;
    }
    public function update()
    {
        $sql = "UPDATE addresses SET alias ='{$this->getAlias()}', country = '{$this->getCountry()}', province = '{$this->getProvince()}', postal_code = '{$this->getPostalCode()}', locality = '{$this->getLocality()}', address = '{$this->getAddress()}', phone = '{$this->getPhone()}' WHERE id='{$this->getId()}'";

        $creation = $this->db->query($sql);
        return $creation;
    }

    public function delete() {
        $sql = "UPDATE addresses SET deleted = 1 WHERE id = '{$this->getId()}'";
        $delete = $this->db->query($sql);
        return $delete;
    }
    

    public function getAll()
    {

        $sql = "SELECT * FROM addresses WHERE user_id = '{$this->getUserId()}' AND deleted = 0";
        $result = $this->db->query($sql);

        $addresses = array(); // Array para almacenar todas las direcciones

        // Verifica si hay resultados
        if ($result->num_rows > 0) {
            // Recorre todas las filas de resultados
            while ($row = $result->fetch_assoc()) {
                // Agrega cada fila al array de direcciones
                $addresses[] = $row;
            }
        }

        return $addresses; // Retorna todas las direcciones
    }
}
