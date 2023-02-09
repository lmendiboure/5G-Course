<?php

class InputTextarea extends Input
{
    public function __construct($nom, $label, $min = 0, $max = 524288, $facultatif = true)
    {
        Input::__construct($nom, 'textarea', $label, $min, $max, $facultatif);
    }
    
    public function afficherInput()
    {
        echo '<textarea id="' . $this->nom;
        echo '" name="' . $this->nom;
        echo '" maxlength="' . $this->max;
        echo '">' . $this->contenu . '</textarea>';
    }
}

?>