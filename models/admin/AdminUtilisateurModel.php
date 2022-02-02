<?php

class AdminUtilisateurModel extends Driver{

    public function getUsers($search = null){
        if(!empty($search)){
        $sql ="SELECT * FROM utilisateurs u
        INNER JOIN statut s
        ON u.id_statut = s.id_statut
        WHERE s.nom_statut LIKE :nom_statut
        OR u.nom LIKE :nom
        OR u.prenom LIKE :prenom
        ORDER BY u.id_statut";

        $searchParams = [
            "nom_statut" => "%$search%",
            "nom" => "%$search%",
            "prenom" => "%$search%"
        ];

        $result = $this->getRequest($sql,$searchParams);
        
        }
        else{
            $sql ="SELECT * FROM utilisateurs u
                    INNER JOIN statut s
                    ON u.id_statut = s.id_statut
                    ORDER BY u.id_utilisateur";
            $result = $this->getRequest($sql);
        }

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabUser = [];

        foreach($rows as $row){
            $user = new Utilisateur();
            $user->setIdUtilisateur($row->id_utilisateur);
            $user->setNom($row->nom);
            $user->setPrenom($row->prenom);
            $user->setLogin($row->login);
            $user->setEmail($row->email);
            $user->setPassword($row->password);
            $user->getStatut()->setIdStatut($row->id_statut);
            $user->getStatut()->setNomStatut($row->nom_statut);
            array_push($tabUser,$user);
        }

        if($result->rowCount() > 0){
            return $tabUser;
        }
        else{
            return "Not found";
        }
    }

    

    public function register(Utilisateur $user){
        $sql = "SELECT * FROM utilisateurs
                WHERE  email = :email";
        $result = $this -> getRequest($sql, ["email" => $user -> getEmail()]);
        if($result -> rowCount() == 0){
            $req = "INSERT INTO utilisateurs(nom, prenom, login, email, password, statut, id_statut)
                    VALUES (:nom, :prenom , :login, :email, :password, :statut, :id_statut)";
            $tabUser = ["nom"=>$user->getNom(), "prenom"=>$user->getPrenom(), "login"=>$user->getLogin(), "email"=>$user->getEmail(), "password"=>$user->getPassword(), "statut"=>$user->getStatut(), "id_statut"=>$user->getStatut()->getIdStatut()];
            $res = $this -> getRequest($req, $tabUser);
            return $res;
        }else{
            return "Cette utilisateur existe déjà";}
    }

    public function insertUser(Utilisateur $utilisateur){
        $sql = "INSERT INTO utilisateurs(nom, prenom, login, email, password, id_statut)
                VALUES (:nom, :prenom, :login, :email, :password, :id_statut)";
        
        $tabParams = ["nom"=>$utilisateur->getNom(),
                    "prenom"=>$utilisateur->getPrenom(),
                    "login"=>$utilisateur->getLogin(),
                    "email"=>$utilisateur->getEmail(),
                    "password"=>$utilisateur->getPassword(),
                    "id_statut"=>$utilisateur->getStatut()->getIdStatut(),
                ];
                    
        $result = $this -> getRequest($sql, $tabParams);
        return $result;
    }

    public function signIn($login, $password){
        $sql = "SELECT * FROM utilisateurs
                WHERE (login = :login OR email = :login) AND password = :password";
        $result = $this -> getRequest($sql, ["login" => $login, "password" => $password]);
        
        $row = $result -> fetch(PDO::FETCH_OBJ);

        return $row;
    }

    public function deleteUser($id){
        $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $result = $this -> getRequest($sql, ["id_utilisateur" => $id]);
        $nb = $result -> rowCount();
        return $nb;
    }
}
?>