<?php
class PcPortable{
   private $id_pc_portable;
   private $nom;
   private $description;  
   private $date;  
   private $prix; 
   private $image;
   private $quantite;


   /**
    * Get the value of id_pc_gamer
    */
   public function getIdPcPortable()
   {
      return $this->id_pc_portable;
   }

   /**
    * Set the value of id_pc_gamer
    */
   public function setIdPcPortable($id_pc_portable): self
   {
      $this->id_pc_portable= $id_pc_portable;

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
    * Get the value of date
    */
   public function getDate()
   {
      return $this->date;
   }

   /**
    * Set the value of date
    */
   public function setDate($date): self
   {
      $this->date = $date;

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
}