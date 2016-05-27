<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="Medecin.css" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<TITLE>Medecins</TITLE>
</head>
<body>
	<div class="container">
<?php
if (isset($_POST['nom']) && isset($_POST['prenom'])) {
	$civiliteM=$_POST['civilite'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];

	include ("./ConnexionBDD.php");
	
	$req = $linkpdo -> prepare ('insert into medecin (civiliteM, nomM, prenomM) values (:civiliteM,:nom,:prenom)');
	$req -> execute(array('civiliteM'=>$civiliteM, 
						'nom'=>$nom, 
						'prenom'=>$prenom));
	echo "<center><H2>Medecin ajouter a la base<br></H2><center>";
	echo "<meta http-equiv='refresh' content='1; URL=./?medecins=ok''></meta>";
}
?>
	</div>
</body>
</HTML>