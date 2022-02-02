<?php

Class Client 
{
    private $id_client;
    private $age;
    private $nom;
    private $prenom;
    private $email;
    private $login;
    private $password;


    /**
     * Get the value of id_clent
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of id_clent
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of id_clent
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of id_clent
     */
    public function setLogin($login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of id_clent
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * Set the value of id_clent
     */
    public function setIdClient($id_client): self
    {
        $this->id_client = $id_client;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     */
    public function setAge($age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     */
    public function setNom($nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     */
    public function setPrenom($prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }
}