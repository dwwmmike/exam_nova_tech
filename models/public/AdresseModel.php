<?php

class AdresseModel extends Driver
{
    private $acm;

    public function __construct()
    {
        $this->acm = new ClientModel();
    }

    public function ajoutAdresse(Adresse $adresse)
    {

        $req = "INSERT INTO adresses(rue, complement, code_postal, ville, id_client)
                     VALUES (:rue, :complement, :code_postal, :ville, :id_client)";
        $tabUser = [
            "rue" => $adresse->getRue(),
            "complement" => $adresse->getComplement(),
            "code_postal" => $adresse->getCodePostal(),
            "ville" => $adresse->getVille(),
            "id_client" => $adresse->getClient()->getIdClient()
        ];

        $res = $this->getRequest($req, $tabUser);
        return $res;
    }

    public function getAjoutAdresseId()
    {
        return $this->lastId();
    }

    public function getAdresse($ajoutAdresseId)
    {

        $sql = "SELECT * FROM adresses
                    WHERE id_adresse = :id_adresse";
        $result = $this->getRequest($sql, ["id_adresse" => $ajoutAdresseId]);

        $row = $result->fetch(PDO::FETCH_OBJ);

        return $row;
    }

    public function itemAdresse(Adresse $adresse)
    {
        $sql = "SELECT * FROM adresses a
        INNER JOIN client c ON a.id_client=c.id_client
        WHERE id_adresse = :id_adresse";
        $result = $this->getRequest($sql, ['id_adresse' => $adresse->getIdAdresse()]);


        if ($result->rowCount() > 0) {

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
        } else {
            return "Not found";
        }
    }

    public function getAdresses($idClient)
    {

        $searchParams['id_client'] = $idClient;

        $sql = "SELECT * FROM adresses a
         WHERE id_client = :id_client";

        $result = $this->getRequest($sql, $searchParams);

        $adressess = $result->fetchAll(PDO::FETCH_OBJ);
        $tabAdresses = [];
        foreach ($adressess as $adresse) {

            $add = new Adresse();
            $add->setIdAdresse($adresse->id_adresse);
            $add = $this->itemAdresse($add);

            array_push($tabAdresses, $add);
        }

        if (!empty($tabAdresses)) {
            return $tabAdresses;
        } else {
            return "Not found";
        }
    }

}

?>