<?php

Class ComposantPcGamer
{
    private $composant;
    private $pc_gamer;

    public function __construct()
    {
        $this->composant = new Composant();
        $this->pc_gamer = new Pc();
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