<?php
include_once 'include/lib/libPage.php';

class PageAjoutModifEtu extends PageFormulaire
{
	private $reponse;
        
    
    protected function init()
    {
        $inputNom = new InputString("nom_etudiant", "Nom", InputStringType::Alpha, 2, 64, false);
        $inputPrenom = new InputString("prenom_etudiant", "Prénom", InputStringType::Alpha, 2, 64, false);
        $inputLogin = new InputString("lelogin", "Nom d'utilisateur (8 caractères)", InputStringType::AlphaNum, 8, 8, false);
        $inputMdp = new InputString("lemdp", "Mot de passe (entre 8 et 30 caractères)", InputStringType::AlphaNum, 8, 30, false);
        $inputAnnee = new InputDate("annee_obtention", "Date d'obtention du BTS (AAAA-MM-JJ)", true);
        $inputSelectClasse = new inputSelectSQL("num_classe", "Classe", $this->bdd, 
            "SELECT num_classe AS id, nom_classe AS name FROM classe ORDER BY nom_classe");
        
        $fieldInfo = new Fieldset('Informations concernant l\'étudiant');
        $fieldInfo->addInput($inputNom);
        $fieldInfo->addInput($inputPrenom);
        $fieldInfo->addInput($inputLogin);
        $fieldInfo->addInput($inputMdp);
        $fieldInfo->addInput($inputAnnee);
        $fieldInfo->addInput($inputSelectClasse);
        
        $nomBouton = '';
        
        if($this->havePostId()){
            $nomBouton = 'Modifier';
            
            $req = $this->bdd->prepare('SELECT * FROM etudiant WHERE num_etudiant = ?');
			
            if($req->execute(array($this->getPostId()))){
		$resultat = $req->fetch();
		$inputNom->setContenu($resultat['nom_etudiant']);
                $inputPrenom->setContenu($resultat['prenom_etudiant']);
                $inputLogin->setContenu($resultat['login']);
                $inputMdp->setContenu($resultat['mdp']);
                if($resultat['annee_obtention'] == '0000-00-00'){
                    $date_obtention = '';
                }
                else{
                     $date_obtention = $resultat['annee_obtention'];
                }
                $inputAnnee->setContenu($date_obtention);
                $inputSelectClasse->setContenu($resultat['num_classe']);
            }

        }
        else{
            $nomBouton = 'Ajouter';
        }
        
        $formulaire = new Formulaire($nomBouton);
        $formulaire->addFieldset($fieldInfo);
        $this->setFormulaire($formulaire);

        if ($formulaire->check() && $this->havePostFormulaire())
        {
            $nom_etudiant = $formulaire->getSafeContenu("nom_etudiant");
            $prenom_etudiant = $formulaire->getSafeContenu("prenom_etudiant");
            $annee_obtention = $formulaire->getSafeContenu("annee_obtention");
            $login = $formulaire->getSafeContenu("lelogin");
            $mdp = $formulaire->getSafeContenu("lemdp");
            $num_classe = $formulaire->getSafeContenu("num_classe");

            $sqlEtudiant = "";
            $arrayPrepareEtudiant = null;
            
            if($this->havePostId())
            {
                $num_etudiant = $this->getPostId();
                
                $sqlEtudiant = "UPDATE etudiant SET `nom_etudiant`=?, `prenom_etudiant`=?, `annee_obtention`=?, 
                    `login`=?, `mdp`=?, `num_classe`=? WHERE num_etudiant=?";
                    
                $arrayPrepareEtudiant = array($nom_etudiant, $prenom_etudiant, $annee_obtention, $login, 
                        $mdp, $num_classe, $num_etudiant);
            }
            else
            {
                
                $reponse = $this->bdd->query("SELECT `AUTO_INCREMENT`
                    FROM  INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_SCHEMA = 'geststages'
                    AND   TABLE_NAME   = 'etudiant';");
                
                if($donnees = $reponse->fetch())
                {
                    $num_etudiant = $donnees['AUTO_INCREMENT'];
                    $reponse->closeCursor();
                
                                
                    if(empty($annee_obtention)){
                        $sqlEtudiant = "INSERT INTO etudiant VALUES (?, ?, ?, NULL, ?, ?, ?,1)"; 
                        $arrayPrepareEtudiant = array($num_etudiant, $nom_etudiant, $prenom_etudiant, $login, 
                        $mdp, $num_classe);
                    }
                    else{
                        $sqlEtudiant = "INSERT INTO etudiant VALUES (?, ?, ?, ?, ?, ?, ?,1)";
                        $arrayPrepareEtudiant = array($num_etudiant, $nom_etudiant, $prenom_etudiant, $annee_obtention, $login, 
                        $mdp, $num_classe);
                    }
                    
                    
                }
                else
                {
                    $reponse->closeCursor();
                }
            }
            
            $req = $this->bdd->prepare($sqlEtudiant);
            $this->reponse = $req->execute($arrayPrepareEtudiant);
            
            if($this->reponse)
            {
                header('Location: listeStagiaire.php');
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
                        echo '<div class="message">L\'étudiant a bien été modifié</div>';
                    }
                    else
                    {
                        echo '<div class="message">L\'étudiant a bien été ajouté</div>';
                    }
                }
                else
                {
                    echo '<div class="message">Erreur SQL</div>';
                }
            }
	}
}

$page = new PageAjoutModifEtu();
$page->run();

?>
