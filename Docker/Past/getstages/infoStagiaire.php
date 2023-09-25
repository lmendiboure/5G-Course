<?php
include_once 'include/lib/libPage.php';

class PageInfoStagiaire extends PageInformation
{
    protected function init()
    {
        $fieldInfo = new Fieldset('Etudiant');
        $fieldInfo->addInput(new InputString("nom_etudiant", "Nom", InputStringType::Alpha, 2, 64, false));
        $fieldInfo->addInput(new InputString("prenom_etudiant", "Prenom", InputStringType::Alpha, 2, 64, true));
        $fieldInfo->addInput(new InputString("num_classe", "Classe", InputStringType::Alpha, 2, 64, true));
        $fieldInfo->addInput(new InputString("annee_obtention", "Année d'obtention du BTS", InputStringType::Alpha, 2, 64, true));

        $formulaire = new Formulaire();
        $formulaire->addFieldset($fieldInfo);


        $tableau = new Tableau();
        $tableau->addColonne(new Colonne("Opération", 'entreprise.num_entreprise', '
            <span class="center bouton_operation">
                <a title="voir" class="icon_voir" href="infoEntreprise.php?id=$1"></a>
            </span>'));
        if($this->userInfo['is_professeur']) 
        {
            $tableau->addColonne(new Colonne("Opération", 'stage.num_stage', '
                <span class="center bouton_operation">
                    <a title="supprimer" class="icon_supprimer" href="supprimerStage.php?id=$1"></a>
                </span>'));
        }
        $tableau->addColonne(new Colonne("Entreprise", 'raison_sociale', '$1'));
        $tableau->addColonne(new Colonne("Projet", 'desc_projet', '$1'));

        $tableau_sql = new TableauSQL($tableau, $this->bdd, 
            "stage JOIN etudiant ON stage.num_etudiant=etudiant.num_etudiant
            JOIN entreprise ON entreprise.num_entreprise=stage.num_entreprise
            JOIN professeur ON stage.num_prof = professeur.num_prof
            WHERE etudiant.num_etudiant = ".$this->getPostId(), 
            "nom_etudiant, prenom_etudiant");

        $this->setFormulaire($formulaire);
        $this->setTableauSQL($tableau_sql);
        $this->fillSQLUpdate('SELECT * FROM etudiant WHERE num_etudiant = ?');
        $this->setTitre($formulaire->getSafeContenu("prenom_etudiant") . " " . $formulaire->getSafeContenu("nom_etudiant"));
    }

}

$page = new PageInfoStagiaire();
$page->run();


?>