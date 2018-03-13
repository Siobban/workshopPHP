<?php

class Modele {

    private $bdd;

  // Renvoie la liste des billets du blog
  public function getBillets() {
    $bdd = 'select BIL_ID as id, BIL_DATE as date,'
      . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
      . ' order by BIL_ID desc';
    $billets = $this->executeRequete($bdd);
    return $billets;
  }

  // Renvoie les informations sur un billet
  public function getBillet($idBillet) {
    $bdd = 'select BIL_ID as id, BIL_DATE as date,'
      . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
      . ' where BIL_ID=?';
    $billet = $this->executerRequete($bdd, array($idBillet));
    if ($billet->rowCount() == 1)
      return $billet->fetch();  // Accès à la première ligne de résultat
    else
      throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
  }

  // Effectue la connexion à la BDD
  // Instancie et renvoie l'objet PDO associé
  private function getBdd() {
    if ($this->bdd == null) {
        $this->bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root',
          'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    return $this->bdd;
  }

  private function executerRequete($bdd, $params = null) {
    if ($params == null) {
      $resultat = $this->getBdd()->query($bdd);    // exécution directe
    }
    else {
      $resultat = $this->getBdd()->prepare($bdd);  // requête préparée
      $resultat->execute($params);
    }
    return $resultat;
  }
}