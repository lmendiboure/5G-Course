<?php
include_once 'include/lib/libPage.php';

class PageModifierSpeEtu extends PageFormulaire
{
	private $reponse;
	
    protected function init()
    {
		$inputSelectEtudiant = new InputSelectSQL("num_etudiant", "Etudiant", $this->bdd,
            "SELECT num_etudiant AS id, CONCAT_WS(' ', prenom_etudiant, nom_etudiant) AS name FROM etudiant");

		$inputSelectClasse = new inputSelectSQL("num_classe", "Classe", $this->bdd, 
			"SELECT num_classe AS id, CONCAT_WS(' ',nom_classe) AS name FROM classe");
				
        $fieldEtudiant = new Fieldset('Nom Prenom');
        $fieldEtudiant->addInput($inputSelectEtudiant);

		$fieldClasse = new Fieldset ('Classe');
		$fieldClasse->addInput($inputSelectClasse);


		if($this->havePostId())
		{
			$inputSelectEtudiant->setContenu($this->getPostId());

			$req = $this->bdd->prepare(
				'SELECT num_classe 
				FROM etudiant
				WHERE num_etudiant = ?');
			
			if($req->execute(array($this->getPostId())))
			{
				$resultat = $req->fetch();
				$idClasse = $resultat['num_classe'];

				$inputSelectClasse->setContenu($idClasse);
			}
		}
	
        $formulaire = new Formulaire('Modifier');
        $formulaire->addFieldset($fieldEtudiant);
        $formulaire->addFieldset($fieldClasse);
		
		$this->setFormulaire($formulaire);
		
		if($formulaire->check() && $this->havePostFormulaire())
		{
			$num_etudiant = $formulaire->getSafeContenu('num_etudiant');
			$num_classe = $formulaire->getSafeContenu('num_classe');

			$req = $this->bdd->prepare('UPDATE etudiant SET `num_classe` = ? WHERE num_etudiant = ?');
			$this->reponse = $req->execute(array($num_classe, $num_etudiant));
		}
    }
    
	protected function afficherResultat()
	{
		if(isset($this->reponse) && $this->reponse == 1)
		{
			echo "Le profil a bien été modifié";
			header('Location: listeStagiaire.php');
			exit;
		}
	}
}

$page = new PageModifierSpeEtu();
$page->run();

?>
