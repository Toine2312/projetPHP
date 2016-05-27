<!DOCTYPE HTML>
<html>
	<head>	
		<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
	</head>
	<body>
		<div class="container">
			<div id="formAjout">
				<fieldset>
					<legend>Ajouter une consultation</legend>
					<table>
						<tr>
							<th>Patients</th>
							<th>Medecins</th>
						</tr>
						<tr><form name="validP" method="POST" action="./?consult=ok">
							<td>
								<select name="patient" onchange="this.form.submit()"> 
									<?php 
										$res = $linkpdo->query('SELECT * FROM patient');
											while($data = $res->fetch()) {
												if(isset($_POST["patient"]) && $_POST["patient"] == $data['idPatient']){
													echo "<option value='".$data['idPatient']."' selected ='selected'>".$data['nomP']." ".$data['prenomP']."</option>";
												}else{
													echo "<option value='".$data['idPatient']."'>".$data['nomP']." ".$data['prenomP']."</option>";
												}
												
											}
									?>
								</select>
							</td>
							<input type="hidden" name="consult" value="ok">
							<input type="hidden" name="medRef" value=<?php echo '"'.$data['idMed'].'"';?> >
							
						</form>
						<form name="validP" method="POST" action="./?consult=ok">
							<td>
								<select name="medecin">
									<?php 
										$patient = $_POST["patient"];
										if(isset($_POST["patient"])){
											echo"<optgroup>";
											$res = $linkpdo->query('SELECT * FROM medecin WHERE idMed = (SELECT idMed FROM patient where idPatient="'.$_POST["patient"].'")');
											if($data = $res->fetch()) {
												echo "<option value='".$data['idMed']."' selected='selected'>".$data['nomM']." ".$data['prenomM']."</option>";
											}
											echo"</optgroup>";
										}
										echo"<optgroup>";
										$res = $linkpdo->query('SELECT * FROM medecin /*WHERE idMed <> '.$POST["medRef"].')*/');
										while($data = $res->fetch()) {
											echo "<option value='".$data['idMed']."'>".$data['nomM']." ".$data['prenomM']."</option>";
										}
										echo"</optgroup>";
									?>
								</select>
							</td>
							</tr>
							<tr>
								<th>Date</th>
								<th>Heure</th>
								<th>Durée</th>
							</tr>
							<tr>
								<td><input type= "date" name="dateRdv" ></td>
								<td><input type="time" name="heure"></td>
								<td><input type="time" name="duree"></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td><input type="submit" name="ajout" value="Ajouter"></td>
							</tr
						</form>
					</table>
				</fieldset>
			</div>
			<?php
				$res3 = $linkpdo->query('SELECT * FROM rdv ORDER BY dateRdv , heure DESC'); 
			?>
				<br><center><table>
				<tr> 
					<th> Patient</th>
					<th> Medecin</th>
					<th> Date</th>
					<th> Heure</th>
					<th> Durée</th>
				</tr>
			<?php $i=0;
				while($data = $res3->fetch()) { 
			?>
			 		<tr> 
						<form action='./?consult=ok' method='POST' id=".$i.">
							<input type='hidden' name='idRdvModif' <?php echo "value='".$data['idRdv']."'"?>>
							<td><input type = 'text' name='patientModif' <?php echo "value='".$data['idPatient']."'"?> <?php $val="modifier".$data["idRdv"]; if(!isset($_POST[$val])){echo "readonly";}?>></input></td>
							<td><input type = 'text' name='medecinModif' readonly <?php echo "value='".$data['idMed']."'"?>></input></td>
							<td><input type = 'text' name='dateModif' readonly <?php echo "value='".$data['dateRdv']."'"?>></td>
							<td><input type = 'text' name='heureModif' readonly <?php echo "value='".$data['heure']."'"?>></td>
							<td><input type = 'text' name='dureeModif'readonly <?php echo "value='".$data['duree']."'"?>></td>
							<td><input src='modifier.png' type='submit' value='modifier' align='middle'<?php echo "name = 'modifier".$data["idRdv"]."'"?>></input></td>
							<td><input src='croix.png' type='submit'  value='supprimer'align='middle' name = 'supprimer'></input></td>
						</form>
					</tr>
			<?php
					$i++;
			    }
			    	echo "</table></center>";
				///Fermeture du curseur d'analyse des résultats
			   	$res->closeCursor(); 
			?>
			<?php
				//include ("./ConnexionBDD.php");
				if(isset($_POST["ajout"])){
					$req = $linkpdo -> prepare ('INSERT into rdv (idPatient, idMed, dateRdv, heure, duree) values (:idPatient, :idMed, :dateRdv, :heure, :duree)');
					$req -> execute(array(	'idPatient'=>$patient, 
											'idMed'=>$_POST["medecin"], 
											'dateRdv'=>$_POST["dateRdv"], 
											'heure'=>$_POST["heure"], 
											'duree'=>$_POST["duree"]));
				}
			?>
		</div>	
	</body>
</html>
