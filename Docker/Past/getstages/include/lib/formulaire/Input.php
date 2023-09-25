<?php

abstract class Input
{
    protected $nom;
    protected $type;
    protected $label;
    protected $contenu;
    protected $min;
    protected $max;
    protected $facultatif;
    
    public function __construct($nom, $type, $label, $min = 0, $max = 524288, $facultatif = true)
    {
        $this->nom = $nom;
        $this->type = $type;
        $this->label = $label;
        $this->contenu = '';
        $this->min = $min;
        $this->max = $max;
        $this->facultatif = $facultatif;
    }
    
    public function getNom() {return $this->nom;}
    public function getContenu() {return $this->contenu;}
    public function setContenu($contenu) {$this->contenu = $contenu;}
	public function isFacultatif() {return $this->facultatif;}
    
    public function getSafeContenu() {return htmlspecialchars($this->contenu);}
    
    protected function msgErrorEmpty() {return "Ce champ doit obligatoirement être renseigné.";}
    protected function msgErrorSize() {return "Ce champ doit contenir entre ".$this->min." et ".$this->max." caractères.";}
    protected function msgErrorFormat() {return "Ce champ contient des caractères non autorisés.";}
    protected function msgErrorValue() {return "La valeur renseignée ne correspond pas à la demande.";}
    
    protected function checkEmpty()
    {
        if(!$this->facultatif && $this->contenu == '')
            return false;
        return true;
    }
    
    protected function checkSize()
    {
        $len = strlen($this->contenu);
        if($len >= $this->min && $len <= $this->max)
            return true;
        return false;
    }
    
    protected function checkFormat() {return true;}
    protected function checkValue() {return true;}
    
    public function check()
    {
        if(!$this->checkEmpty())
            return false;
        else if($this->contenu != '')
        {
            if(!$this->checkSize())
                return false;
            if(!$this->checkFormat())
                return false;
            if(!$this->checkValue())
                return false;
        }
        
        return true;
    }
    
    public function afficherNom()
    {
        echo '<strong>' . $this->label . ' : </strong>';
    }
    
    public function afficherContenu()
    {
        echo $this->getSafeContenu();
    }
    
    public function afficherLabel()
    {
        echo '<label for="' . $this->nom . '">' . $this->label;
        
        if(!$this->facultatif)
            echo '<span class="important">*</span>';
        
        echo ' : </label>';
    }
    
    public function afficherInput()
    {
        echo '<input type="' . $this->type;
        echo '" id="' . $this->nom;
        echo '" name="' . $this->nom;
        echo '" value="' . $this->contenu;
        
        if($this->type == 'text' || $this->type == 'email' || $this->type == 'password' 
        || $this->type == 'search' || $this->type == 'tel' || $this->type == 'url')
            echo '" maxlength="' . $this->max;
            
        echo '" />';
    }
    
    public function afficherErreur()
    {
        $erreur = '<ul class="important">';
        
        if(!$this->checkEmpty())
        {
            $erreur .= '<li>' . $this->msgErrorEmpty() . "</li>";
        }
        else if($this->contenu != '')
        {
            if(!$this->checkSize())
                $erreur .= '<li>' . $this->msgErrorSize() . "</li>";
            if(!$this->checkFormat())
                $erreur .= '<li>' . $this->msgErrorFormat() . "</li>";
            if(!$this->checkValue())
                $erreur .= '<li>' . $this->msgErrorValue() . "</li>";
        }
        
        $erreur .= '</ul>';
        
        echo $erreur;
    }
}

?>