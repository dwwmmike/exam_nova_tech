<?php

class ComposantModel extends Driver{

    public function getComponents($search=null){
        if(!empty($search)){
            $sql ="SELECT * FROM composants c
            INNER JOIN type_composant tc
            ON c.id_type_composant = tc.id_type_composant
            WHERE tc.nom_type LIKE :nom_type
            OR c.nom_composant LIKE :nom_composant
            ORDER BY c.id_type_composant";

            $searchParams = [
                "nom_type" => "%$search%",
                "nom_composant" => "%$search%"
            ];
        $result = $this->getRequest($sql,$searchParams);
        }
        else{
            $sql ="SELECT * FROM composants c
            INNER JOIN type_composant tc
            ON c.id_type_composant = tc.id_type_composant
            ORDER BY c.id_type_composant";
            $result = $this->getRequest($sql);
        }
        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabComp = [];

        foreach($rows as $row){
            $comp = new Composant();
            $comp->setIdComposant($row->id_composant);
            $comp->setNomComposant($row->nom_composant);
            $comp->setDescription($row->description);
            $comp->setPrix($row->prix);
            $comp->setImage($row->image);
            $comp->setQuantite($row->quantite);
            $comp->getTypeComposant()->setIdTypeComposant($row->id_type_composant);
            $comp->getTypeComposant()->setNomType($row->nom_type);
            array_push($tabComp,$comp);
        }
        
        if($result->rowCount() > 0){
            return $tabComp;
        }else{
            return "Not found";
        }
    }
    
    public function getTypeComponent($type_id){

        $sql ="SELECT * FROM composants c
        WHERE c.id_type_composant = $type_id";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabComp = [];

        foreach($rows as $row){
            $comp = new Composant();
            $comp->setIdComposant($row->id_composant);
            $comp->setNomComposant($row->nom_composant);
            $comp->setDescription($row->description);
            $comp->setPrix($row->prix);
            $comp->setImage($row->image);
            $comp->getTypeComposant()->setIdTypeComposant($row->id_type_composant);
            $comp->getTypeComposant()->setNomType($row->nom_type);
            $comp->setQuantite($row->quantite);
            array_push($tabComp,$comp);
        }
            return $tabComp;
    }
    
    public function composantItem(Composant $compParam){

        $sql = "SELECT * FROM composants WHERE id_composant = :id";
        $result = $this -> getRequest($sql, ["id" => $compParam->getIdComposant()]);

        if($result -> rowCount() > 0){
            $compRow = $result->fetch(PDO::FETCH_OBJ);
            $editComp = new Composant();
            $editComp -> setIdComposant($compRow->id_composant);
            $editComp -> setNomComposant($compRow->nom_composant);
            $editComp -> setPrix($compRow->prix);
            $editComp -> setQuantite($compRow->quantite);
            $editComp -> setImage($compRow->image);
            $editComp -> setDescription($compRow->description);
            
        }
        return $editComp;
    }
    
}