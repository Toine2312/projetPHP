<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="patient.css" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<TITLE>Carnet de Patient</TITLE>
</head>
<body>
	<div class="container">
<?php
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['dateNaissance']) && isset($_POST['numSS'])) {
	$civiliteP=$_POST['civilite'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$adresse=$_POST['adresse'];
	$cp=$_POST['cp'];
	$ville=$_POST['ville'];
	$dateNaissanceP=$_POST['dateNaissance'];
	$lieuNaissanceP=$_POST['lieuNaissance'];
	$numSS=$_POST['numSS'];

	include ("./ConnexionBDD.php");
	
	$req = $linkpdo -> prepare ('insert into patient (civiliteP, nomP, prenomP, adresseP, cpP, villeP, dateNaissanceP, lieuNaissanceP, numSS) values (:civiliteP,:nom,:prenom,:adresse,:cp,:ville,:dateNaissance,:lieuNaissance,:numSS)');
	$req -> execute(array('civiliteP'=>$civiliteP, 
						'nom'=>$nom, 
						'prenom'=>$prenom, 
						'adresse'=>$adresse, 
						'cp'=>$cp, 
						'ville'=>$ville, 
						'dateNaissance'=>$dateNaissanceP, 
						'lieuNaissance'=>$lieuNaissanceP, 
						'numSS'=>$numSS));
	echo "<center><H2>Contact ajouter a la base<br></H2><center>";
	echo "<meta http-equiv='refresh' content='2; URL=http://localhost/Tpdut/DUTToulouse/ExCours/GestionCabinetMedical/Patient.php'></meta>";
}
?>
	</div>
</body>
</HTML>