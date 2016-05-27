<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="Medecin.css" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<TITLE>M&eacute;decins</TITLE>
</head>
<body>
	<div class="container">
		<H1><center>M&eacute;decins</center></H1>
		<table id="tableau">
			<tr id="premiereLigne">
				<td>Civilit&eacute;</td>
				<td>Nom</td>
				<td>Prenom</td>
			</tr>
			<?php
			include ("./ConnexionBDD.php");
			$req=$linkpdo->query('Select * from medecin');
			while ($res=$req->fetch()) {
				echo "	<tr id='donnees'>
							<td>".$res['civiliteM']."</td>
							<td>".$res['nomM']."</td>
							<td>".$res['prenomM']."</td>
							<td style='text-align:center;'><a href='modifierMedecin.php?idMed=".$res['idMed']."'><IMG src='modifier.png' alt='Modifier ce contact'></a></td>
							<td style='text-align:center;'><a href='supprimerMedecin.php?idMed=".$res['idMed']."'><IMG src='supprimer.png' alt='Supprimer ce contact'></a></td>
						</tr>";
			}
			?>
			<form action="ajoutMedecin.php" method="POST"  id="ajoutMedecin">
				<tr>
					<td> <select name="civilite" id="tdCivilite"><option value="M." selected="selected">M.</option><option value="Mme.">Mme.</option></select></td>
					<td> <input type="text" name="nom" id="tdNom_Prenom"></td>
					<td> <input type="text" name="prenom" id="tdNom_Prenom"></td>
					<td colspan=2 style='text-align:center;'><input type="submit" value="Ajouter"></td>
				</tr>
			</form>
		</table>
	</div>
</body>
</HTML>