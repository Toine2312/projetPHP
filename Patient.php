<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="patient.css" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<TITLE>Carnet de Patient</TITLE>
</head>
<body>
	<div class="container">
		<H1><center>Carnet de Patient</center></H1>
		<table align="center" bgcolor="D8D8D8" style="border-radius: 10px">
			<tr>
				<td style='text-align:center;'>Civilit&eacute;</td>
				<td style='text-align:center;'>Nom</td>
				<td style='text-align:center;'>Prenom</td>
				<td style='text-align:center;'>Adresse</td>
				<td style='text-align:center;'>Code postal</td>
				<td style='text-align:center;'>Ville</td>
				<td style='text-align:center;'>Date de Naissance</td>
				<td style='text-align:center;'>Lieu de Naissance</td>
				<td style='text-align:center;'>Numero Securit&eacute; Social</td>
			</tr>
			<?php
			include ("./ConnexionBDD.php");
			$req=$linkpdo->query('Select * from patient');
			while ($res=$req->fetch()) {
			echo "	<tr>
					<td>".$res['civiliteP']."</td>
						<td>".$res['nomP']."</td>
						<td>".$res['prenomP']."</td>
						<td>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='modifierPatient.php?idPatient=".$res['idPatient']."'><IMG src='modifier.png' alt='Modifier ce contact'></a></td>
						<td style='text-align:center;'><a href='supprimerPatient.php?idPatient=".$res['idPatient']."'><IMG src='supprimer.png' alt='Supprimer ce contact'></a></td>
					</tr>";
			}
			?>
			<form action="ajoutPatient.php" method="POST"  id="ajoutPatient">
				<tr>
					<td> <select name="civilite"><option value="M." selected="selected">M.</option><option value="Mme.">Mme.</option></select></td>					
					<td> <input type="text" name="nom"></td>
					<td> <input type="text" name="prenom"></td>
					<td> <input type="text" name="adresse"></td>
					<td> <input type="text" name="cp"></td>
					<td> <input type="text" name="ville"></td>
					<td> <input type="date" name="dateNaissance"></td>
					<td> <input type="text" name="lieuNaissance"></td>
					<td> <input type="text" name="numSS"></td>
					<td colspan=2 style='text-align:center;'><input type="submit" value="Ajouter"></td>
				</tr>
			</form>
		</table>
	</div>
</body>
</HTML>