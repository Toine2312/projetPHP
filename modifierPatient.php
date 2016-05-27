<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="Patient.css" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<TITLE>Carnet de Patient</TITLE>
</head>
<body>
	<div class="container">
		<?php
			if (isset($_POST['id'])) {
				$civiliteP=$_POST['civilite'];
				$nom=$_POST['nom'];
				$prenom=$_POST['prenom'];
				$adresse=$_POST['adresse'];
				$cp=$_POST['cp'];
				$ville=$_POST['ville'];
				$dateNaissanceP=$_POST['dateNaissance'];
				$lieuNaissanceP=$_POST['lieuNaissance'];
				$numSS=$_POST['numSS'];
				$id=$_POST['id'];

				include"./ConnexionBDD.php";
				
				$req = $linkpdo->prepare('UPDATE patient SET civiliteP= :nvCivilite, nomP= :nvNom, prenomP= :nvPrenom, adresseP= :nvAdresse, cpP= :nvCp, villeP= :nvVille, dateNaissanceP= :nvDateNaiss, lieuNaissanceP= :nvLieuNaiss, numSS= :nvNumSS WHERE idPatient= :id');
				$req->execute(array('nvCivilite' => $civiliteP,
									'nvNom' => $nom,
									'nvPrenom' => $prenom,
									'nvAdresse' => $adresse,
									'nvCp' => $cp,
									'nvVille' => $ville,
									'nvDateNaiss' => $dateNaissanceP,
									'nvLieuNaiss' => $lieuNaissanceP,
									'nvNumSS' => $numSS,
									'id' => $id));

				echo "<center><h2>Contact modifié avec succes !</h2></center>";
				echo "<meta http-equiv='refresh' content='1; URL=./?patients=ok'></meta>";
				
			}


			if (isset($_GET['idPatient'])){
				$id=$_GET['idPatient'];
				include"./ConnexionBDD.php";
				$req=$linkpdo->query("Select * from patient where idPatient='$id'");
				if($res=$req->fetch()) {
					echo "<H1><center>Modifier ce patient ?</center></H1>
							<form action='modifierPatient.php' method='POST'>
								<table align='center' bgcolor='D8D8D8' style='border-radius: 10px'>
									<tr>
										<td>Civilit&eacute;</td>
										<td>Nom</td>
										<td>Prenom</td>
										<td>Adresse</td>
										<td>Code postal</td>
										<td>Ville</td>
										<td>Date de Naissance</td>
										<td>Lieu de Naissance</td>
										<td>Numero Securit&eacute; Social</td>
									</tr>
									<tr>";
								if ($res['civiliteP']=='M.') {
									echo "<td><select name='civilite'><option value='M.' selected='selected'>M.</option><option value='Mme.'>Mme.</option></select></td>";
								}else{
									echo "<td><select name='civilite'><option value='Mme.' selected='selected'>Mme.</option><option value='M.'>M.</option></select></td>";
								}
									echo "<td><input type='text' name='nom' value=\"".$res['nomP']."\" id='tdNom_Prenom_Ville'></td>
										<td><input type='text' name='prenom' value=\"".$res['prenomP']."\" id='tdNom_Prenom_Ville'></td>
										<td><input type='text' name='adresse' value=\"".$res['adresseP']."\" id='tdadresse'></td>
										<td><input type='text' name='cp' value=\"".$res['cpP']."\" id='tdCp'></td>
										<td><input type='text' name='ville' value=\"".$res['villeP']."\" id='tdNom_Prenom_Ville'></td>
										<td><input type='date' name='dateNaissance' value=\"".$res['dateNaissanceP']."\" id='tdDate_Lieu_Naiss'></td>
										<td><input type='text' name='lieuNaissance' value=\"".$res['lieuNaissanceP']."\" id='tdDate_Lieu_Naiss'></td>
										<td><input type='text' name='numSS' value=\"".$res['numSS']."\" id='tdNumSS'></td>
										<td colspan=2 align='center'><input type='submit' value='Oui, Modifier'><input type='hidden' name='id' value=".$res['idPatient']."></td>
									</tr>
								</table>
							</form>
							<center><a href='./?patients=ok'>Non, Retour</a></center>";
				}
			}
		?>
		
	</div>
</body>
</HTML>


