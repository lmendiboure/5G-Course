<?php
include_once 'include/lib/libPage.php';

class PageSupprimerEntreprise extends Page
{
    protected function init()
    {	  
        $reponse = $this->bdd->exec('UPDATE entreprise SET `en_activite` = 0 WHERE num_entreprise = '.$_GET['id'].'');
		
		header('Location: listeEntreprise.php');
		exit();
    }
	
	protected function afficherContent()
	{
	
	}
}

$page = new PageSupprimerEntreprise();
$page->run();
?>