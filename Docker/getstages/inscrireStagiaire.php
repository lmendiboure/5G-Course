<?php

include_once 'include/lib/libPage.php';

class PageInscrireStagiaire extends PageFormulaire
{
    protected function init()
    {
        $fieldContact = new Fieldset('Contact');
        
        $inputSelectEntreprise = new InputSelectSQL("num_entreprise", "Entreprise", $this->bdd,
            "SELECT num_entreprise AS id, CONCAT(raison_sociale,' - contact : ', nom_contact) AS name FROM entreprise WHERE en_activite = 1 ORDER BY raison_sociale");
        
        if(isset($_GET['id_entreprise']))
        {
            $inputSelectEntreprise->setContenu($_GET['id_entreprise']);
        }
        
        
        
        $inputEtudiant = null;
        
        if($this->userInfo['is_professeur'])
        {
            $inputEtudiant = new InputSelectSQL("num_etudiant", "Etudiant", $this->bdd,
                "SELECT num_etudiant AS id, CONCAT_WS(' ', prenom_etudiant, nom_etudiant) AS name FROM etudiant WHERE en_activite = 1");
        }
        else
        {
            $nom = $this->userInfo['nom'];
            $prenom = $this->userInfo['prenom'];
            $classe = $this->userInfo['bts'];
            
            $sql = "SELECT num_etudiant AS id FROM etudiant NATURAL JOIN classe WHERE nom_etudiant LIKE '$nom' AND prenom_etudiant LIKE '$prenom' AND nom_classe LIKE '$classe%';";
            $reponse = $this->bdd->query($sql);
            
            if($donnees = $reponse->fetch()){
                $inputEtudiant = new InputHidden("num_etudiant", "Etudiant", $donnees['id'], $prenom . ' ' . $nom);
            }
            else{
                $inputEtudiant = new InputHidden("num_etudiant", "Etudiant", -1, "<Erreur>");
            }
        }
        
        
        
        $fieldContact->addInput($inputSelectEntreprise); 
        $fieldContact->addInput($inputEtudiant);
        $fieldContact->addInput(new InputSelectSQL("num_prof", "Professeur", $this->bdd,
            "SELECT num_prof AS id, CONCAT_WS(' ', prenom_prof, nom_prof) AS name FROM professeur"));
        
            
        $inputDateDebut = new InputDate("debut_stage", "Date de debut du stage", InputStringType::Any, false);
        $inputDateFin = new InputDateGT("fin_stage", "Date de fin du stage", InputStringType::Any, false);
        $inputDateFin->setOtherInputDate($inputDateDebut);

        $inputSelectTypeStage = new InputSelect("type_stage", "Type de stage", false);
        $inputSelectTypeStage->addRow('', 'Aucun');
        $inputSelectTypeStage->addRow('stage', 'Stage');
        $inputSelectTypeStage->addRow('alternance', 'Alternance');

        $fieldDescription = new Fieldset('Description du stage');
        $fieldDescription->addInput($inputDateDebut);
        $fieldDescription->addInput($inputDateFin);
        $fieldDescription->addInput($inputSelectTypeStage);
        $fieldDescription->addInput(new InputTextarea("desc_projet", "Description du projet", 0, 2048, true));
        $fieldDescription->addInput(new InputTextarea("observation_stage", "Observation", 0, 2048, true));

        $formulaire = new Formulaire('Inscrire');
        $formulaire->addFieldset($fieldContact);
        $formulaire->addFieldset($fieldDescription);
        
        $this->setFormulaire($formulaire, 'SELECT * FROM stage WHERE num_stage = ?');
        
        if($formulaire->getSafeContenu("num_etudiant") != -1)
        {
            if($formulaire->check())
            {
                // Champs
                $debut_stage = $formulaire->getSafeContenu("debut_stage");
                $fin_stage = $formulaire->getSafeContenu("fin_stage");
                $type_stage = $formulaire->getSafeContenu("type_stage");
                $desc_projet = $formulaire->getSafeContenu("desc_projet");
                $observation_stage = $formulaire->getSafeContenu("observation_stage");

                
                // Foreign key
                $num_entreprise = $formulaire->getSafeContenu("num_entreprise");
                $num_etudiant = $formulaire->getSafeContenu("num_etudiant");
                $num_prof = $formulaire->getSafeContenu("num_prof");
               
            
                $sql="INSERT INTO `stage`(`debut_stage`, `fin_stage`, `type_stage`, `desc_projet`, 
                    `observation_stage`, `num_entreprise`, `num_prof`, `num_etudiant`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                
                $req = $this->bdd->prepare($sql);
                $reponse = $req->execute(array($debut_stage, $fin_stage, $type_stage, $desc_projet, 
                    $observation_stage, $num_entreprise, $num_prof, $num_etudiant));
                
                $this->reponse = $reponse;
            }
        }
    }
    
	protected function afficherResultat()
	{
		if(isset($this->reponse))
		{
            if($this->reponse)
            {
                echo '<div class="message">Le stagiaire a bien été ajouté</div>';
            }
            else
            {
                echo '<div class="message">Erreur SQL</div>';
            }
		}
	}
}

$page = new PageInscrireStagiaire();
$page->run();

?>
