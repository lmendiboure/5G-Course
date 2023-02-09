<?php

function connexionBDD()
{
	try
	{
            $bdd = new PDO('mysql:host=servbd;port=3306;dbname=bdd_geststages;charset=utf8', 'usergs', 'mdpGS', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $bdd;
	}
	catch(Exception $e)
	{
		$pdo_error = $e->getMessage();
                return false;
	}
    
}

?>
