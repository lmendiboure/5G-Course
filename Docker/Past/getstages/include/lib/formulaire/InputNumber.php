<?php

class InputNumber extends Input
{
    public function __construct($nom, $label, $min, $max, $facultatif = true)
    {
        Input::__construct($nom, 'number', $label, $min, $max, $facultatif);
    }
    
    public function getSafeContenu() {return intval($this->contenu);}
    
    protected function msgErrorSize() {return "Le nombre doit être compris entre ".$this->min." et ".$this->max.".";}
    protected function msgErrorFormat() {return "Ce champs ne doit contenir que des chiffres.";}
    
    protected function checkSize()
    {
        $nb = intval($this->contenu);
        if($nb >= $this->min && $nb < $this->max)
            return true;
        return false;
    }
    
    protected function checkFormat()
    {
        return !preg_match('#[^0-9]#', $this->contenu);
    }
    
}

?>