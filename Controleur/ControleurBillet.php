<?php

require_once 'Modele/Modele.php';
require_once 'Vue/Vue.php';

class ControleurBillet {

    private $billet;

    public function __construct() {
        $this->billet = new Modele();
    }

    // Affiche les détails sur un billet
    public function billet($idBillet) {
        $billet = $this->billet->getBillet($idBillet);
        $vue = new Vue("Billet");
        $vue->generer(array('billet' => $billet));
    }

    // Ajoute un commentaire à un billet
    public function commenter($auteur, $contenu, $idBillet) {
        // Actualisation de l'affichage du billet
        $this->billet($idBillet);
    }

}

