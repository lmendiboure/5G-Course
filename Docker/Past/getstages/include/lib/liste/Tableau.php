<?php

class Tableau
{
    private $liste;
    
    public function __construct()
    {
        $this->liste = array();
    }
    
    public function addColonne($colonne)
    {
        array_push($this->liste, $colonne);
    }
    
    public function haveHideColumn()
    {
        for($i = 0; $i < count($this->liste); $i++)
        {
            if(!$this->liste[$i]->isShow())
                return true;
        }
        
        return false;
    }
    
    public function getChamps()
    {
        $array_fusion = array();
        for($i = 0; $i < count($this->liste); $i++)
            $array_fusion = array_merge($array_fusion, $this->liste[$i]->getChamps());
        $array_unique = array_unique($array_fusion);
        $array_implode = implode(", ", $array_unique);
        return $array_implode;
    }
    
    public function getTitres()
    {
        $cumul = '';
        
        for($i = 0; $i < count($this->liste); $i++)
        {
            $cumul .= $this->liste[$i]->getTitre();
        }
        
        return $cumul;
    }
    
    public function getLigne($donnees)
    {
        $cumul = '';
        
        for($i = 0; $i < count($this->liste); $i++)
        {
            $cumul .= $this->liste[$i]->getCell($donnees);
        }
        
        return $cumul;
    }
}

?>