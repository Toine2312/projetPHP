<?php
///Connexion au serveur MySQL
	
	$server = "localhost";
	$db = "gestion_cabinet_medical";
	$login = "root";
	$mdp = "";

	try { 
		$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
	} 
	catch (Exception $e) { 
		die('Erreur : '.$e->getMessage()); 
   	}
 ?>
