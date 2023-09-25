<?php

class InputTelephone extends Input
{
    public function __construct($nom, $label, $facultatif = true)
    {
        Input::__construct($nom, 'date', $label, 6, 12, $facultatif);
    }
    
    protected function msgErrorFormat() {return "Le format de date n'est pas valide.";}
    
    protected function checkFormat()
    {
        return preg_match('#^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$#', $this->contenu);
    }
    
}

?>