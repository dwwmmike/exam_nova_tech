<?php

Class AdminAdresseModel extends Driver 
{
    private $acm;

    public function __construct()
    {
        $this->acm = new AdminClientModel();
    }

    public function getAdresses($client = null)
    {
        $searchParams = [];

        $sql = "SELECT * FROM adresses a 
        INNER JOIN client c ON a.id_client=c.id_client";
        
        if(!is_null($client) && $client instanceof Client) {
            $sql .= ' WHERE a.id_client = :id_client';
            $searchParams['id_client'] = $client->getIdClient();
        }

        $result = $this->getRequest($sql, $searchParams);
        
        if($result->rowCount() > 0){

            $adresses = $result->fetchAll(PDO::FETCH_OBJ);
            $tabAdresses = [];
            foreach($adresses as $adr) {
                $adresse = new Adresse();
                $adresse->setIdAdresse($adr->id_adresse);
                $adresse->setRue($adr->rue);
                $adresse->setVille($adr->ville);
                $adresse->setComplement($adr->complement);
                $adresse->setCodePostal($adr->code_postal);
                
                $client = new Client();
                $client->setIdClient($adr->id_client);
                $client = $this->acm->itemClient($client);

                $adresse->setClient($client);

                $tabAdresses[] = $adresse;
            }
          
            return $tabAdresses;
        }else{
            return "Not found";
        }
    }

    public function itemAdresse(Adresse $adresse) 
    {
        $sql = "SELECT * FROM adresses a
        INNER JOIN client c ON a.id_client=c.id_client
        WHERE id_adresse = :id_adresse";
        $result = $this->getRequest($sql, ['id_adresse' => $adresse->getIdAdresse()]);

        
        if($result->rowCount() > 0){

            $adr = $result->fetch(PDO::FETCH_OBJ);
            
            $adresse->setRue($adr->rue);
            $adresse->setVille($adr->ville);
            $adresse->setComplement($adr->complement);
            $adresse->setCodePostal($adr->code_postal);

            $client = new Client();
            $client->setIdClient($adr->id_client);
            $client = $this->acm->itemClient($client);

            $adresse->setClient($client);
          
            return $adresse;
        }else{
            return "Not found";
        }
    }
}