<?php

class InputHidden extends Input
{
    private $valueId;
    private $valueDisplay;
    
    public function __construct($nom, $label, $valueId, $valueDisplay)
    {
        Input::__construct($nom, 'hidden', $label, 0, 1024, false);
        
        $this->valueId = $valueId;
        $this->valueDisplay = $valueDisplay;
        
        $this->contenu = $this->valueId;
    }
    
    public function getContenu() {return $this->valueId;}
    public function getSafeContenu() {return $this->valueId;}
    
    protected function msgErrorFormat() {return "Erreur de saisie";}
    
    public function afficherInput()
    {
        Input::afficherInput();
        
        echo '<input type="text" value="' . $this->valueDisplay . '" disabled />';
    }
    
}

?>