<?php

class Formulaire
{
    private $liste;
    private $nomBouton;
    private $target;
    
    public function __construct($nomBouton = 'Envoyer', $target = '')
    {
        $this->liste = array();
        $this->nomBouton = $nomBouton;
        $this->target = $target;
    }
    
    public function getSafeContenu($name)
    {
        $length = count($this->liste);
        
        for($i = 0; $i < $length; $i++)
        {
            if($this->liste[$i]->issetContent($name))
            {
                return $this->liste[$i]->getSafeContenu($name);
            }
        }
        
        return "";
    }
    
    public function addFieldset($fieldset)
    {
        array_push($this->liste, $fieldset);
    }
    
    public function arrayFill($array)
    {
        for($i = 0; $i < count($this->liste); $i++)
        {
            $this->liste[$i]->arrayFill($array);
        }
    }
    
    public function afficher()
    {
        $length = count($this->liste);
        echo '<form class="list" method="post" action="' . $this->target . '">';
        
        for($i = 0; $i < $length; $i++)
        {
            $this->liste[$i]->afficher();
        }
        
        if($this->containChampsObligatoire())
            echo '<div class="aide">Les champs comportant le symbole <span class="important">*</span> sont obligatoires</div><br />';
        
        echo '<input type="submit" name="envoyer" value="'.$this->nomBouton.'" />';
        echo '</form>';
    }
    
    public function afficherInfo()
    {
        $length = count($this->liste);
        
        if($length > 1)
            echo '<div class="deux_colonnes">';
        for($i = 0; $i < $length; $i++)
        {
            if($length > 1 && $i == ceil($length / 2))
            {
                echo '</div><div class="deux_colonnes">';
            }
            $this->liste[$i]->afficherInfo();
        }
        if($length > 1)
            echo '</div>';
    }
    
	public function check()
	{
		$valide = true;
		
		for ($i = 0; $i < count($this->liste); $i++)
		{
			if(!$this->liste[$i]->check())
				$valide = false;
		}
		
		return $valide;
		
	}
    
    private function containChampsObligatoire()
	{
		$trouverChampsObligatoire = false;
		
		for($i = 0; $i < count($this->liste); $i++)
		{
			if($this->liste[$i]->containChampsObligatoire())
				$trouverChampsObligatoire = true;
		}
		
		return $trouverChampsObligatoire;
	}
	
    
    
  
}

?>