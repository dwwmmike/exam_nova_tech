<?php

class PublicModel extends Driver{

    public function getPcs($search = null){
        if(!empty($search)){
            $sql = "SELECT * FROM pc_gamer p
                WHERE nom LIKE :nom
                ORDER BY id_pc_gamer";

                $searchParams = [
                                    "nom" => "%$search%"
                                ];
                $result = $this->getRequest($sql, $searchParams);        
        }
        else
        {
            $sql = "SELECT * FROM pc_gamer p
                ORDER BY id_pc_gamer";
                $result = $this->getRequest($sql);
        } 
        $pc_gamers = $result->fetchAll(PDO::FETCH_OBJ);
        $tabPc = [];      
        foreach($pc_gamers as $pc_gamer){
            $pc = new Pc();
            $pc->setDate( $pc_gamer->date);
            $pc->setIdPcGamer( $pc_gamer->id_pc_gamer);
            $pc->setNom( $pc_gamer->nom);
            $pc->setPrix( $pc_gamer->prix);
            $pc->setDescription( $pc_gamer->description);
            $pc->setImage( $pc_gamer->image);
            $pc->setQuantite( $pc_gamer->quantite);
            array_push($tabPc, $pc);
        }
        

        if($result->rowCount() > 0){
            return $tabPc;
        }else{
            return "Not found";
        }
    }
    public function pcItem(Pc $pcParam){

        $sql = "SELECT * FROM pc_gamer WHERE id_pc_gamer = :id";
        $result = $this -> getRequest($sql, ["id" => $pcParam->getIdPcGamer()]);

        if($result -> rowCount() > 0){
            $PcRow = $result->fetch(PDO::FETCH_OBJ);

            $editPc = new Pc();
            $editPc -> setIdPcGamer($PcRow->id_pc_gamer);
            $editPc -> setNom($PcRow->nom);
            $editPc -> setPrix($PcRow->prix);
            $editPc -> setQuantite($PcRow->quantite);
            $editPc -> setDate($PcRow->date);
            $editPc -> setImage($PcRow->image);
            $editPc -> setDescription($PcRow->description);

            $sql_composants = "SELECT c.*, tc.nom_type composantNom FROM pc_gamer_comp pgc
            INNER JOIN composants c ON c.id_composant = pgc.id_composant 
            INNER JOIN type_composant tc ON tc.id_type_composant=c.id_type_composant
            WHERE pgc.id_pc_gamer = :id_pc_gamer";
            $result = $this -> getRequest($sql_composants, ["id_pc_gamer" => $pcParam->getIdPcGamer()]);

            if($result -> rowCount() > 0){
                foreach($result->fetchAll(PDO::FETCH_OBJ) as $composantRow) {
                    $composant = new Composant();
                    $composant->setIdComposant($composantRow->id_composant);
                    $composant->setNomComposant($composantRow->nom_composant);
                    $composant -> setPrix($composantRow->prix);
                    $composant -> setQuantite($composantRow->quantite);
                    $composant -> setImage($composantRow->image);
                    $composant -> setDescription($composantRow->description);
                    $composant->getTypeComposant()->setNomType($composantRow->composantNom);

                    $editPc->addComposant($composant);
                }
            } 
            
            return $editPc;
        }
    }
    public function getPcPortables($search = null){
        if(!empty($search)){
            $sql = "SELECT * FROM pc_portables p
                WHERE nom LIKE :nom
                ORDER BY p.id_pc_portable";

                $searchParams = [
                    "nom" => "%$search%"
                ];

                $result = $this->getRequest($sql, $searchParams);
               
        }else{
            $sql = "SELECT * FROM pc_portables p
                ORDER BY id_pc_portable";

                $result = $this->getRequest($sql);
        } 
        $pc_portables = $result->fetchAll(PDO::FETCH_OBJ);
        $tabPcPortable = [];      
        foreach($pc_portables as $pc_portable){
            $pcPortable = new PcPortable();
            $pcPortable->setDate( $pc_portable->date);
             $pcPortable->setIdPcPortable( $pc_portable->id_pc_portable);
             $pcPortable->setNom( $pc_portable->nom);
             $pcPortable->setPrix( $pc_portable->prix);
             $pcPortable->setDescription( $pc_portable->description);
             $pcPortable->setImage( $pc_portable->image);
             $pcPortable->setQuantite( $pc_portable->quantite);
            array_push($tabPcPortable, $pcPortable);
        }
        
        if($result->rowCount() > 0){
            return $tabPcPortable;
        }else{
            return "Not found";
        }
    }
    public function pcPortableItem(PcPortable $pcPortableParam){

        $sql = "SELECT * FROM pc_portables WHERE id_pc_portable = :id";
        $result = $this -> getRequest($sql, ["id" => $pcPortableParam->getIdPcPortable()]);

        if($result -> rowCount() > 0){
            $portableRow = $result->fetch(PDO::FETCH_OBJ);
            $editPortable = new PcPortable();
            $editPortable -> setIdPcPortable($portableRow->id_pc_portable);
            $editPortable -> setNom($portableRow->nom);
            $editPortable -> setPrix($portableRow->prix);
            $editPortable -> setQuantite($portableRow->quantite);
            $editPortable -> setDate($portableRow->date);
            $editPortable -> setImage($portableRow->image);
            $editPortable -> setDescription($portableRow->description);
            
        }
        return $editPortable;
    }
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
?>