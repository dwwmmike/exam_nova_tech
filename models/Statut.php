<?php

Class Statut{
    private $id_statut;
    private $nom_statut;


    /**
     * Get the value of id_statut
     */
    public function getIdStatut()
    {
        return $this->id_statut;
    }

    /**
     * Set the value of id_statut
     */
    public function setIdStatut($id_statut): self
    {
        $this->id_statut = $id_statut;

        return $this;
    }

    /**
     * Get the value of nom_statut
     */
    public function getNomStatut()
    {
        return $this->nom_statut;
    }

    /**
     * Set the value of nom_statut
     */
    public function setNomStatut($nom_statut): self
    {
        $this->nom_statut = $nom_statut;

        return $this;
    }
}