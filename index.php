<?php
	session_start();
	//$_SESSION["etat"]="Connexion"
?>
<!DOCTYPE HTML>
<html>
	<head>	
		<title>Cabinet Medical</title>
		<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
	</head>
	<body>
		<div class="container">
			<header id="header">
					<div id="logoAccueil">
						<a href="index.php"><img src="cabinetMedical2.jpg" alt="CabMed"></a>
					</div>
					<div id="connexion">
						<form method="POST" action="./">
							<table>
								<tr>
									<td><input type="text" placeholder="Identifiant" name="login"<?php if(isset($_SESSION["login"])){ echo 'value="'.$_SESSION["login"].'"';} ?>></td>
									<td><input type="password" name="mdp" placeholder="Mot de passe" <?php if(isset($_SESSION["login"])){ echo 'value="'.$_SESSION["mdp"].'"';} ?>></td>
									<td><input type="submit" name="conn" value=<?php echo "\".$_SESSION["etat"].\"" ?>></td>
								</tr>
							</table>
						</form>
					</div>
					<?php if(isset($_SESSION["login"])){ ?>
					<div id ="menu">
						<nav>
							<li><a href="?consult=ok">CONSULTATIONS</a></li>
							<li><a href="?patients=ok">PATIENTS</a></li>
							<li><a href="?medecins=ok">MEDECINS</a></li>
							<li><a href="?statistiques=ok">STATISTIQUES</a></li>
						</nav>
					</div>
					<?php } ?>
			</header>
		</div>
	</body>
</html>
<?php
if(isset($_POST["conn"])){
		include("connexion.php");
}
if(isset($_SESSION["login"])){
	if(isset($_GET["consult"])){
		include("listeRDV.php");
	}
	elseif (isset($_GET["patients"])) {
		include("patients.php");
	}
	elseif (isset($_GET["medecins"])) {
		include("medecins.php");
	}
	elseif (isset($_GET["statistiques"])) {
		include("statistiques.php");
	}
	else{
		include("accueil.php");
	}
}
else{
	include("accueil.php");
}
?>