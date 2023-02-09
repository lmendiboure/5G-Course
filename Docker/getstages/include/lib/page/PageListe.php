<?php

abstract class PageListe extends Page
{
    private $tableau_sql;
    
    public function __construct()
    {
        include 'include/lib/libListe.php';
        Page::__construct();
    }
    
    protected function setTableauSQL($tableau_sql)
    {
        $this->tableau_sql = $tableau_sql;
    }
    
    abstract protected function afficherBouton();
    
    protected function afficherContent()
    {
        echo '<span class="large_bouton_operation">';
        $this->afficherBouton();
        echo '</span>';
        echo '<hr />';
        $this->tableau_sql->afficher();
    }
}

?>