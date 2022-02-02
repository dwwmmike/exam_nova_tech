<?php

class AdminTypeModel extends Driver{

    public function getTypeComposant(){

        $sql = "SELECT * FROM type_composant ORDER BY id_type_composant DESC";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);

        $tabComposant = [];

        foreach($rows as $row){
            $composant = new TypeComposant();
            $composant->setIdTypeComposant($row->id_type_composant);
            $composant->setNomType($row->nom_type);
            array_push($tabComposant, $composant);
        }
        return $tabComposant;
    }
    public function getNameType($id_type_name){
        $sql = "SELECT * FROM type_composant WHERE id_type_composant = $id_type_name";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);

        $tabNameComposant = [];

        foreach($rows as $row){
            $nomComposant = new TypeComposant();
            $nomComposant->setIdTypeComposant($row->id_type_composant);
            $nomComposant->setNomType($row->nom_type);
            array_push($tabNameComposant, $nomComposant);
        }
        return $tabNameComposant;
    }

    public function updateTypeComposant(TypeComposant $updateTc){
            $sql = "UPDATE type_composant
                SET nom_type = :nom_type
                WHERE id_type_composant = :id_type_composant";

            $tabParams = [
                "nom_type"=>$updateTc->getNomType(),
                "id_type_composant" => $updateTc->getIdTypeComposant()
                        ];

        $result = $this -> getRequest($sql, $tabParams);
        return $result -> rowCount();
    }
    
    public function typeItem(TypeComposant $typeParam){

        $sql = "SELECT * FROM type_composant WHERE id_type_composant = :id";
        $result = $this -> getRequest($sql, ["id" => $typeParam->getIdTypeComposant()]);

        if($result -> rowCount() > 0){
            $typeRow = $result->fetch(PDO::FETCH_OBJ);

            $editType = new TypeComposant();
            $editType -> setIdTypeComposant($typeRow->id_type_composant);
            $editType -> setNomType($typeRow->nom_type);

            }  
            return $editType;
        }
        
        public function deleteType($id){
            $sql = "DELETE FROM type_composant WHERE id_type_composant = :id_type_composant";
            $result = $this -> getRequest($sql, ["id_type_composant" => $id]);
    
            $nb = $result -> rowCount();
            return $nb;
        }
        
        public function insertType(TypeComposant $typeComposant){
            $sql = "INSERT INTO type_composant(nom_type)
                    VALUES (:nom_type)";
           $tabParams = ["nom_type"=> $typeComposant->getNomType()
                        ];
            $result = $this -> getRequest($sql, $tabParams);
            return $result;
        }
}
