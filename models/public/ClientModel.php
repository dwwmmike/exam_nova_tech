<?php

class ClientModel extends Driver
{

    public function signInU($login, $password)
    {
        $sql = "SELECT * FROM client
                    WHERE (login = :login OR email = :login) AND password = :password";
        $result = $this->getRequest($sql, ["login" => $login, "password" => $password]);

        $row = $result->fetch(PDO::FETCH_OBJ);

        return $row;
    }

    public function register(Client $cli)
    {
        $sql = "SELECT * FROM client
                 WHERE  email = :email";
        $result = $this->getRequest($sql, ["email" => $cli->getEmail()]);
        if ($result->rowCount() == 0) {
            $req = "INSERT INTO client(nom, prenom, login, email, password, age)
                     VALUES (:nom, :prenom , :login, :email, :password, :age)";
            $tabUser = [
                "nom" => $cli->getNom(),
                "prenom" => $cli->getPrenom(),
                "login" => $cli->getLogin(),
                "email" => $cli->getEmail(),
                "password" => $cli->getPassword(),
                "age" => $cli->getAge()];
            $res = $this->getRequest($req, $tabUser);
            return $res;
        } else {
            return "Cette utilisateur existe déjà";
        }
    }
    
    public function itemClient(Client $client)
    {
        $sql = "SELECT * FROM client WHERE id_client = :id_client";
        $result = $this->getRequest($sql, ['id_client' => $client->getIdClient()]);


        if($result->rowCount() > 0){

            $cli = $result->fetch(PDO::FETCH_OBJ);

            $client->setNom($cli->nom);
            $client->setPrenom($cli->prenom);
            $client->setAge($cli->age);
            $client->setEmail($cli->email);

            return $client;
        }else{
            return "Not found";
        }
    }

}

?>