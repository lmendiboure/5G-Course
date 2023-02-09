<?php

function makeMenu($admin, $deconnexion)
{
    $ongletAccueil = new Onglet('Accueil', 'index.php', 'onglet_accueil');
    $ongletEntreprise = new Onglet('Entreprise', 'listeEntreprise.php', 'onglet_entreprise');
    $ongletStagiaire = new Onglet('Stagiaire', 'listeStagiaire.php', 'onglet_stagiaire');
    $ongletInscription = new Onglet('Inscription', 'inscrireStagiaire.php', 'onglet_inscrire');
    $ongletAide = new Onglet('Aide', 'aide.php', 'onglet_aide');
    
    if($deconnexion){
        $ongletDeconnexion = new Onglet('Déconnexion', 'deconnexion.php', 'onglet_deconnexion');
    }

    $ongletEntreprise->addPage('inscrireEntreprise.php');
    $ongletEntreprise->addPage('rechercherEntreprise.php');
    $ongletEntreprise->addPage('infoEntreprise.php');

    $ongletStagiaire->addPage('ajoutModifEtu.php');
    $ongletStagiaire->addPage('rechercherStagiaire.php');
    $ongletStagiaire->addPage('infoStagiaire.php');

    $menu = new Menu();
    $menu->addOnglet($ongletAccueil);
    $menu->addOnglet($ongletEntreprise);
    $menu->addOnglet($ongletStagiaire);
    $menu->addOnglet($ongletInscription);
    $menu->addOnglet($ongletAide);
    
    if($deconnexion){
        $menu->addOnglet($ongletDeconnexion);
    }
    
    return $menu;
}

?>