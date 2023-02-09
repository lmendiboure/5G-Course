<?php

include_once 'include/lib/libPage.php';

class PageRechercherEntreprise extends PageFormulaire
{
    protected function init()
    {
        $bdd = $this->bdd;
        
        $fieldEntreprise = new Fieldset('Entreprise');
		
	$inputSelectEntreprise=new InputSelectSQL("ville_entreprise", "Ville", $bdd,"SELECT DISTINCT ville_entreprise AS id, LOWER(ville_entreprise) AS name FROM entreprise WHERE en_activite = 1" , true);	
	$inputSelectEntreprise->addRow("", "");
	$inputSelectEntreprise->setContenu("");

	$fieldEntreprise->addInput($inputSelectEntreprise);

        $fieldEntreprise->addInput(new InputString("raison_sociale", "Nom", InputStringType::Any, 2, 128, true));
		
	$inputSelectSpecialite=new InputSelectSQL("num_spec", "Spécialité", $bdd,"SELECT DISTINCT num_spec AS id, libelle AS name FROM specialite" , true);		
        $inputSelectSpecialite->addRow("", "");
	$inputSelectSpecialite->setContenu("");
	$fieldEntreprise->addInput($inputSelectSpecialite);
		
	$formulaire = new Formulaire('Rechercher','listeEntreprise.php');
        $formulaire->addFieldset($fieldEntreprise);
		
        $this->setFormulaire($formulaire);
    }
	
}

$page = new PageRechercherEntreprise();
$page->run();

?>
