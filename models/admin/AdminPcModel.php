<?php

class AdminPcModel extends Driver{

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

    public function insertPc(Pc $pc_gamer){
        $sql = "INSERT INTO pc_gamer(nom, prix, date, description,image, quantite)
                VALUES (:nom, :prix, :date,  :description,:image, :quantite)";
       $tabParams = ["nom"=> $pc_gamer->getNom(),
                    "prix"=> $pc_gamer->getPrix(),
                    "date"=> $pc_gamer->getDate(),
                    "quantite"=> $pc_gamer->getQuantite(),
                    "image"=> $pc_gamer->getImage(),
                    "description"=> $pc_gamer->getDescription(),
                    ];
       
        $result = $this -> getRequest($sql, $tabParams);
        return $result;
    }

    public function deletePc($id){
        $sql = "DELETE FROM pc_gamer WHERE id_pc_gamer = :id_pc_gamer";
        $result = $this -> getRequest($sql, ["id_pc_gamer" => $id]);

        $nb = $result -> rowCount();
        return $nb;
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

    public function addPcComponents(ComposantPcGamer $updatePcComponent){
        $sql="INSERT IGNORE INTO pc_gamer_comp (id_pc_gamer, id_composant) 
        VALUES(:id_pc_gamer, :id_composant)";

        $paramsPcComponent = [
            "id_pc_gamer" => $updatePcComponent->getPcGamer()->getIdPcGamer(),
            "id_composant" => $updatePcComponent->getComposant()->getIdComposant(),
        ];
        
        $result = $this -> getRequest($sql, $paramsPcComponent);
        return $result -> rowCount();
    }

    public function deletePcComponents(ComposantPcGamer $updatePcComponent){
        $sql="DELETE FROM pc_gamer_comp 
        WHERE id_pc_gamer = :id_pc_gamer AND id_composant = :id_composant";

        $paramsPcComponent = [
            "id_pc_gamer" => $updatePcComponent->getPcGamer()->getIdPcGamer(),
            "id_composant" => $updatePcComponent->getComposant()->getIdComposant(),
        ];
        
        $result = $this -> getRequest($sql, $paramsPcComponent);
        return $result -> rowCount();
    }

    public function updatePc(Pc $updatePc){
        if($updatePc -> getImage() === ""){
            $sql = "UPDATE pc_gamer
                SET nom = :nom, prix = :prix, date = :date, quantite = :quantite, description = :description
                WHERE id_pc_gamer = :id_pc_gamer";

            $tabParams = ["nom"=>$updatePc->getNom(),
                            "prix"=>$updatePc->getPrix(),
                            "date"=>$updatePc->getDate(),
                            "quantite"=>$updatePc->getQuantite(),
                            "description"=>$updatePc->getDescription(),
                            "id_pc_gamer"=>$updatePc->getIdPcGamer()];

        }else{
            $sql = "UPDATE pc_gamer
                SET nom = :nom, prix = :prix, date = :date, quantite = :quantite, image = :image, description = :description
                WHERE id_pc_gamer = :id_pc_gamer";

            $tabParams = ["nom"=>$updatePc->getNom(),
                            "prix"=>$updatePc->getPrix(),
                            "date"=>$updatePc->getDate(),
                            "quantite"=>$updatePc->getQuantite(),
                            "image"=>$updatePc->getImage(),
                            "description"=>$updatePc->getDescription(),
                            "id_pc_gamer"=>$updatePc->getIdPcGamer()];
        }

        $result = $this -> getRequest($sql, $tabParams);
        return $result -> rowCount();
    }
}
?>