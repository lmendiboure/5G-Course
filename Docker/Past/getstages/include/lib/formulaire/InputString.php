<?php

class InputString extends Input
{
    protected $char_accept;

    public function __construct($nom, $label, $char_accept, $min, $max, $facultatif = true)
    {
        $type = 'text';
        
        $this->char_accept = $char_accept;
        switch($this->char_accept)
        {
            case InputStringType::NumTelephone:
                $type = 'tel';
                break;
            case InputStringType::AdresseMail:
                $type = 'email';
                break;
            case InputStringType::Url:
                $type = 'url';
                break;
        }
    
        Input::__construct($nom, $type, $label, $min, $max, $facultatif);
    }
    
    protected function msgErrorFormat() 
    {
        switch($this->char_accept)
        {
            case InputStringType::Any:
                return "";
            case InputStringType::Num:
                return "Ce champs ne doit contenir que des chiffres.";
            case InputStringType::Alpha:
                return "Ce champs ne doit contenir que des lettres.";
            case InputStringType::AlphaNum:
                return "Ce champs ne doit contenir que des lettres et/ou des chiffres.";
            case InputStringType::NumTelephone:
                return "Numero de telephone invalide.";
            case InputStringType::AdresseMail:
                
            case InputStringType::Url:
                
        
        }
    
        return "";
    }
    
    protected function checkFormat()
    {
        switch($this->char_accept)
        {
            case InputStringType::Any:
                return true;
            case InputStringType::Num:
                return preg_match('#^[0-9\ ]*$#', $this->contenu);
            case InputStringType::Alpha:
                return preg_match('#^[a-zA-Z\ éèàù\-\_,\']*$#', $this->contenu);
            case InputStringType::AlphaNum:
                return preg_match('#^[\w\ éèàù\-\_,]*$#', $this->contenu);
            case InputStringType::NumTelephone:
                return preg_match('#^((([0-9]{2}[ ]?){5})|((\+|00[ ]?)[0-9]{2}[ ]?[0-9][ ]?([0-9]{2}[ ]?){4}))$#', $this->contenu);
            case InputStringType::AdresseMail:
                
            case InputStringType::Url:
                
        }
        
        return true;
    }
    
}

?>