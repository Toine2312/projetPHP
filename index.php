<?php
	session_start();
	if (isset($_SESSION["etat"])) {
		$_SESSION["etat"]="Connexion";
	}
	
	include("ConnexionBDD.php");
?>
<!DOCTYPE HTML>
<html>
	<head>	
		<title>Cabinet Medical</title>
		<link rel="icon" type="image/png" href="./logoPetitMedical.ico" />
		<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="Patient.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="Medecin.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="Stat.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="rdv.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="calendrier.css" media="all"/>
	</head>
	<body>
			<header>
					<div id="logoAccueil">
						<a href="index.php"><img src="logoSite.png" alt="CabMed"></a>
					</div>
					<div id="headerDroite">
						<div id="connexion">
							<form method="POST" action="./" id="formulaireCo">
								<table>
									<tr>
										<td><input type="text" placeholder="Identifiant" name="login"<?php if(isset($_SESSION["login"])){ echo 'value="'.$_SESSION["login"].'"';} ?>></td>
										<td><input type="password" name="mdp" placeholder="Mot de passe" <?php if(isset($_SESSION["login"])){ echo 'value="'.$_SESSION["mdp"].'"';} ?>></td>
										<td><input type="submit" name="conn" value=<?php echo '"'.$_SESSION["etat"].'"'; ?>></td>
									</tr>
								</table>
							</form>
						</div>
						<?php if(isset($_SESSION["login"])){ ?>
						<div id ="menu">
							<nav>
								<?php echo "<li><a href='?consult=ok&mois=".date("n")."'>CONSULTATIONS</a></li>"?>
								<li><a href="?patients=ok">PATIENTS</a></li>
								<li><a href="?medecins=ok">MEDECINS</a></li>
								<li><a href="?statistiques=ok">STATISTIQUES</a></li>
							</nav>
						</div>
					</div>
					<?php } ?>

			</header>
			<hr id="BandeColor">
			<div class="container">
			<?php
				if(isset($_POST["conn"])){
						include("connexion.php");
				}
				if(isset($_SESSION["login"])){
					if(isset($_GET["consult"]) || isset($_POST["consult"])){
						include("rdv.php");
					}
					elseif (isset($_GET["patients"]) || isset($_POST["patients"])) {
						include("Patient.php");
					}
					elseif (isset($_GET["medecins"])) {
						include("Medecin.php");
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
		</div>
		<footer>
			<p>
				Nous contacter : antoineperot23@gmail.com / fannydaudies@gmail.com
				<br>2016, Copyright A.perot & F.daudies
			</p>	
		</footer>
	</body>
</html>
