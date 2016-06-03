<div class="pageInterne"> 
	<br>
	<br>
	<p id="titre">Planning</p>
	<?php
		//include ("./ConnexionBDD.php");
		if(isset($_POST["ajout"])){
			echo "ok".$_POST["patientSelect"];
			$req1 = $linkpdo -> prepare ('INSERT into rdv (idPatient, idMed, dateRdv, heure, duree) values (:idPatient, :idMed, :dateRdv, :heure, :duree)');
			$req1 -> execute(array(	'idPatient'=>$_POST["patientSelect"], 
									'idMed'=>$_POST["medecin"], 
									'dateRdv'=>$_POST["dateRdv"], 
									'heure'=>$_POST["heure"], 
									'duree'=>$_POST["duree"]));
		}
		if(isset($_POST["idRdvModif"])){
			if(isset($_POST["validerModif".$_POST["idRdvModif"]])){
				
				$req2 = $linkpdo->prepare ('UPDATE rdv SET idPatient= :idPatient, idMed= :idMed, dateRdv= :dateRdv, heure= :heure, duree= :duree WHERE idRdv= :idRdv');
				//echo "nvelle date = ".$_POST["dateModif"];
				//echo "idRdv = ".$_POST["idRdvModif"];
				$req2->execute(array(	'idPatient'=>$_POST["patientModif"], 
										'idMed'=>$_POST["medecinModif"], 
										'dateRdv'=>$_POST["dateModif"], 
										'heure'=>$_POST["heureModif"], 
										'duree'=>$_POST["dureeModif"],
										'idRdv'=>$_POST["idRdvModif"]));
			}
		}
		
	?>
	<div id="formAjout">
		<fieldset>
			<legend>Ajouter une consultation</legend>
			<br>
			<table>

				<tr>
					<th>Patients</th>
					<form name="validP" method="POST" action="./?consult=ok">
					<td>
						<select name="patient" onchange="this.form.submit()"> 
							<?php 
								$res = $linkpdo->query('SELECT * FROM patient');
									echo "<option value=' ' selected ='selected'></option>";
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
				<tr>
					<th>Medecins</th>
				<form name="validP" method="POST" action="./?consult=ok">
					<td>
						<select name="medecin">
							<?php 
								$patient = $_POST["patient"];
								if(isset($_POST["patient"])){
									echo"<optgroup>Medecin referent ";
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
						<td><input type= "date" class="date" name="dateRdv" ></td>
					</tr>
					<tr>
						<th>Heure</th>
						<td><input type="time" class="heure" name="heure"></td>
					</tr>
					<tr>
						<th>Durée</th>
						<td><input type="time" class="heure" name="duree" value="00:30:00"></td>
					</tr>
					<tr>
						<td><input type="hidden" name="patientSelect" <?php echo "value='".$patient."'"?>></td>
						<td><input type="submit" name="ajout" value="Ajouter"></td>
					</tr>
					
				</form>
			</table>
		</fieldset>
	</div>
	<div id="consultations">
		<br><center>
		<table id="listeRDV">
		<tr ><th colspan=3>Liste des RDV de : </th>
			<th colspan=2><form  method="POST" action="./?consult=ok">
				<select name="triMedecin"  onchange="this.form.submit()">
					<option value="1">Tout le monde</option>
					<?php
					$res = $linkpdo->query('SELECT * FROM medecin /*WHERE idMed <> '.$POST["medRef"].')*/');
						while($data = $res->fetch()) {
								echo "<option value='idMed=".$data['idMed']."'>".$data['nomM']." ".$data['prenomM']."</option>";
						}
					?>
				</select>
			</form>
		</th></tr>
		<tr> 
			<th> Date</th>
			<th> Heure</th>
			<th> Patient</th>
			<th> Medecin</th>
			<th> Durée</th>
		</tr>
		<?php 
			$i=0;
			if(isset($_POST["triMedecin"])){
				$res3 = $linkpdo->query('SELECT * FROM rdv WHERE '.$_POST["triMedecin"].' ORDER BY dateRdv , heure ASC'); 
			}
			else{
				$res3 = $linkpdo->query('SELECT * FROM rdv ORDER BY dateRdv , heure DESC '); 
			}
			while($data = $res3->fetch()) { 
		?>
		 		<tr> 
					<form action='./?consult=ok' method='POST' id=".$i.">
						<input type='hidden' name='idRdvModif' <?php echo "value='".$data['idRdv']."'"?>>
						<td><input type = 'date' class="date" name='dateModif'  <?php echo "value='".$data['dateRdv']."'"?> <?php $val="modifier".$data["idRdv"]; if(!isset($_POST[$val])){echo "readonly";}?>></td>
						<td><input type = 'time' class="heure" name='heureModif' <?php echo "value='".$data['heure']."'"?> <?php $val="modifier".$data["idRdv"]; if(!isset($_POST[$val])){echo "readonly";}?>></td>
						<td><input type = 'text' class="texte" name='patientModif' <?php echo "value='".$data['idPatient']."'"?> <?php $val="modifier".$data["idRdv"]; if(!isset($_POST[$val])){echo "readonly";}?>></input></td>
						<td><input type = 'text' class="texte" name='medecinModif' <?php echo "value='".$data['idMed']."'"?><?php $val="modifier".$data["idRdv"]; if(!isset($_POST[$val])){echo "readonly";}?>></input></td>
						<td><input type = 'time' class="heure" name='dureeModif' <?php echo "value='".$data['duree']."'"?> <?php $val="modifier".$data["idRdv"]; if(!isset($_POST[$val])){echo "readonly";}?>></td>
						<td><input type='submit' <?php $val="modifier".$data["idRdv"]; echo (!isset($_POST[$val])) ? 'class="btn_modifier"' : 'class="btn_validerModif"';?> value=" " align='middle'<?php echo (!isset($_POST[$val])) ? "name = 'modifier".$data["idRdv"]."'" : "name = 'validerModif".$data["idRdv"]."'"?>></input></td>
						<td><input class="btn_supprimer" type='submit'  value=" " align='middle' name = 'supprimer'></input></td>
					</form>
				</tr>
		<?php
				$i++;
		    }
		    	echo "</table></center>";
		   	$res->closeCursor(); 
		?>
	</div>
</div>	