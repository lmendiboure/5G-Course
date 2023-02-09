<?php

class Colonne
{
    private $nom;
    private $champs;
    private $champsName;
    private $format;
    private $show;
    private $displayOnEmpty;
    
    public function __construct($nom, $champs, $format, $show = true, $displayOnEmpty = false, $champsName = '')
    {
        if(!is_array($champs))
        {
            $champs = preg_split('/( )*,( )*/', $champs);
        }
        
        if(!is_array($champsName))
        {
            if($champsName != '')
                $champsName = preg_split('/( )*,( )*/', $champsName);
            else
                $champsName = array();
        }
        
        $this->nom = $nom;
        $this->champs = $champs;
        $this->champsName = $champsName;
        $this->format = $format;
        $this->show = $show;
        $this->displayOnEmpty = $displayOnEmpty;
        
        for($i = 0; $i < count($this->champs); $i++)
        {
            $champsReplace = preg_replace('/^([a-zA-Z0-9_\-]+\.)?([a-zA-Z0-9_\-]+)$/', '$2', $this->champs[$i]);
       
            array_push($this->champsName, $champsReplace);
            
            //echo $this->champs[$i] . " : " .  $this->champsName[$i] . "<br />";
        }
    }
    
    public function isShow()
    {
        return $this->show;
    }

    private function makeKeyArray($donnees)
    {
        $array = array();
        
        for($i = 0; $i < count($this->champsName); $i++)
        {
            array_push($array, $donnees[$this->champsName[$i]]);
        }
        
        return $array;
    }
    
    private function makeCell($content, $isHeader)
    {
        $param = '';
        $cell = '';
        
        if(!$this->show)
            $param = ' style="display: none;"';
    
        if($isHeader == true)
            $cell = 'th';
        else
            $cell = 'td';
        
        return '<' . $cell . $param . '><span>' . $content . '</span></' . $cell . '>';
    }

    private function formatString($donnees)
    {
        $array = $this->makeKeyArray($donnees);
        
        if(!$this->displayOnEmpty)
        {
            $empty = true;
            for($i = 0; $i < count($array); $i++)
            {
                if($array[$i] != '')
                    $empty = false;
            }
            
            if($empty)
                return '';
        }
        
        $format_output = preg_replace_callback('/\$(\d+)/', 
            function($matches) use ($array)
            {
                $offset = intval($matches[1]);
                
                if($offset && $offset <= count($array))
                    return $array[$offset - 1];
                
                return '';
            }, $this->format);
            
        return $format_output;
    }
    
    public function getCell($donnees)
    {
        return $this->makeCell($this->formatString($donnees), false);
    }
    
    public function getChamps()
    {
        return $this->champs;
    }
    
    public function getTitre()
    {
        return $this->makeCell($this->nom, true);
    }
}

?>