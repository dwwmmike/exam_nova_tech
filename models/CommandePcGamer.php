<?php

Class CommandePcGamer
{
    private $commande;
    private $pc_gamer;

    public function __construct()
    {
        $this->commande = new Commande();
        $this->pc_gamer = new Pc();
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
     * Get the value of pc_gamer
     */
    public function getPcGamer()
    {
        return $this->pc_gamer;
    }

    /**
     * Set the value of pc_gamer
     */
    public function setPcGamer($pc_gamer): self
    {
        $this->pc_gamer = $pc_gamer;

        return $this;
    }
}