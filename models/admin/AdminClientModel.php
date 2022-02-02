<?php

Class AdminClientModel extends Driver
{

    public function getClients() {
        $sql = "SELECT * FROM client";
        $result = $this->getRequest($sql);
        
        if($result->rowCount() > 0){

            $clients = $result->fetchAll(PDO::FETCH_OBJ);
            $tabClients = [];
            foreach($clients as $cli) {

                $client = new Client();
                
                $client->setIdClient($cli->id_client);
                $client->setNom($cli->nom);
                $client->setPrenom($cli->prenom);
                $client->setAge($cli->age);
                $client->setEmail($cli->email);

                $tabClients[] = $client;
            }
          
            return $tabClients;
        }else{
            return "Not found";
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