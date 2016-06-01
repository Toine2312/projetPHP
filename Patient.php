<div class="pageInterne">
	<!-- Suppression des patients -->
	<?php
		if (isset($_GET['idPatient']) && isset($_GET['suppr'])){
			$id=$_GET['idPatient'];
				include"./ConnexionBDD.php";
				$req = $linkpdo->prepare('DELETE FROM patient WHERE idPatient = :id');
				$req->execute(array('id' => $id));
				echo "<center><h2>Contact supprimé avec succes !</h2></center>";
				echo "<meta http-equiv='refresh' content='1; URL=./?patients=ok''></meta>";
		}
	?>

	<!-- Modification des patients -->
	<?php
	if (isset($_POST['id']) && isset($_POST['modif'])) {
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


	if (isset($_GET['idPatient'])  && isset($_GET['modif'])){
		$id=$_GET['idPatient'];
		include"./ConnexionBDD.php";
		$req=$linkpdo->query("Select * from patient where idPatient='$id'");
		if($res=$req->fetch()) {
			echo "<H1><center>Modifier ce patient ?</center></H1>
					<form action='./?patients=ok' method='POST'>
						<table>
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
								<input type='hidden' name='patients' value='ok'>
								<input type='hidden' name='modif'>
								<td colspan=2 align='center'><input type='submit' value='Modifier'><input type='hidden' name='id' value=".$res['idPatient']."></td>
							</tr>
						</table>
					</form>
					<br>
					<br>";
		}
	}
	?>

	<!--Ajout Medecin Referant -->

	<?php
			if (isset($_POST['id']) && isset($_POST['medecinReferant'])) {
				$id=$_POST['id'];
				$idMed=$_POST['medecinReferant'];

				include"./ConnexionBDD.php";
				
				$req = $linkpdo->prepare('UPDATE patient SET idMed= :idMed WHERE idPatient= :id');
				$req->execute(array('idMed' => $idMed,
									'id' => $id));

				echo "<center><h2>Nouveau medecin referant pris en compte</h2></center>";
				echo "<meta http-equiv='refresh' content='1; URL=./?patients=ok'></meta>";
				
			}


			if (isset($_GET['idPatient']) && isset($_GET['medecinRef'])){
				$id=$_GET['idPatient'];
				include"./ConnexionBDD.php";
				$req=$linkpdo->query("Select * from patient where idPatient='$id'");
				if($res=$req->fetch()) {
					if ($res['idMed']!=NULL) {
						$req1=$linkpdo->query("Select * from medecin where idMed='".$res['idMed']."'");
						if($res1=$req1->fetch()) {
							echo "<H1><center>Le medecin referant de ".$res['civiliteP']." ".$res['nomP']." ".$res['prenomP']." est le Docteur ".$res1['prenomM']." ".$res1['nomM']."</center></H1>
								<center>Si vous voulez changer de medecin referant, veillez selectionner celui desirer dans la liste ci-dessous<center>
								<br>
								<br> 
								<form action='./?patients=ok' method='POST'>
									<table align='center' id='tableau'>
										<tr>
											<td>Nom</td>
											<td>Prenom</td>
											<td>    =>       </td>
											<td>Medecin</td>
										</tr>
										<tr>
											<td>".$res['nomP']."</td>
											<td>".$res['prenomP']."</td>
											<td>   </td>
											<td><select name='medecinReferant'>";
											$req2=$linkpdo->query("Select * from medecin");
												while ($res2=$req2->fetch()) {		
														echo "<option value=\"".$res2['idMed']."\">Docteur ".$res2['prenomM']." ".$res2['nomM']."</option>";				
												}
											echo "</select>
											<td colspan=2 align='center'><input type='submit' value='Valider'><input type='hidden' name='id' value=".$res['idPatient']."></td>
										</tr>
									</table>
								</form>
								<br>
								<br>";
						}
					}else{
						echo "<H1><center>Choisissez un medecin referant pour ".$res['civiliteP']." ".$res['nomP']." ".$res['prenomP']." </center></H1>
							<form action='./?patients=ok' method='POST'>
								<table align='center' id='tableau'>
									<tr>
										<td>Nom</td>
										<td>Prenom</td>
										<td>=></td>
										<td>Medecin</td>
									</tr>
									<tr>
										<td>".$res['nomP']."</td>
										<td>".$res['prenomP']."</td>
										<td>   </td>
										<td><select name='medecinReferant'>";
												$req3=$linkpdo->query("Select * from medecin");
												while ($res3=$req3->fetch()) {
													echo "<option value=\"".$res3['idMed']."\">Docteur ".$res3['prenomM']." ".$res3['nomM']."</option>";
												}
										echo "</select>
										<td colspan=2 align='center'><input type='submit' value='Valider'><input type='hidden' name='id' value=".$res['idPatient']."></td>
									</tr>
								</table>
							</form>
							<br>
							<br>";
					}
				}
			}
		?>


	<!--Ajout de patient -->
	<?php
	if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['dateNaissance']) && isset($_POST['numSS']) && isset($_POST['ajout'])) {
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
		echo "<meta http-equiv='refresh' content='1; URL=./?patients=ok''></meta>";
	}
	?>

	<H1><center>Nos Patients</center></H1>
	<table id="tableauPatient">
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
	<form action="./?patients=ok" method="POST"  id="ajoutPatient">
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
			<input type="hidden" name="patients" value="ok">
			<input type="hidden" name="ajout">
			<td colspan=3 style='text-align:center;'><input type="submit" value="Ajouter"></td>
		</tr>
	</form>
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
					<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
					<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
					<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
				</tr>";
		}
		?>
	</table>
</div>
