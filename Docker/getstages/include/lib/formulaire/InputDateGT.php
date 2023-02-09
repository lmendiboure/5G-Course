<?php

class InputDateGT extends InputDate
{
    protected $otherInputDate;

    public function __construct($nom, $label, $facultatif = true)
    {
        InputDate::__construct($nom, $label, $facultatif);
        
        $this->otherInputDate = null;
    }
    
    public function setOtherInputDate($otherInputDate)
    {
        $this->otherInputDate = $otherInputDate;
    }
    
    protected function msgErrorValue() 
    {
        $date = date('d/m/Y', strtotime($this->otherInputDate->getContenu()));
        return 'Vous devez sélectionner une date au-delà du '.$date.'.';
    }
    
    protected function checkValue() 
    {
        if($this->otherInputDate != null)
        {
            if(strtotime($this->otherInputDate->getContenu()) >= strtotime($this->contenu))
                return false;
        }
        
        return true;
    }
    
    
}

?>