<?php

Class CommandePcPortable
{
    private $commande;
    private $pc_portable;

    public function __construct()
    {
        $this->commande = new Commande();
        $this->pc_portable = new PcPortable();
    }

    /**
     * Get the value of commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set the value of commande
     */
    public function setCommande($commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get the value of pc_portable
     */
    public function getPcPortable()
    {
        return $this->pc_portable;
    }

    /**
     * Set the value of pc_portable
     */
    public function setPcPortable($pc_portable): self
    {
        $this->pc_portable = $pc_portable;

        return $this;
    }
}