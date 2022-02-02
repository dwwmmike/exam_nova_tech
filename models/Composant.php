<?php

Class Composant
{
    private $id_composant;
    private $nom_composant;
    private $description;    
    private $type_composant; 
    private $image;
    private $quantite;
    private $prix;
    
    public function __construct(){
        
        $this -> type_composant = new TypeComposant();
    }
    
    /**
     * Get the value of id_composant
     */
    public function getIdComposant()
    {
        return $this->id_composant;
    }

    /**
     * Set the value of id_composant
     */
    public function setIdComposant($id_composant): self
    {
        $this->id_composant = $id_composant;

        return $this;
    }


    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of type_composant
     */
    public function getTypeComposant()
    {
        return $this->type_composant;
    }

    /**
     * Set the value of type_composant
     */
    public function setTypeComposant($type_composant): self
    {
        $this->type_composant = $type_composant;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of quantite
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     */
    public function setQuantite($quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get the value of prix
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     */
    public function setPrix($prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of nom_composant
     */
    public function getNomComposant()
    {
        return $this->nom_composant;
    }

    /**
     * Set the value of nom_composant
     */
    public function setNomComposant($nom_composant): self
    {
        $this->nom_composant = $nom_composant;

        return $this;
    }
    public function addType(TypeComposant $typeComposant): self
   {
      $this->typeComposant[] = $typeComposant;

      return $this;
   }
}