<?php

Class CommandeComposant
{
    private $commande;
    private $composant;

    public function __construct()
    {
        $this->commande = new Commande();
        $this->composant = new Composant();
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
     * Get the value of composant
     */
    public function getComposant()
    {
        return $this->composant;
    }

    /**
     * Set the value of composant
     */
    public function setComposant($composant): self
    {
        $this->composant = $composant;

        return $this;
    }
}