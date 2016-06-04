<div class="pageInterne">
	<!-- Suppression des patients -->
	<?php
		if (isset($_GET['idPatient']) && isset($_GET['suppr'])){
			$id=$_GET['idPatient'];
				include"./ConnexionBDD.php";
				$req = $linkpdo->prepare('DELETE FROM patient WHERE idPatient = :id');
				$req->execute(array('id' => $id));
				echo "<br><p id='text'>Contact supprimé avec succes !</p>";
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

		echo "<br><p id='text'>Contact modifié avec succes !</p>";
		echo "<meta http-equiv='refresh' content='1; URL=./?patients=ok'></meta>";
		
	}


	if (isset($_GET['idPatient'])  && isset($_GET['modif'])){
		$id=$_GET['idPatient'];
		include"./ConnexionBDD.php";
		$req=$linkpdo->query("Select * from patient where idPatient='$id'");
		if($res=$req->fetch()) {
			echo "<br><p id='text'>Modifier ce patient ?</p>
					<form action='./?patients=ok' method='POST'>
						<table id='tableauPatient'>
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
								<td><input type='date' name='dateNaissance' class='date' value=\"".$res['dateNaissanceP']."\" id='tdDate_Lieu_Naiss'></td>
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

				echo "<br><p id='text'>Nouveau medecin referant pris en compte</p>";
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
							echo "<br>
								<p id='text'>Le medecin referant de <B>".$res['civiliteP']." ".$res['nomP']." ".$res['prenomP']."</B> est le Docteur <B>".$res1['prenomM']." ".$res1['nomM']."</B></p>
								<p id='text'>Si vous voulez changer de medecin referant, veillez selectionner celui desirer dans la liste ci-dessous</p>
								<br>
								<form action='./?patients=ok' method='POST'>
									<table id='tableauModif'>
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
						echo "<br>
							<p id='text'>Choisissez un medecin referant pour <B>".$res['civiliteP']." ".$res['nomP']." ".$res['prenomP']."</B> </p>
							<form action='./?patients=ok' method='POST'>
								<table id='tableauModif'>
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
		echo "<br><p id='titre'>Contact ajouter a la base<br></p>";
		echo "<meta http-equiv='refresh' content='1; URL=./?patients=ok''></meta>";
	}
	?>
	<br>
	<br>
	<p id="titre">Nos Patients</p>
	<table id="tableauPatient">
		<thead id="enteteTab">
			<tr>
				<td>Civilit&eacute; <a href='./?patients=ok&filtreCivi=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
				<td>Nom <a href='./?patients=ok&filtreNom=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
				<td>Prenom <a href='./?patients=ok&filtrePrenom=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
				<td>Adresse <a href='./?patients=ok&filtreAdresse=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
				<td>Code postal <a href='./?patients=ok&filtreCp=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
				<td>Ville <a href='./?patients=ok&filtreVille=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
				<td>Date de naissance <a href='./?patients=ok&filtreDate=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
				<td>Lieu de naissance <a href='./?patients=ok&filtreLieu=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
				<td>N&ordm; securit&eacute; social <a href='./?patients=ok&filtreNSS=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
			</tr>
		<form action="./?patients=ok" method="POST"  id="ajoutPatient">
			<tr>
				<td> <select name="civilite" id="tdCivilite"><option value="M." selected="selected">M.</option><option value="Mme.">Mme.</option></select></td>					
				<td> <input type="text" name="nom" id="tdNom_Prenom_Ville"></td>
				<td> <input type="text" name="prenom" id="tdNom_Prenom_Ville"></td>
				<td> <input type="text" name="adresse" id="tdadresse"></td>
				<td> <input type="text" name="cp" id="tdCp"></td>
				<td> <input type="text" name="ville" id="tdNom_Prenom_Ville"></td>
				<td> <input type="date" name="dateNaissance" id="tdDate_Lieu_Naiss" class="date"></td>
				<td> <input type="text" name="lieuNaissance" id="tdDate_Lieu_Naiss"></td>
				<td> <input type="text" name="numSS" id="tdNumSS"></td>
				<input type="hidden" name="patients" value="ok">
				<input type="hidden" name="ajout">
				<td colspan=3 style='text-align:center;'><input type="submit" value="Ajouter"></td>
			</tr>
		</form>
		</thead>
		<tbody id="donnees">
			<?php
			include ("./ConnexionBDD.php");
			if (isset($_GET['filtreCivi'])) {
				$req=$linkpdo->query('Select * from patient order by civiliteP');
				while ($res=$req->fetch()) {
				echo "	<tr>
						<td Id='tdCivilite'>".$res['civiliteP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
						<td id='tdadresse'>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			elseif (isset($_GET['filtreNom'])) {
				$req=$linkpdo->query('Select * from patient order by nomP DESC');
				while ($res=$req->fetch()) {
				echo "	<tr>
						<td Id='tdCivilite'>".$res['civiliteP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
						<td id='tdadresse'>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			elseif (isset($_GET['filtrePrenom'])) {
				$req=$linkpdo->query('Select * from patient order by prenomP');
				while ($res=$req->fetch()) {
				echo "	<tr>
						<td Id='tdCivilite'>".$res['civiliteP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
						<td id='tdadresse'>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			elseif (isset($_GET['filtreAdresse'])) {
				$req=$linkpdo->query('Select * from patient order by adresseP');
				while ($res=$req->fetch()) {
				echo "	<tr>
						<td Id='tdCivilite'>".$res['civiliteP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
						<td id='tdadresse'>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			elseif (isset($_GET['filtreCp'])) {
				$req=$linkpdo->query('Select * from patient order by cpP');
				while ($res=$req->fetch()) {
				echo "	<tr>
						<td Id='tdCivilite'>".$res['civiliteP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
						<td id='tdadresse'>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			elseif (isset($_GET['filtreVille'])) {
				$req=$linkpdo->query('Select * from patient order by villeP');
				while ($res=$req->fetch()) {
				echo "	<tr>
						<td Id='tdCivilite'>".$res['civiliteP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
						<td id='tdadresse'>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			elseif (isset($_GET['filtreDate'])) {
				$req=$linkpdo->query('Select * from patient order by dateNaissanceP');
				while ($res=$req->fetch()) {
				echo "	<tr>
						<td Id='tdCivilite'>".$res['civiliteP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
						<td id='tdadresse'>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			elseif (isset($_GET['filtreLieu'])) {
				$req=$linkpdo->query('Select * from patient order by lieuNaissanceP');
				while ($res=$req->fetch()) {
				echo "	<tr>
						<td Id='tdCivilite'>".$res['civiliteP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
						<td id='tdadresse'>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			elseif (isset($_GET['filtreNSS'])) {
				$req=$linkpdo->query('Select * from patient order by numSS');
				while ($res=$req->fetch()) {
				echo "	<tr>
						<td Id='tdCivilite'>".$res['civiliteP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
						<td id='tdadresse'>".$res['adresseP']."</td>
						<td>".$res['cpP']."</td>
						<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
						<td>".$res['dateNaissanceP']."</td>
						<td>".$res['lieuNaissanceP']."</td>
						<td>".$res['numSS']."</td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
						<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			else{
				$req=$linkpdo->query('Select * from patient order by nomP');
				while ($res=$req->fetch()) {
				echo "	<tr>
							<td Id='tdCivilite'>".$res['civiliteP']."</td>
							<td id='tdNom_Prenom_Ville'>".$res['nomP']."</td>
							<td id='tdNom_Prenom_Ville'>".$res['prenomP']."</td>
							<td id='tdadresse'>".$res['adresseP']."</td>
							<td>".$res['cpP']."</td>
							<td id='tdNom_Prenom_Ville'>".$res['villeP']."</td>
							<td>".$res['dateNaissanceP']."</td>
							<td>".$res['lieuNaissanceP']."</td>
							<td>".$res['numSS']."</td>
							<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce patient'></a></td>
							<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce patient'></a></td>
							<td style='text-align:center;'><a href='./?patients=ok&idPatient=".$res['idPatient']."&medecinRef=ok'><IMG src='medecin_ajout.jpg' alt='Ajouter un medecin referant à ce patient'></a></td>				
						</tr>";
				}
			}
			?>
		</tbody>
	</table>
</div>
