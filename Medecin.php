<div class="pageInterne">
	<!--Suppression de medecin-->
	<?php
		if (isset($_GET['idMed']) && isset($_GET['suppr'])){
			$id=$_GET['idMed'];
			include"./ConnexionBDD.php";

				$req = $linkpdo->prepare('DELETE FROM medecin WHERE idMed = :id');
				$req->execute(array('id' => $id)); 
				echo "<br><p id='textmed'>Contact supprim&eacute; avec succes !</p>";
				echo "<meta http-equiv='refresh' content='1; URL=./?medecins=ok''></meta>";
		}
	?>

	<!--Modification medecin-->
	<?php
		if (isset($_POST['id']) && isset($_POST['modif'])) {
			$civiliteP=$_POST['civilite'];
			$nom=$_POST['nom'];
			$prenom=$_POST['prenom'];
			$id=$_POST['id'];

			include"./ConnexionBDD.php";
			
			$req = $linkpdo->prepare('UPDATE medecin SET civiliteM= :nvCivilite, nomM= :nvNom, prenomM= :nvPrenom WHERE idMed= :id');
			$req->execute(array('nvCivilite' => $civiliteP,
								'nvNom' => $nom,
								'nvPrenom' => $prenom,
								'id' => $id));

			echo "<br><p id='textmed'>Medecin modifi&eacute; avec succes !</p>";
			echo "<meta http-equiv='refresh' content='1; URL=./?medecins=ok'></meta>";
			
		}


		if (isset($_GET['idMed']) && isset($_GET['modif'])){
			$id=$_GET['idMed'];
			include"./ConnexionBDD.php";
			$req=$linkpdo->query("Select * from medecin where idMed='$id'");
			if($res=$req->fetch()) {
				echo "<br><p id='textmed'>Modifier ce medecin ?</p>
						<form action='./?medecins=ok' method='POST'>
							<table id='tableauMed'>
								<tr>
									<td>Civilit&eacute;</td>
									<td>Nom</td>
									<td>Prenom</td>
								</tr>
								<tr>";
							if ($res['civiliteM']=='M.') {
								echo "<td><select name='civilite'><option value='M.' selected='selected'>M.</option><option value='Mme.'>Mme.</option></select></td>";
							}else{
								echo "<td><select name='civilite'><option value='Mme.' selected='selected'>Mme.</option><option value='M.'>M.</option></select></td>";
							}
								echo "<td><input type='text' name='nom' value=\"".$res['nomM']."\" id='tdNom_Prenom_Ville'></td>
									<td><input type='text' name='prenom' value=\"".$res['prenomM']."\" id='tdNom_Prenom_Ville'></td>
									<td colspan=2 align='center'><input type='submit' value='Modifier'><input type='hidden' name='id' value=".$res['idMed']."></td>
									<input type='hidden' name='medecins' value='ok'>
									<input type='hidden' name='modif'>
								</tr>
							</table>
						</form>
						<br>
						<br>";
			}
		}
	?>

	<!-- Ajout medecin -->
	<?php
		if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['ajout'])) {
			$civiliteM=$_POST['civilite'];
			$nom=$_POST['nom'];
			$prenom=$_POST['prenom'];

			include ("./ConnexionBDD.php");
			
			$req = $linkpdo -> prepare ('insert into medecin (civiliteM, nomM, prenomM) values (:civiliteM,:nom,:prenom)');
			$req -> execute(array('civiliteM'=>$civiliteM, 
								'nom'=>$nom, 
								'prenom'=>$prenom));
			echo "<br><p id='textmed'>Medecin ajout&eacute; a la base<br></p>";
			echo "<meta http-equiv='refresh' content='1; URL=./?medecins=ok''></meta>";
		}
	?>
	<br>
	<br>
	<p id="titremed">Nos M&eacute;decins</p>
	<div id="divtableauMed">
		<table id="tableauMed">
			<thead id="premiereLigne">
				<tr>
					<td>Civilit&eacute; <a href='./?medecins=ok&filtreCivi=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
					<td>Nom <a href='./?medecins=ok&filtreNom=ok'><IMG src='filtre.png' alt='filtrerChamp'></a></td>
					<td>Prenom <a href='./?medecins=ok&filtrePrenom=ok'><IMG src='filtre.png' alt='filtrerChamp'></td>
				</tr>
			<form action="./?medecins=ok" method="POST"  id="ajoutMedecin">
				<tr>
					<td> <select name="civilite" id="tdCivilite"><option value="M." selected="selected">M.</option><option value="Mme.">Mme.</option></select></td>
					<td> <input type="text" name="nom" id="tdNom_Prenom"></td>
					<td> <input type="text" name="prenom" id="tdNom_Prenom"></td>
					<input type='hidden' name='medecins' value='ok'>
					<input type="hidden" name="ajout">
					<td colspan=2 style='text-align:center;'><input type="submit" value="Ajouter"></td>
				</tr>
			</form>
			</thead>
			<tbody id="donneesMed">
				<?php
				include ("./ConnexionBDD.php");
				if (isset($_GET['filtreCivi'])) {
					$req=$linkpdo->query('Select * from medecin order by civiliteM');
					while ($res=$req->fetch()) {
					echo "	<tr id='donnees' >
								<td>".$res['civiliteM']."</td>
								<td>".$res['nomM']."</td>
								<td>".$res['prenomM']."</td>
								<td style='text-align:center;'><a href='./?medecins=ok&idMed=".$res['idMed']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce contact'></a></td>
								<td style='text-align:center;'><a href='./?medecins=ok&idMed=".$res['idMed']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce contact'></a></td>
							</tr>";
					}
				}
				elseif (isset($_GET['filtreNom'])) {
					$req=$linkpdo->query('Select * from medecin order by nomM DESC');
					while ($res=$req->fetch()) {
					echo "	<tr id='donnees' >
								<td>".$res['civiliteM']."</td>
								<td>".$res['nomM']."</td>
								<td>".$res['prenomM']."</td>
								<td style='text-align:center;'><a href='./?medecins=ok&idMed=".$res['idMed']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce contact'></a></td>
								<td style='text-align:center;'><a href='./?medecins=ok&idMed=".$res['idMed']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce contact'></a></td>
							</tr>";
					}			
				}
				elseif (isset($_GET['filtrePrenom'])) {
					$req=$linkpdo->query('Select * from medecin order by prenomM');
					while ($res=$req->fetch()) {
					echo "	<tr id='donnees' >
								<td>".$res['civiliteM']."</td>
								<td>".$res['nomM']."</td>
								<td>".$res['prenomM']."</td>
								<td style='text-align:center;'><a href='./?medecins=ok&idMed=".$res['idMed']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce contact'></a></td>
								<td style='text-align:center;'><a href='./?medecins=ok&idMed=".$res['idMed']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce contact'></a></td>
							</tr>";
					}			
				}
				else{
					include ("./ConnexionBDD.php");
					$req=$linkpdo->query('Select * from medecin order by nomM ASC');
					while ($res=$req->fetch()) {
						echo "	<tr id='donnees' >
									<td>".$res['civiliteM']."</td>
									<td>".$res['nomM']."</td>
									<td>".$res['prenomM']."</td>
									<td style='text-align:center;'><a href='./?medecins=ok&idMed=".$res['idMed']."&modif=ok'><IMG src='modifier.png' alt='Modifier ce contact'></a></td>
									<td style='text-align:center;'><a href='./?medecins=ok&idMed=".$res['idMed']."&suppr=ok'><IMG src='supprimer.png' alt='Supprimer ce contact'></a></td>
								</tr>";
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>