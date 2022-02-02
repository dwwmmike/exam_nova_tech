<?php

Class Adresse
{
    private $id_adresse; 
    private $rue; 
    private $ville; 
    private $complement; 
    private $code_postal;
    private $client; 

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Get the value of id_adresse
     */
    public function getIdAdresse()
    {
        return $this->id_adresse;
    }

    /**
     * Set the value of id_adresse
     */
    public function setIdAdresse($id_adresse): self
    {
        $this->id_adresse = $id_adresse;

        return $this;
    }

    /**
     * Get the value of rue
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set the value of rue
     */
    public function setRue($rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get the value of ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     */
    public function setVille($ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of complement
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set the value of complement
     */
    public function setComplement($complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get the value of code_postal
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * Set the value of code_postal
     */
    public function setCodePostal($code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    /**
     * Get the value of client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the value of client
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}