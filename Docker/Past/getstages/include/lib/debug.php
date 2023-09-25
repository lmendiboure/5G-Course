<?php

function debug_to_console($data) {
    if(is_array($data) || is_object($data))
	{
		echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
	} else {
		echo("<script>console.log('PHP: ".$data."');</script>");
	}
}

function testConnect(){
        //echo "test BDD : <br/>";
//    	try
//	{
//            $login = "mazpie01";
//            $mdp = "mazpie01";
//            $bdd = new PDO('mysql:host=localhost;port=3306;dbname=teststages;charset=utf8', 'usergs', 'mdpGS', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//            //$res = $bdd->query("SELECT * FROM etudiant WHERE num_etudiant=8");
//            $res = $bdd->query('SELECT * FROM etudiant JOIN classe ON etudiant.num_classe = classe.num_classe WHERE login = "' . $login . '" and mdp = "'.$mdp.'"');
//            $data = $res->fetch();
//            print_r($data);
//	}
//	catch(Exception $e)
//	{
//		$pdo_error = $e->getMessage();
//	}
}
