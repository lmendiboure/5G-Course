<?php

abstract class PageInformation extends Page
{
    private $titre;
    private $formulaire;
    private $tableau_sql;
    
    public function __construct()
    {
        include 'include/lib/libFormulaire.php';
        include 'include/lib/libListe.php';
        Page::__construct();
    }
    
    protected function setTitre($titre)
    {
        $this->titre = $titre;
    }
    
    protected function setFormulaire($formulaire)
    {
        $this->formulaire = $formulaire;
    }
    
    protected function setTableauSQL($tableau_sql)
    {
        $this->tableau_sql = $tableau_sql;
    }
    
    protected function fillSQLUpdate($sql)
    {
        if($this->havePostId())
        {
            $req = $this->bdd->prepare($sql);
            $req->execute(array($this->getPostId()));
            
            if($donnees = $req->fetch())
                $this->formulaire->arrayFill($donnees);
            
            $req->closeCursor();
        }
    }
    
    protected function afficherContent()
    {
        echo '<header><h1>';
        echo $this->titre;
        echo '<h1></header>';
        echo '<hr />';
        echo '<h2>Entrée</h2>';
        $this->formulaire->afficherInfo();
        echo '<hr />';
        echo '<h2>Stage</h2>';
        $this->tableau_sql->afficher();
    }
}

?>