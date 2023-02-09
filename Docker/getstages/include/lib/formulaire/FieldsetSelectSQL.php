<?php

class FieldsetSelectSQL extends Fieldset
{
    public function __construct($nom, $label, $bdd, $sql)
    {
        Fieldset::__construct($label);
        
        $arrayInput = array();

        $inputSelectMultiple = new InputSelect($nom, $label, true);
        $inputSelectMultiple->setMultipleOption(true);
        
        $reponse = $bdd->query($sql);
        while($donnees = $reponse->fetch())
        {
            $inputSelectMultiple->addRow($donnees['id'], $donnees['name']);
        }
        $reponse->closeCursor();

        $this->addInput($inputSelectMultiple);
    }

    public function setContenuSQL($bdd, $sql)
    {
        if(isset($_GET['id']))
        {
            $arrayMultiple = array();

            $prepare = $bdd->prepare($sql);
            $prepare->execute(array($_GET['id']));
            while($donnees = $prepare->fetch())
            {
                $arrayMultiple[] = $donnees['id'];
            }

            foreach($this->liste as $key => $value)
                $value->setContenu($arrayMultiple);
        }
    }
    
    public function getContenu()
    {
        foreach($this->liste as $key => $value)
            return $value->getContenu();
        
        return array();
    }
}

?>