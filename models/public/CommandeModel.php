<?php

class CommandeModel extends Driver
{

    private $apm;
    private $aam;
    private $acm;
    private $appm;
    private $acompm;

    public function __construct()
    {
        $this->apm = new PcModel();
        $this->aam = new AdresseModel();
        $this->acm = new ClientModel();
        $this->appm = new PcPortableModel();
        $this->acompm = new ComposantModel();
    }

    public function createOrder($idClient, $idAdresse, $produits, $montant)
    {

        // GET LAST COMMANDE ID
        $sqlRef = "SELECT id_commande FROM commandes ORDER BY id_commande DESC LIMIT 1";
        $resultRef = $this -> getRequest($sqlRef);
        $lastCommande = $resultRef->fetch(PDO::FETCH_OBJ);

        $sql = "INSERT INTO commandes ( reference, poids, total, id_client, id_adresse)
             VALUES (:reference, :poids, :total, :id_client, :id_adresse)";

        $newRef = (int) date('Ymd') . ($lastCommande ? $lastCommande->id_commande + 1 : 1);

        $paramsCommande = [
             "reference" => $newRef,
             "poids" => '4.3',
             "total" => $montant,
             "id_client" => $idClient,
             "id_adresse" =>  $idAdresse
        ];

        $result = $this -> getRequest($sql, $paramsCommande);
        $commandeId = $this->lastId();

         if($result -> rowCount() > 0) {

            foreach ($produits as $type => $listproduit) {
                foreach ($listproduit as $produit) {
                    switch ($type) {
                        case 'gamer':
                            $sql = "INSERT INTO commandes_pc_gamer ( id_commande, id_pc_gamer) 
                                VALUES (:id_commande, :id_pc_gamer)";

                            $paramsCommande = [
                                "id_commande" => $commandeId,
                                "id_pc_gamer" => $produit->getIdPcGamer(),
                            ];

                            $res = $this->getRequest($sql, $paramsCommande);
                            break;
                        case 'portable':
                            $sql = "INSERT INTO commandes_pc_portables ( id_commande, id_pc_portable) 
                            VALUES (:id_commande, :id_pc_portable)";

                            $paramsCommande = [
                                "id_commande" => $commandeId,
                                "id_pc_portable" => $produit->getIdPcPortable(),
                            ];

                            $res = $this->getRequest($sql, $paramsCommande);
                            break;
                        case 'composant':
                            $sql = "INSERT INTO commandes_composants ( id_commande, id_composant) 
                                VALUES (:id_commande, :id_composant)";

                            $paramsCommande = [
                                "id_commande" => $commandeId,
                                "id_composant" => $produit->getIdComposant(),
                            ];

                            $res = $this->getRequest($sql, $paramsCommande);
                            break;
                    }
                }

            }

         }

        return true;

    }

    public function getCommandes($idClient, $id = 0) {
        $searchParams['id_client'] = $idClient;

        $sql = "SELECT * FROM commandes c
         WHERE id_client = :id_client";

        if($id > 0) {
            $sql .= " AND id_commande = :id_commande";
            $searchParams['id_commande'] = $id;
        }
        $sql .= " ORDER BY id_commande";

        $result = $this->getRequest($sql, $searchParams);

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

?>