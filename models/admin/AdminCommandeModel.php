<?php

Class AdminCommandeModel extends Driver
{
    private $apm;
    private $acompm;
    private $appm;
    private $aam;
    private $acm;

    public function __construct()
    {
        $this->apm = new AdminPcModel();
        $this->acompm = new AdminComposantModel();
        $this->appm = new AdminPcPortableModel();
        $this->aam = new AdminAdresseModel();
        $this->acm = new AdminClientModel();
    }

    public function getCommandes($client = null, $search = null) {
        if(!empty($search)){

            $searchParams = [
                "reference" => "%$search%"
            ];

            $sql = "SELECT * FROM commandes c
            WHERE reference LIKE :reference";

            if(!is_null($client) && $client instanceof Client) {
                $sql .= ' AND id_client = :id_client';
                $searchParams['id_client'] = $client->getIdClient();
            }

            $sql .= " ORDER BY id_commande";

            $result = $this->getRequest($sql, $searchParams);
               
        }else{
            $searchParams = [];

            $sql = "SELECT * FROM commandes c";
            
            if(!is_null($client) && $client instanceof Client) {
                $sql .= ' WHERE id_client = :id_client';
                $searchParams['id_client'] = $client->getIdClient();
            }
            $sql .= " ORDER BY id_commande";

            $result = $this->getRequest($sql, $searchParams);
        } 

        $commandes = $result->fetchAll(PDO::FETCH_OBJ);
        $tabCommandes = [];      
        foreach($commandes as $commande){

            $com = new Commande();
            $com->setIdCommande( $commande->id_commande);
            $com = $this->itemCommande($com);

            array_push($tabCommandes, $com);
        }

        if(!empty($tabCommandes)){
            return $tabCommandes;
        }else{
            return "Not found";
        }
    }


    public function itemCommande(Commande $commande)
    {
        $sql = "SELECT * FROM commandes WHERE id_commande = :id_commande";
        $result = $this->getRequest($sql, ['id_commande' => $commande->getIdCommande()]);

        if($result->rowCount() > 0){

            $commande = $result->fetch(PDO::FETCH_OBJ);

            $com = new Commande();
            $com->setIdCommande( $commande->id_commande);
            $com->setReference( $commande->reference);
            $com->setPoids( $commande->poids);
            $com->setTotal( $commande->total);
            

            $client = new Client();
            $client->setIdClient($commande->id_client);
            $client = $this->acm->itemClient($client);
            $com->setClient($client);

            $adresse = new Adresse();
            $adresse->setIdAdresse($commande->id_adresse);
            $adresse = $this->aam->itemAdresse($adresse);
            $com->setAdresse($adresse);

            // Pcs de la commande
            $sqlPc = "SELECT * FROM commandes_pc_gamer
            WHERE id_commande = :id_commande";
            $result = $this->getRequest($sqlPc, ['id_commande' => $commande->id_commande]);

            $commandesPcs = $result->fetchAll(PDO::FETCH_OBJ);
            foreach( $commandesPcs as $commandePc) {
                $pc = new Pc();
                $pc->setIdPcGamer($commandePc->id_pc_gamer);
                $pc = $this->apm->pcItem($pc);

                $comPc = new CommandePcGamer();
                $comPc->setCommande($com);
                $comPc->setPcGamer($pc);

                $com->addCommandePcGamer($comPc);
            }

            // Pcs portables de la commande
            $sqlPc = "SELECT * FROM commandes_pc_portables
            WHERE id_commande = :id_commande";
            $result = $this->getRequest($sqlPc, ['id_commande' => $commande->id_commande]);

            $commandesPcsPortables = $result->fetchAll(PDO::FETCH_OBJ);
            foreach( $commandesPcsPortables as $commandePcP) {
                $pcP = new PcPortable();
                $pcP->setIdPcPortable($commandePcP->id_pc_portable);
                $pcP = $this->appm->pcPortableItem($pcP);

                $comPcP = new CommandePcPortable();
                $comPcP->setCommande($com);
                $comPcP->setPcPortable($pcP);

                $com->addCommandePcPortable($comPcP);
            }

            // Composantq de la commande
            $sqlPc = "SELECT * FROM commandes_composants
            WHERE id_commande = :id_commande";
            $result = $this->getRequest($sqlPc, ['id_commande' => $commande->id_commande]);

            $commandesComposants = $result->fetchAll(PDO::FETCH_OBJ);
            foreach( $commandesComposants as $commandeComp) {
                $c = new Composant();
                $c->setIdComposant($commandeComp->id_composant);
                $c = $this->acompm->composantItem($c);

                $comC = new CommandeComposant();
                $comC->setCommande($com);
                $comC->setcomposant($c);

                $com->addCommandeComposant($comC);
            }

            return $com;
        }else{
            return "Not found";
        }
    }

}