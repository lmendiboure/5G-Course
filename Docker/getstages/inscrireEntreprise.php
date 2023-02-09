<?php
include_once 'include/lib/libPage.php';

class PageInscrireEntreprise extends PageFormulaire
{
	private $reponse;
    
    protected function init()
    {
        $fieldInfo = new Fieldset('Information');
        $fieldInfo->addInput(new InputString("raison_sociale", "Nom de l'entreprise", InputStringType::Any, 2, 128, false));
        $fieldInfo->addInput(new InputString("nom_contact", "Nom du contact", InputStringType::Any, 2, 64, true));
        $fieldInfo->addInput(new InputString("nom_resp", "Nom du responsable", InputStringType::Any, 2, 64, true));

        $fieldContact = new Fieldset('Contact');
        $fieldContact->addInput(new InputString("rue_entreprise", "Rue", InputStringType::Any, 2, 92, false));
        $fieldContact->addInput(new InputNumber("cp_entreprise", "Code postal", 1000, 100000, false));
        $fieldContact->addInput(new InputString("ville_entreprise", "Ville", InputStringType::Alpha, 2, 32, false));
        $fieldContact->addInput(new InputString("tel_entreprise", "Téléphone", InputStringType::NumTelephone, 10, 32, false));
        $fieldContact->addInput(new InputString("fax_entreprise", "Fax", InputStringType::NumTelephone, 10, 32, true));
        $fieldContact->addInput(new InputString("email", "Email", InputStringType::AdresseMail, 2, 92, true));

        $fieldDivers = new Fieldset('Divers');
        $fieldDivers->addInput(new InputTextarea("observation", "Observation", 0, 2048, true));
        $fieldDivers->addInput(new InputString("site_entreprise", "Url de site", InputStringType::Url, 2, 92, true));
        $fieldDivers->addInput(new InputString("niveau", "Niveau", InputStringType::Any, 2, 92, false));

        $fieldSpecial = new FieldsetSelectSQL("num_spec", "Spécialité", $this->bdd,
            "SELECT num_spec AS id, libelle AS name FROM specialite");


        
        $nomBouton = '';
        
        if($this->havePostId())
            $nomBouton = 'Modifier';
        else
            $nomBouton = 'Ajouter';
        
        $formulaire = new Formulaire($nomBouton);
        $formulaire->addFieldset($fieldInfo);
        $formulaire->addFieldset($fieldContact);
        $formulaire->addFieldset($fieldDivers);
        $formulaire->addFieldset($fieldSpecial);

        $this->setFormulaire($formulaire, 'SELECT * FROM entreprise WHERE num_entreprise = ?');
        $fieldSpecial->setContenuSQL($this->bdd, "SELECT num_spec AS id FROM spec_entreprise WHERE num_entreprise = ?");
        
		if ($formulaire->check() && $this->havePostFormulaire())
		{
			$nom_entreprise = $formulaire->getSafeContenu("raison_sociale");
			$nom_contact = $formulaire->getSafeContenu("nom_contact");
			$nom_resp = $formulaire->getSafeContenu("nom_resp");
			$rue_entreprise = $formulaire->getSafeContenu("rue_entreprise");
			$cp_entreprise = $formulaire->getSafeContenu("cp_entreprise");
			$ville_entreprise = $formulaire->getSafeContenu("ville_entreprise");
			$tel_entreprise = $formulaire->getSafeContenu("tel_entreprise");
			$fax_entreprise = $formulaire->getSafeContenu("fax_entreprise");
			$email = $formulaire->getSafeContenu("email");
			$observation = $formulaire->getSafeContenu("observation");
			$site_entreprise = $formulaire->getSafeContenu("site_entreprise");
			$niveau = $formulaire->getSafeContenu("niveau");
            
            $sqlEntreprise = "";
            $sqlSpecialite = "";
            $arrayPrepareEntreprise = null;
            $arrayPrepareSpecialite = array();
            
            if($this->havePostId())
            {
                $num_entreprise = $this->getPostId();
                
                $sqlEntreprise = "UPDATE entreprise SET `raison_sociale`=?, `nom_contact`=?, `nom_resp`=?, 
                    `rue_entreprise`=?, `cp_entreprise`=?, `ville_entreprise`=?, `tel_entreprise`=?, 
                    `fax_entreprise`=?, `email` = ?, `observation`=?, `site_entreprise`=?, `niveau`=? 
                    WHERE num_entreprise=?;";
                    
                $arrayPrepareEntreprise = array($nom_entreprise, $nom_contact, $nom_resp, $rue_entreprise, 
                    $cp_entreprise, $ville_entreprise, $tel_entreprise, $fax_entreprise, 
                    $email, $observation, $site_entreprise, $niveau, $num_entreprise);

                $specialite = $fieldSpecial->getContenu();

                $sqlSpecialite = "DELETE FROM spec_entreprise WHERE num_entreprise = ?; INSERT INTO spec_entreprise VALUES ";

                array_push($arrayPrepareSpecialite, $num_entreprise);

                for($i = 0; $i < count($specialite); $i++)
                {
                    $sqlSpecialite .= '(?, ?)';
                    
                    if($i + 1 < count($specialite))
                        $sqlSpecialite .= ', ';
                    
                    array_push($arrayPrepareSpecialite, $num_entreprise);
                    array_push($arrayPrepareSpecialite, $specialite[$i]);
                }
            }
            else
            {
                $reponse = $this->bdd->query("SELECT `AUTO_INCREMENT`
                    FROM  INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_SCHEMA = 'geststages'
                    AND   TABLE_NAME   = 'entreprise';");
                
                if($donnees = $reponse->fetch())
                {
                    $num_entreprise = $donnees['AUTO_INCREMENT'];
                    $reponse->closeCursor();
                   
                    $sqlEntreprise = "INSERT INTO entreprise 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1');";
                    
                    $arrayPrepareEntreprise = array($num_entreprise, $nom_entreprise, $nom_contact, $nom_resp, $rue_entreprise, 
                        $cp_entreprise, $ville_entreprise, $tel_entreprise, $fax_entreprise, 
                        $email, $observation, $site_entreprise, $niveau);
                        
                    $specialite = $fieldSpecial->getContenu();
                    
                    
                    $sqlSpecialite = "INSERT INTO spec_entreprise VALUES ";
                    for($i = 0; $i < count($specialite); $i++)
                    {
                        $sqlSpecialite .= '(?, ?)';
                        
                        if($i + 1 < count($specialite))
                            $sqlSpecialite .= ', ';
                        
                        array_push($arrayPrepareSpecialite, $num_entreprise);
                        array_push($arrayPrepareSpecialite, $specialite[$i]);
                    }
                    
                }
                else
                {
                    $reponse->closeCursor();
                }
            }
            
			$req = $this->bdd->prepare($sqlEntreprise);
            $reponse = $req->execute($arrayPrepareEntreprise);
			$this->reponse = $reponse;
            
            $req = $this->bdd->prepare($sqlSpecialite);
            $reponse = $req->execute($arrayPrepareSpecialite);
			$this->reponse = $reponse;
			
			if($this->reponse)
			{
				header('Location: listeEntreprise.php');
				exit;
			}
		}
    }
    
	protected function afficherResultat()
	{
		if(isset($this->reponse))
		{
            if($this->reponse)
            {
                if($this->havePostId())
                {
                    echo '<div class="message">L\'entreprise a bien été modifiée</div>';
                }
                else
                {
                    echo '<div class="message">L\'entreprise a bien été ajoutée</div>';
                }
            }
            else
            {
                echo '<div class="message">Erreur SQL</div>';
            }
		}
	}
}

$page = new PageInscrireEntreprise();
$page->run();

?>
