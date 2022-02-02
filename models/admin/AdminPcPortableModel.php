<?php
class AdminPcPortableModel extends Driver{

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

    public function insertPcP(PcPortable $pc_portable){
        $sql = "INSERT INTO pc_portables(nom, prix, date, description,image, quantite)
                VALUES (:nom, :prix, :date,  :description,:image, :quantite)";
       $tabParams = ["nom"=> $pc_portable->getNom(),
                    "prix"=> $pc_portable->getPrix(),
                    "date"=> $pc_portable->getDate(),
                    "quantite"=> $pc_portable->getQuantite(),
                    "image"=> $pc_portable->getImage(),
                    "description"=> $pc_portable->getDescription(),
                    ];
        $result = $this -> getRequest($sql, $tabParams);
        return $result;
    }

    public function deletePcPortable($id){
        $sql = "DELETE FROM pc_portables WHERE id_pc_portable = :id_pc_portable";
        $result = $this -> getRequest($sql, ["id_pc_portable" => $id]);

        $nb = $result -> rowCount();
        return $nb;
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

    public function updatePortable(PcPortable $updatePortable){
        if($updatePortable -> getImage() === ""){
            $sql = "UPDATE pc_portables
                SET nom = :nom, prix = :prix, date = :date, quantite = :quantite, description = :description
                WHERE id_pc_portable = :id_pc_portable";

            $tabParams = ["nom"=>$updatePortable->getNom(),
                            "prix"=>$updatePortable->getPrix(),
                            "date"=>$updatePortable->getDate(),
                            "quantite"=>$updatePortable->getQuantite(),
                            "description"=>$updatePortable->getDescription(),
                            "id_pc_portable"=>$updatePortable->getIdPcPortable()];

        }else{
            $sql = "UPDATE pc_portables
                SET nom = :nom, prix = :prix, date = :date, quantite = :quantite, image = :image, description = :description
                WHERE id_pc_portable = :id_pc_portable";

            $tabParams = ["nom"=>$updatePortable->getNom(),
                            "prix"=>$updatePortable->getPrix(),
                            "date"=>$updatePortable->getDate(),
                            "quantite"=>$updatePortable->getQuantite(),
                            "image"=>$updatePortable->getImage(),
                            "description"=>$updatePortable->getDescription(),
                            "id_pc_portable"=>$updatePortable->getIdPcPortable()];
        }
        $result = $this -> getRequest($sql, $tabParams);
        return $result -> rowCount();
    }
    
}
?>