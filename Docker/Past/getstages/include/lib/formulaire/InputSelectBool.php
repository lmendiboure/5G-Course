<?php

class InputSelectBool extends InputSelect
{
    public function __construct($nom, $label, $true = "Oui", $false = "Non")
    {
        InputSelect::__construct($nom, $label);
        
        $this->addRow(0, $false);
        $this->addRow(1, $true);
    }
}

?>