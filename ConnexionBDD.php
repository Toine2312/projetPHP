<?php
///Connexion au serveur MySQL
	
	$server = "mysql.hostinger.fr";
	$db = "u359973717_gcm";
	$login = "u359973717_fanny";
	$mdp = "tagada66";

	try { 
		$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
	} 
	catch (Exception $e) { 
		die('Erreur : '.$e->getMessage()); 
   	}
 ?>
