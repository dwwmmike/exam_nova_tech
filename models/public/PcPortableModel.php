<?php
class PcPortableModel extends Driver{

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
    
}
?>