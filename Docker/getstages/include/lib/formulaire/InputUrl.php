<?php

class InputUrl extends Input
{
    public function __construct($nom, $label, $facultatif = true)
    {
        Input::__construct($nom, 'date', $label, 6, 12, $facultatif);
    }
    
    protected function msgErrorFormat() {return "Url invalide.";}
    
    protected function checkFormat()
    {
        return preg_match('#^http[s]?:\/\/[\w\-\_]+(\.[\w\-\_]+)*\.[a-z]{2,16}(\/[\w\-\_]+((\/[\w\-\_]+)*\.[a-z]{1,32})?)?$#', $this->contenu);
    }
    
}

?>