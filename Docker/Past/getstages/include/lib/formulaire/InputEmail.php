<?php

class InputEmail extends Input
{
    public function __construct($nom, $label, $facultatif = true)
    {
        Input::__construct($nom, 'email', $label, 6, 12, $facultatif);
    }
    
    protected function msgErrorFormat() {return "Adresse email invalide.";}
    
    protected function checkFormat()
    {
        return preg_match('#^[\w\-\_]+(\.[\w\-\_]+)*@[\w\-\_]+(\.[\w\-\_]+)*\.[a-z]{2,16}$#', $this->contenu);
    }
    
}

?>