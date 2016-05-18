<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="patient.css" />
<TITLE>Carnet de Patient</TITLE>
</head>
<body>
	<H1><center>Carnet de Patient</center></H1>
	<form action="ajoutPatient.php" method="POST"  id="ajoutPatient">
		<fieldset><legend><h1> Ajouter un patient</h1></legend>
			<table>
				<tr>
					<td>Civilit&eacute;</td>
					<td> <select name="civilite"><option value="M." selected="selected">M.</option><option value="Mme.">Mme.</option></select></td>
				</tr>
				<tr>
					<td>Nom</td>					
					<td> <input type="text" name="nom"></td>
				</tr>
				<tr>
					<td>Prenom</td>
					<td> <input type="text" name="prenom"></td>
				</tr>
				<tr>
					<td>Adresse</td>
					<td> <input type="text" name="adresse"></td>
				</tr>
				<tr>
					<td>Code postal</td>
					<td> <input type="text" name="cp"></td>
				</tr>
				<tr>
					<td>Ville</td>
					<td> <input type="text" name="ville"></td>
				</tr>
				<tr>
					<td>Date de Naissance</td>
					<td> <input type="date" name="dateNaissance"></td>
				</tr>
				<tr>
					<td>Lieu de Naissance</td>
					<td> <input type="text" name="lieuNaissance"></td>
				</tr>
				<tr>
					<td>Numero Securit&eacute; Social</td>
					<td> <input type="text" name="numSS"></td>
				</tr>
				<tr>
					<td colspan=2 style='text-align:center;'><input type="submit" value="Ajouter"></td>
				</tr>
			</table>
		</fieldset>
	</form>
	<aside>
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
		</table>
	</aside>
</body>
</HTML>