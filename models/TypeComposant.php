<?php

class TypeComposant{
    private $id_type_composant;
    private $nom_type;

    /**
     * Get the value of id_type_composant
     */
    public function getIdTypeComposant()
    {
        return $this->id_type_composant;
    }

    /**
     * Set the value of id_type_composant
     */
    public function setIdTypeComposant($id_type_composant): self
    {
        $this->id_type_composant = $id_type_composant;

        return $this;
    }



    /**
     * Get the value of nom_type
     */
    public function getNomType()
    {
        return $this->nom_type;
    }

    /**
     * Set the value of nom_type
     */
    public function setNomType($nom_type): self
    {
        $this->nom_type = $nom_type;

        return $this;
    }
}