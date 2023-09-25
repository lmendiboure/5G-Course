<?php

abstract class PageFormulaire extends Page
{
    private $formulaire;
    
    public function __construct()
    {
        include_once 'include/lib/libFormulaire.php';
        Page::__construct();
    }
    
    protected function setFormulaire($formulaire, $sqlUpdate = null)
    {
        $this->formulaire = $formulaire;
        
        if($this->havePostFormulaire())
        {
            $this->fillPost();
        }
        else
        {
            if($sqlUpdate != null)
                $this->fillSQLUpdate($sqlUpdate);
        }
    }
    
    protected function havePostFormulaire()
    {
        return isset($_POST['envoyer']);
    }
    
    private function fillPost()
    {
        if($this->havePostFormulaire())
        {
            $this->formulaire->arrayFill($_POST);
        }
    }
    
    private function fillSQLUpdate($sql)
    {
        if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'modifie')
        {
            $req = $this->bdd->prepare($sql);
            $req->execute(array($_GET['id']));
            
            if($donnees = $req->fetch())
                $this->formulaire->arrayFill($donnees);
            
            $req->closeCursor();
        }
    }
    
    protected function afficherContent()
    {
        $this->formulaire->afficher();
        $this->afficherResultat();
    }
    
    protected function afficherResultat()
    {
        
    }
    
}


?>