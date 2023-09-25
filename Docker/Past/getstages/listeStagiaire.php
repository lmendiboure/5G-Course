<?php

include 'include/lib/libPage.php';

class PageListeStagiaire extends PageListe
{
    protected function afficherBouton()
    {
        echo '<a class="icon_rechercher" href="rechercherStagiaire.php">Rechercher un stagiaire existant</a>';
        
        if($this->userInfo['is_professeur']){
            echo '<a class="icon_ajouter" href="ajoutModifEtu.php">Ajouter un étudiant</a>';
        }
    }

    protected function init()
    {
        $tableau = new Tableau();
        $tableau->addColonne(new Colonne("Opération", 'etudiant.num_etudiant', '
            <span class="center bouton_operation">
                <a title="voir" class="icon_voir" href="infoStagiaire.php?id=$1"></a>
            </span>'));

        if($this->userInfo['is_professeur'])
        {
    		$tableau->addColonne(new Colonne("Opération", 'etudiant.num_etudiant', '
    			<span class="center bouton_operation">
    				<a title="modifier" class="icon_modifier" href="ajoutModifEtu.php?action=modifie&id=$1"></a>
    				<a title="supprimer" class="icon_supprimer" href="supprimerStagiaire.php?id=$1"></a>
    			</span>'));
        }
			
        $tableau->addColonne(new Colonne("Etudiant", 'nom_etudiant, prenom_etudiant', '$1 $2'));
        $tableau->addColonne(new Colonne("Entreprises", array('GROUP_CONCAT(raison_sociale SEPARATOR "<br />")'), '$1', true, false));
        $tableau->addColonne(new Colonne("Professeur", 'nom_prof, prenom_prof', '$1 $2'));
		
		//$requete = " WHERE annee_obtention IS NULL AND etudiant.en_activite = 1";
                $requete = " WHERE etudiant.en_activite = 1";
		
		if (isset($_POST['nom']) && $_POST['nom'] != ""){
			$requete .= " AND etudiant.num_etudiant = ".$_POST['nom'];
                }
		if (isset($_POST['prenom']) && $_POST['prenom'] != ""){
			$requete .= " AND etudiant.num_etudiant = ".$_POST['prenom'];
                }
		if (isset($_POST['classe']) && $_POST['classe'] != ""){
			$requete .= " AND classe.num_classe = ".$_POST['classe'];
                }

        $tableau_sql = new TableauSQL($tableau, $this->bdd, 
            "stage
                RIGHT OUTER JOIN etudiant ON etudiant.num_etudiant = stage.num_etudiant 
                LEFT OUTER JOIN entreprise ON entreprise.num_entreprise = stage.num_entreprise 
                LEFT OUTER JOIN professeur ON professeur.num_prof = stage.num_prof
                JOIN classe ON etudiant.num_classe = classe.num_classe"
                .$requete.
                " GROUP BY etudiant.num_etudiant, nom_etudiant, prenom_etudiant, nom_prof, prenom_prof ", 
            "nom_etudiant, prenom_etudiant");
        
        $this->setTableauSQL($tableau_sql);
    }
}

$page = new PageListeStagiaire();
$page->run();

?>