<?php

class Onglet
{
    private $titre;
    private $url;
    private $id;
    private $listPage;
    
    public function __construct($titre, $url, $id)
    {
        $this->titre = $titre;
        $this->url = $url;
        $this->id = $id;
        $this->listPage = array();
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function addPage($pageName)
    {
        array_push($this->listPage, $pageName);
    }
    
    private function containPage()
    {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        
        for($i = 0; $i < count($this->listPage); $i++)
        {
            if(strpos($scriptName, $this->listPage[$i]) != false)
                return true;
        }
        
        return false;
    }
    
    public function afficher()
    {
        echo '<a id="' . $this->id . '"';
        
        if(strpos($_SERVER['SCRIPT_NAME'], $this->url) != false || $this->containPage())
            echo 'class="actif"';
            
        echo ' href="' . $this->url . '"';
        echo ' title="' . $this->titre . '"><span>';
        echo $this->titre . '</span></a>';
    }
}

?>