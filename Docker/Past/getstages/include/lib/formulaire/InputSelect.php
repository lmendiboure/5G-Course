<?php

class InputSelect extends Input
{
    protected $array;
    protected $isMultiple;
    
    public function __construct($nom, $label, $facultatif = false)
    {
        Input::__construct($nom, 'select', $label, 0, 0, $facultatif);
        $this->array = array();
        $this->isMultiple = false;
    }

    public function setMultipleOption($isMultiple)
    {
        $this->isMultiple = $isMultiple;
    }
    
    protected function checkSize() {return true;}
    
    protected function checkValue()
    {
        if(is_array($this->contenu))
        {
            $valueOk = true;

            foreach($this->contenu as $key => $value)
            {
                if(!isset($this->array[$value]))
                    $valueOk = false;
            }

            return $valueOk;
        }
        else
        {
            return isset($this->array[$this->contenu]);
        }
    }
    
    public function addRow($key, $value)
    {
        $this->array[$key] = $value;
    }
    
    public function afficherInput()
    {
        echo '<select ';

        if($this->isMultiple)
            echo 'multiple ';

        echo 'name="' . $this->nom;

        if($this->isMultiple)
            echo '[]';

        echo '" id="' . $this->nom . '">';
        
        $array_key = array_keys($this->array);
        
        for($i = 0; $i < count($array_key); $i++)
        {
            echo '<option value="' . $array_key[$i] . '"';
            if(is_array($this->contenu))
            {
                foreach($this->contenu as $key => $value)
                {
                    if($value == $array_key[$i])
                        echo 'selected';
                }
            }
            else
            {
                if($this->contenu == $array_key[$i])
                    echo 'selected';
            }
            echo '>' . $this->array[$array_key[$i]] . '</option>';
        }
        
        echo '</select>';
    }
}

?>