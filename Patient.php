<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="Patient.css" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<TITLE>Carnet de Patient</TITLE>
</head>
<body>
	<div class="container">
		<H1><center>Patients</center></H1>
		<table id="tableau">
			<tr id="premiereLigne">
				<td>Civilit&eacute;</td>
				<td>Nom</td>
				<td>Prenom</td>
				<td>Adresse</td>
				<td>Code postal</td>
				<td>Ville</td>
				<td>Date de naissance</td>
				<td>Lieu de naissance</td>
				<td>Numero securit&eacute; social</td>
			</tr>
			<?php
			include ("./ConnexionBDD.php");
			$req=$linkpdo->query('Select * from patient');
			while ($res=$req->fetch()) {
			echo "	<tr id='donnees'>
						<td>".$res['civiliteP']."</td>
						<td>".$res['nomP']."</td>
						<td>".$res['prenomP']."</td>
						<td>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='modifierPatient.php?idPatient=".$res['idPatient']."'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='supprimerPatient.php?idPatient=".$res['idPatient']."'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='AjoutMedecinReferant.php?idPatient=".$res['idPatient']."'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
					</tr>";
			}
			?>
			<form action="ajoutPatient.php" method="POST"  id="ajoutPatient">
				<tr>
					<td> <select name="civilite" id="tdCivilite"><option value="M." selected="selected">M.</option><option value="Mme.">Mme.</option></select></td>					
					<td> <input type="text" name="nom" id="tdNom_Prenom_Ville"></td>
					<td> <input type="text" name="prenom" id="tdNom_Prenom_Ville"></td>
					<td> <input type="text" name="adresse" id="tdadresse"></td>
					<td> <input type="text" name="cp" id="tdCp"></td>
					<td> <input type="text" name="ville" id="tdNom_Prenom_Ville"></td>
					<td> <input type="date" name="dateNaissance" id="tdDate_Lieu_Naiss"></td>
					<td> <input type="text" name="lieuNaissance" id="tdDate_Lieu_Naiss"></td>
					<td> <input type="text" name="numSS" id="tdNumSS"></td>
					<td colspan=3 style='text-align:center;'><input type="submit" value="Ajouter"></td>
				</tr>
			</form>
		</table>
	</div>
</body>
</HTML>