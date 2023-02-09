<?php
include_once 'include/lib/libPage.php';

class PageSupprimerStagiaire extends Page
{
    protected function init()
    {	  
        $reponse = $this->bdd->exec('UPDATE etudiant SET `en_activite` = 0 WHERE num_etudiant = '.$_GET['id'].'');
		
		header('Location: listeStagiaire.php');
		exit();
    }
	
	protected function afficherContent()
	{
	
	}
}

$page = new PageSupprimerStagiaire();
$page->run();
?>