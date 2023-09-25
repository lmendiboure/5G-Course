<?php

class InputSelectSQL extends InputSelect
{
    public function __construct($nom, $label, $bdd, $sql, $facultatif = false)
    {
        InputSelect::__construct($nom, $label, $facultatif);
        
        $reponse = $bdd->query($sql);
        while($donnees = $reponse->fetch())
        {
            $this->addRow($donnees['id'], $donnees['name']);
            
        }
        $reponse->closeCursor();
    }
}

?>