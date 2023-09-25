<?php

include_once 'include/lib/libPage.php';

class PageSupprimerStage extends Page
{
    protected function init()
    {	
    	$sql = 'DELETE FROM stage WHERE stage.num_stage = '.$_GET['id'].'';
        $reponse = $this->bdd->exec($sql);

		header('Location: listeStagiaire.php');
		exit();
    }
	
	protected function afficherContent()
	{
	
	}
}

$page = new PageSupprimerStage();
$page->run();
?>