<?php

class Commande
{
    private $id_commande;  
    private $reference;  
    private $poids;  
    private $total;  
    private $client;  
    private $adresse;
    private $commande_pc_gamers;
    private $commande_pc_portables;
    private $commande_composants;

    public function __construct()
    {
        $this->client = new Client();
        $this->adresse = new Adresse();
        $this->commande_pc_gamers = [];
        $this->commande_pc_portables = [];
        $this->commande_composants = [];
    }

    /**
     * Get the value of id_commande
     */
    public function getIdCommande()
    {
        return $this->id_commande;
    }

    /**
     * Set the value of id_commande
     */
    public function setIdCommande($id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    /**
     * Get the value of reference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set the value of reference
     */
    public function setReference($reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get the value of poids
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set the value of poids
     */
    public function setPoids($poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     */
    public function setTotal($total): self
    {
        $this->total = $total;

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

    /**
     * Get the value of adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     */
    public function setAdresse(Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of pc_gamers
     */
    public function getCommandePcGamers()
    {
        return $this->commande_pc_gamers;
    }

    /**
     * Set the value of pc_gamers
     */
    public function setCommandePcGamers($commande_pc_gamers): self
    {
        $this->commande_pc_gamers = $commande_pc_gamers;

        return $this;
    }

    public function addCommandePcGamer(CommandePcGamer $commande_pc_gamers) {
        $this->commande_pc_gamers[] = $commande_pc_gamers;
    }

    /**
     * Get the value of composants
     */
    public function getCommandeComposants()
    {
        return $this->commande_composants;
    }

    /**
     * Set the value of composants
     */
    public function setCommandeComposants($commande_composants): self
    {
        $this->commande_composants = $commande_composants;

        return $this;
    }

    public function addCommandeComposant(CommandeComposant $commande_composants) {
        $this->commande_composants[] = $commande_composants;
    }
    
    /**
     * Get the value of pc_portables
     */
    public function getCommandePcPortables()
    {
        return $this->commande_pc_portables;
    }

    /**
     * Set the value of pc_portables
     */
    public function setCommandePcPortables($commande_pc_portables): self
    {
        $this->commande_pc_portables = $commande_pc_portables;

        return $this;
    }

    public function addCommandePcPortable(CommandePcPortable $commande_pc_portable) {
        $this->commande_pc_portables[] = $commande_pc_portable;
    }
}