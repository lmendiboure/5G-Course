<?php

include_once 'include/lib/libPage.php';

class PageListeEntreprise extends PageListe
{
    protected function afficherBouton()
    {
        echo '<a class="icon_rechercher" href="rechercherEntreprise.php">Rechercher une entreprise</a>';
        echo '<a class="icon_ajouter" href="inscrireEntreprise.php">Ajouter une entreprise</a>';
    }
    
    protected function init()
    {

        if($this->userInfo['is_professeur'])
        {
            $listeBoutons = '
                    <a title="voir" class="icon_voir" href="infoEntreprise.php?id=$1"></a>
                    <a title="associer un stage" class="icon_inscrire" href="inscrireStagiaire.php?id_entreprise=$1"></a>
                    <a title="modifier" class="icon_modifier" href="inscrireEntreprise.php?action=modifie&id=$1"></a>
                    <a title="supprimer" class="icon_supprimer" href="supprimerEntreprise.php?id=$1"></a>';
        }else{
            $listeBoutons = '
                    <a title="voir" class="icon_voir" href="infoEntreprise.php?id=$1"></a>
                    <a title="associer un stage" class="icon_inscrire" href="inscrireStagiaire.php?id_entreprise=$1"></a>';         
        }
        
        $tableau = new Tableau();
        $tableau->addColonne(new Colonne("Opération", 'entreprise.num_entreprise', '
            <span class="center bouton_operation">
                '.$listeBoutons.'</span>'));
        
        $tableau->addColonne(new Colonne("Entreprise", 'raison_sociale', '$1'));
        $tableau->addColonne(new Colonne("Responsable", 'nom_contact', '$1'));
        $tableau->addColonne(new Colonne("Adresse", 'rue_entreprise, cp_entreprise, ville_entreprise', '$1<br />$2 $3'));
        $tableau->addColonne(new Colonne("Site", 'site_entreprise', '
            <span class="center">
                <span class="bouton_operation">
                    <a title="$1" class="icon_website" target="blank" href="$1"></a>
                </span>
            </span>'));
        $tableau->addColonne(new Colonne("Email", 'email', '$1', false));
        $tableau->addColonne(new Colonne("Spécialité", array('GROUP_CONCAT(libelle SEPARATOR "<br />")'), '$1', true));
        $tableau->addColonne(new Colonne("Niveau", 'niveau', '$1', false));
    
	$requete = " WHERE en_activite = 1 ";
		
	if (isset($_POST['ville_entreprise']) && $_POST['ville_entreprise'] != ""){
            $requete .= " AND ville_entreprise LIKE '".$_POST['ville_entreprise']."'";
        }
	if (isset($_POST['raison_sociale']) && $_POST['raison_sociale'] != ""){
            $requete .= " AND raison_sociale LIKE '%".$_POST['raison_sociale']."%'";
        }	
	if (isset($_POST['num_spec']) && $_POST['num_spec'] != ""){
            $requete .= " AND specialite.num_spec = ".$_POST['num_spec']."";
        }
			
        $tableau_sql = new TableauSQL($tableau, $this->bdd, 
            "entreprise LEFT OUTER JOIN spec_entreprise ON entreprise.num_entreprise = spec_entreprise.num_entreprise
                LEFT OUTER JOIN specialite ON spec_entreprise.num_spec = specialite.num_spec".
                $requete.' GROUP BY entreprise.num_entreprise', 
                "raison_sociale");
        
        $this->setTableauSQL($tableau_sql);
    }
}

$page = new PageListeEntreprise();
$page->run();

?>