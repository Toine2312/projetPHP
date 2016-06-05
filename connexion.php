<?php
// la connexion est basée sur le ldap inra
	$connecte=0;
	$erreur_conn=1;
	if (isset($_SESSION["login"]))
	{
		unset ($_SESSION["login"]);
		unset ($_SESSION["mdp"]);
		$_SESSION["etat"] = "Connexion";
		echo "<center>Vous &ecirc;tes d&eacute;connect&eacute;<br></center>";$erreur_conn=0;
		?><META http-equiv="refresh" content="1; URL=index.php"><?php
	}
	elseif($_POST["login"] == "Fanny" && $_POST["mdp"] == "toto"){
		$_SESSION["login"]=$_POST["login"];
		$_SESSION["mdp"]=$_POST["mdp"];
		$connecte=1;
		$erreur_conn=0;
		$_SESSION["etat"] = "D&eacute;connexion";
		?><META http-equiv="refresh" content="1; URL=index.php?consult=ok"><?php
	}
	elseif(isset($_POST["login"]) && isset($_POST["mdp"]))
	{
		if($_POST["login"] != "" && $_POST["mdp"] != "")
		{
 			$req = $linkpdo->prepare('SELECT * FROM user WHERE login = :login AND mdp= :mdp');
 			$req->execute(array('login' => $_POST["login"],
 								'mdp' => $_POST["mdp"]));
			if($data = $req->fetch())
			{
				$connecte=1;
				$erreur_conn=0;
				echo "<center>Vous &ecirc;tes connect&eacute;<br></center>";
				$_SESSION["login"]=$_POST["login"];
				$_SESSION["mdp"]=$_POST["mdp"];
				?><META http-equiv="refresh" content="1; URL=index.php"><?php
			}
			else
			{
				echo "<center>Identifiant ou mot de passe incorrect<br></center>";
			}
		}
	}
	else
	{
		echo "<center> Indiquez votre login et votre mot de passe s'il vous plait</center>";
	}
	if ($erreur_conn==1)
	{
		unset ($_SESSION["login"]);
		unset ($_SESSION["mdp"]);
	}
?>
