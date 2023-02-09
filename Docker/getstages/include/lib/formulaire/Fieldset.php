<?php

class Fieldset
{
    protected $liste;
    private $name;
    private $displayError;
    
    public function __construct($name)
    {
        $this->liste = array();
        $this->name = $name;
        $this->displayError = false;
    }
    
    public function issetContent($name)
    {
        return isset($this->liste[$name]);
    }
    
    public function getSafeContenu($name)
    {
        return $this->liste[$name]->getSafeContenu();
    }
    
    public function showErreur()
    {
        $this->displayError = true;
    }
    
    public function addInput($input)
    {
        $this->liste[$input->getNom()] = $input;
    }
    
    public function arrayFill($array)
    {
        $liste_key = array_keys($this->liste);
    
        for($i = 0; $i < count($liste_key); $i++)
        {
            $id_name = $this->liste[$liste_key[$i]]->getNom();
        
            if(isset($array[$id_name]))
            {
                $this->liste[$liste_key[$i]]->setContenu($array[$id_name]);
                $this->displayError = true;
            }
        }
    }
    
    public function check()
    {
        $liste_key = array_keys($this->liste);
        
        for($i = 0; $i < count($liste_key); $i++)
        {
            if($this->liste[$liste_key[$i]]->check() == false)
                return false;
        }
        
        return true;
    }
    
    public function afficher()
    {
        echo '<fieldset>';
        echo '<legend style="display: none;">'.$this->name.'</legend>';
        echo '<table>';
        echo '<tr><th colspan="';
        
        $showErreur = false;
        if($this->displayError && !$this->check())
            $showErreur = true;
        
        if($showErreur)
            echo '3';
        else
            echo '2';
        
        echo '">'.$this->name.'</td></tr>';
        
        $liste_key = array_keys($this->liste);
        for($i = 0; $i < count($liste_key); $i++)
        {
            echo '<tr>';
            echo '<td class="nowrap">';
            $this->liste[$liste_key[$i]]->afficherLabel();
            echo '</td><td>';
            $this->liste[$liste_key[$i]]->afficherInput();
            echo '</td>';
            
            if($showErreur)
            {
                if($this->liste[$liste_key[$i]]->check())
                {
                    echo '<td></td>';
                }
                else
                {
                    echo '<td>';
                    $this->liste[$liste_key[$i]]->afficherErreur();
                    echo '</td>';
                }
            }
            
            echo '</tr>';
        }
        
        echo '</table></fieldset>';
    }
    
    public function afficherInfo()
    {
        echo '<div class="information">';
        echo '<h3>'.$this->name.'</h3>';
        
        $liste_key = array_keys($this->liste);
        for($i = 0; $i < count($liste_key); $i++)
        {
            $this->liste[$liste_key[$i]]->afficherNom();
            $this->liste[$liste_key[$i]]->afficherContenu();
            echo '<br />';
        }
        echo '</div>';
    }
	
	public function containChampsObligatoire()
	{
		$trouverChampsObligatoire = false;
		
		$liste_key = array_keys($this->liste);
		for($i = 0; $i < count($liste_key); $i++)
		{
			if(!$this->liste[$liste_key[$i]]->isFacultatif())
			{
                $trouverChampsObligatoire = true;
            }
		}
		
		return $trouverChampsObligatoire;
	}
}

?>