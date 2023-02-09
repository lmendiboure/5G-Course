<?php
include_once 'include/function/f_bdd.php';
include_once 'include/function/f_menu.php';

abstract class Page 
{
    private $menu;
    private $droitAdmin;
    private $connectionError;
    protected $userInfo;
    protected $bdd;
    
    public function __construct($droitAdmin = false)
    {
        session_start();
        $this->bdd = connexionBDD();
        $this->userInfo = null;
        $this->connectionError = "";
        $this->connectUser();
        $this->menu = makeMenu(false, $this->userIsConnect());
        $this->droitAdmin = $droitAdmin;
        
    }
    
    private function connectUser()
    {
        if(isset($_POST['login']) && isset($_POST['mdp']))
        {

            $login = filter_input(INPUT_POST,"login");
            $mdp = filter_input(INPUT_POST,"mdp");
            $type = filter_input(INPUT_POST,"type");
            
            if($type == "eleve"){
                $req = 'SELECT * FROM etudiant JOIN classe ON etudiant.num_classe = classe.num_classe WHERE login = "' . $login . '" and mdp = "'.$mdp.'"';
                $is_prof = false;
            }
            else{
                $req = 'SELECT * FROM professeur WHERE login = "' . $login . '" and mdp = "'.$mdp.'"';
                $is_prof = true;               
            }
            
            $user = $this->bdd->query($req);
            $data = $user->fetch();

            if(!empty($data)){
                $userInfo['login'] = $data['login']; 
				$userInfo["is_professeur"] = $is_prof;
				
				if(!$is_prof){
				//pour les étudiants
				 
					$userInfo["classe"] = $data['nom_classe'];
					$userInfo["bts"] = $data['nom_classe'];
					$userInfo['prenom'] = $data['prenom_etudiant'];
					$userInfo['nom'] = $data['nom_etudiant'];
				}
				else {
				//pour les profs	
					$userInfo['prenom'] = $data['prenom_prof'];
					$userInfo['nom'] = $data['nom_prof'];		
				}
                
                $_SESSION['user_info'] = $userInfo;
                $this->userInfo = $userInfo;              
            }
            else{
                $this->connectionError = "Vous n'êtes pas autorisé à vous connecter à cette application";
            }

        }
        else if(isset($_SESSION['user_info'])){
            $this->userInfo = $_SESSION['user_info'];
        }
    }
    
    protected function userIsConnect()
    {
        return $this->userInfo != null;
    }
    
    public function run()
    {
        $errorCatch = "";
        if($this->userIsConnect() == true && $this->droitAdmin == false && $this->bdd != false)
        {
            try
            {
                $this->init();
            }
            catch(Exception $e)
            {
                $errorCatch .= $e->getMessage() . '<br />';
            }
        }

        $this->afficherTop();
        if(!$this->userIsConnect()){
            $this->afficherDeconnecter();
        }
        elseif($this->droitAdmin == true){
            $this->afficherErreurDroitAdmin();
        }
        elseif($this->bdd == false){
            $this->afficherErreurBdd();
        }
        else
        {
            try
            {
                $this->afficherContent();
            }
            catch(Exception $e)
            {
                $errorCatch .= $e->getMessage() . '<br />';
            }
        }
        
        if($errorCatch != "" && $this->userInfo['is_professeur'])
        {
            echo '<div class="message">' . $e->getMessage() . '</div>';
        }
        
            
        $this->afficherBottom();
    }
    
    protected function init() {}
    abstract protected function afficherContent();
    
    protected function havePostId()
    {
        return isset($_GET['id']);
    }
    
    protected function getPostId()
    {
        return intval($_GET['id']);
    }
    
    private function afficherErreurBdd()
    {
        ?>
        <div class="message">Erreur lors de la connexion à la base de données</div>
        <?php
    }
    
    private function afficherErreurDroitAdmin()
    {
        ?>
        <div class="message">Vous n'avez pas le droit d'accéder à cette page</div>
        <?php
    }
    
    private function afficherDeconnecter()
    {
        ?>
        <div class="message">
            <h1>Gestion des stages</h1>
            Vous n'êtes pas connecté.<br />
            Identifiez-vous pour poursuivre la navigation.
        </div>
        <br />
        
        <form action="" method="POST">
            <table class="connection">
                <tr>
                    <td><label for="login">Login : </label></td>
                    <td><input type="text" name="login" id="login" /></td>
                </tr>
                <tr>
                    <td><label for="mdp">Mot de passe : </label></td>
                    <td><input type="password" name="mdp" id="mdp" /></td>
                </tr>
                <tr>
                    <td><label for="type">Vous êtes : </label></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align:right;"><label for="eleve">Etudiant</label></td>
                    <td><input type="radio" name="type" value="eleve" /></td>
                </tr>
                <tr>
                	<td style="text-align:right;"><label for="prof">Professeur </label></td>
                    <td><input type="radio" name="type" value="prof" /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" name="connection" value="Connexion" />
                    </td>
                </tr>
                <?php
                if($this->connectionError != "")
                {
                    echo '<tr><td colspan="2"><br />Erreur : ' . $this->connectionError . '</td></tr>';
                }
                ?>
            </table>
        </form>
        
        <?php
    }
    
    private function afficherTop()
    {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8" />
                <title>
                    Stage BTS
                </title>
                <link rel="stylesheet" href="style/bouton.css">
                <link rel="stylesheet" href="style/formulaire.css">
                <link rel="stylesheet" href="style/general.css">
                <link rel="stylesheet" href="style/tableau.css">
            </head>
            <body <?php if($this->menu->isReduit()) echo 'class="reduit"'; ?>>
                <?php
                    $this->menu->afficher();
                ?>
                <div id="corps">
                    <section id="contenu">
        <?php
    }
    
    private function afficherBottom()
    {
        ?>
                     
                    </section>
                </div>
                
                <?php $this->menu->appliquerScript(); ?>
            </body>
        </html>
        <?php
    }
    
    

}


?>