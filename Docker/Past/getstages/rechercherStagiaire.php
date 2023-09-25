<?php
include_once 'include/lib/libPage.php';

class PageRechercherStagiaire extends PageFormulaire
{
    protected function init()
    {
	
        $fieldStagiaire = new Fieldset('Sélectionner la classe dans laquelle rechercher un étudiant');
			
        $inputSelectClasseStagiaire = new InputSelectSQL("classe", "Classe", $this->bdd,
            "SELECT DISTINCT classe.num_classe AS id, nom_classe AS name FROM etudiant JOIN classe ON etudiant.num_classe = classe.num_classe WHERE en_activite = 1", true);
		$inputSelectClasseStagiaire->addRow("", "---");
		$inputSelectClasseStagiaire->setContenu("");

        $fieldStagiaire->addInput($inputSelectClasseStagiaire);
		
	$formulaire = new Formulaire('Rechercher','listeStagiaire.php');
        $formulaire->addFieldset($fieldStagiaire);
		
        $this->setFormulaire($formulaire);
    }
}

$page = new PageRechercherStagiaire();
$page->run();

?>
