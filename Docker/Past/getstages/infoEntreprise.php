<?php
include_once 'include/lib/libPage.php';

class PageInfoEntreprise extends PageInformation
{
    protected function init()
    {
        $fieldInfo = new Fieldset('Information');
        $fieldInfo->addInput(new InputString("raison_sociale", "Nom de l'entreprise", InputStringType::Alpha, 2, 128, false));
        $fieldInfo->addInput(new InputString("nom_contact", "Nom du contact", InputStringType::Alpha, 2, 64, true));
        $fieldInfo->addInput(new InputString("nom_resp", "Nom du responsable", InputStringType::Alpha, 2, 64, true));

        $fieldContact = new Fieldset('Contact');
        $fieldContact->addInput(new InputString("rue_entreprise", "Rue", InputStringType::Alpha, 2, 92, false));
        $fieldContact->addInput(new InputNumber("cp_entreprise", "Code postal", 1000, 100000, false));
        $fieldContact->addInput(new InputString("ville_entreprise", "Ville", InputStringType::Alpha, 2, 32, false));
        $fieldContact->addInput(new InputString("tel_entreprise", "Téléphone", InputStringType::NumTelephone, 10, 32, false));
        $fieldContact->addInput(new InputString("fax_entreprise", "Fax", InputStringType::NumTelephone, 10, 32, true));
        $fieldContact->addInput(new InputString("email", "Email", InputStringType::AdresseMail, 2, 92, true));

        $fieldDivers = new Fieldset('Divers');
        $fieldDivers->addInput(new InputTextarea("observation", "Observation", 0, 2048, true));
        $fieldDivers->addInput(new InputString("site_entreprise", "Url de site", InputStringType::Url, 2, 92, true));
        $fieldDivers->addInput(new InputString("niveau", "Niveau", InputStringType::Any, 2, 92, false));
        $fieldDivers->addInput(new InputTextarea("specialite", "Specialité", 0, 2048, true));
        

        $formulaire = new Formulaire();
        $formulaire->addFieldset($fieldInfo);
        $formulaire->addFieldset($fieldContact);
        $formulaire->addFieldset($fieldDivers);

        $tableau = new Tableau();
        $tableau->addColonne(new Colonne("Opération", 'etudiant.num_etudiant', '
            <span class="center bouton_operation">
                <a title="voir" class="icon_voir" href="infoStagiaire.php?id=$1"></a>
            </span>'));
        $tableau->addColonne(new Colonne("Etudiant", 'nom_etudiant, prenom_etudiant', '$1 $2'));
        $tableau->addColonne(new Colonne("Projet", 'desc_projet', '$1'));

        $tableau_sql = new TableauSQL($tableau, $this->bdd, 
            "stage JOIN etudiant ON stage.num_etudiant=etudiant.num_etudiant
            JOIN entreprise ON stage.num_entreprise=entreprise.num_entreprise
            WHERE entreprise.num_entreprise = ".$this->getPostId(), 
            "nom_etudiant, prenom_etudiant");
        
        $this->setFormulaire($formulaire);
        $this->setTableauSQL($tableau_sql);
        $this->fillSQLUpdate(
            'SELECT *, GROUP_CONCAT(libelle SEPARATOR ", ") AS specialite 
            FROM entreprise 
            JOIN spec_entreprise ON spec_entreprise.num_entreprise = entreprise.num_entreprise
            JOIN specialite ON spec_entreprise.num_spec = specialite.num_spec
            WHERE entreprise.num_entreprise = ?
            GROUP BY entreprise.num_entreprise, spec_entreprise.num_spec');
        $this->setTitre($formulaire->getSafeContenu("raison_sociale"));
    }
}

$page = new PageInfoEntreprise();
$page->run();


?>