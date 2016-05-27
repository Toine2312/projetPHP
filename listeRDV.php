<!DOCTYPE HTML>
<html>
	<head>	
		<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
	</head>
	<body>
		<div class="container">
			<div id="formAjout">
				<form method="POST" action="./?consult=ok">
					<fieldset>
					<legend>Ajouter une consultation</legend>
					<table>
						<tr>
							<td>Patients</td>
							<td>Medecins</td>
						</tr>
						<tr>
							<td>
								<form method="POST" action="./?consult=ok">
									<select name="patient" onchange="this.form.submit()">
									<?php 
										$res = $linkpdo->query('SELECT * FROM patient');
										while($data = $res->fetch()) {
											if($data['idPatient'] == $idPatient){
												echo "<option selected='selected' value='".$idPatient."'>".$data['nomP']." ".$data['prenomP']."</option>";
											}else{
												echo "<option value='".$data['idPatient']."'>".$data['nomP']." ".$data['prenomP']."</option>";
											}
											
										}
									?>
								</select>
							</td>
							<td>
								<select name"medecin">
									<?php 
										echo"<optgroup>";
										$res = $linkpdo->query('SELECT * FROM medecin WHERE idMed = (SELECT idMed FROM patient where idPatient="'.$idPatient.'")');
										if($data = $res->fetch()) {
											echo "<option selected='selected' value='".$data['idMed']."'>".$data['nomM']." ".$data['prenomM']."</option>";
										}
										echo"</optgroup>";
										echo"<optgroup>";
										$res = $linkpdo->query('SELECT * FROM medecin WHERE idMed != (SELECT idMed FROM patient where idPatient'.$POST["patient"].')');
										while($data = $res->fetch()) {
											echo "<option value='".$data['idMed']."'>".$data['nomM']." ".$data['prenomM']."</option>";
										}
										echo"</optgroup>";
									?>
								</select>
							</td>
							
							<td><input type="password" name="mdp" placeholder="Mot de passe" <?php if(isset($_SESSION["login"])){ echo 'value="'.$_SESSION["mdp"].'"';} ?>></td>
							<td><input type="submit" name="conn" value=<?php echo '"'.$_SESSION["etat"].'"' ?>></td>
						</tr>
					</table>
					</fieldset>
				</form>
			</div>
			<?php
				$res = $linkpdo->query('SELECT * FROM rdv ORDER BY date ,heure DESC'); 
				///Affichage des entrées du résultat une à une
				echo "<center><table>";
				echo "<tr> 
							<td>nom |</td>
							<td>prenom |</td>
							<td>adresse |</td>
							<td>cp |</td>
							<td>ville |</td>
							<td>numTel |</td>
							<td>Modifier |</td>
							<td>Supprimer</td>
					</tr>";
				$i=0;
				while($data = $res->fetch()) { 
					echo "<tr> 
							<form action='index.php' method='POST' id=".$i.">
							<input type='hidden' name='id' value='".$data['idContact']."'>
							<td><input type = 'text' name='nom'readonly value='".$data['nom']."'</input></td>
							<td><input type = 'text' name='prenom' readonly value='".$data['prenom']."'</input></td>
							<td><input type = 'text' name='adresse' readonly value='".$data['adresse']."'</td>
							<td><input type = 'text' name='cp' readonly value='".$data['cp']."'</td>
							<td><input type = 'text' name='ville'readonly value='".$data['ville']."'</td>
							<td><input type = 'text' name='tel' readonly value='".$data['numTel']."'</td>
							<td><input src='modifier.png' type='submit' value='modifier' align='middle'name = 'modifier'></input></td>
							<td><input src='croix.png' type='submit'  value='supprimer'align='middle' name = 'supprimer'></input></td>
							</form>
					</tr>";
					$i++;
			    	}
			    	echo "</table></center>";
				///Fermeture du curseur d'analyse des résultats
			   	$res->closeCursor(); 
			?>
				<?php
				if(isset($_POST['patient'])){
					$idPatient = $_POST['patient'];
					echo $idPatient;
				}?>
		</div>
	
		
	</body>
</html>

