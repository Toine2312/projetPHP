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
			if (isset($_POST['id']) && isset($_POST['medecinReferant'])) {
				echo $_POST['medecinReferant'];
				$id=$_POST['id'];
				$idMed=$_POST['medecinReferant'];

				include"./ConnexionBDD.php";
				
				$req = $linkpdo->prepare('UPDATE patient SET idMed= :idMed WHERE idPatient= :id');
				$req->execute(array('idMed' => $idMed,
									'id' => $id));

				echo "<center><h2>Nouveau medecin referant pris en compte</h2></center>";
				echo "<meta http-equiv='refresh' content='1; URL=./?patients=ok'></meta>";
				
			}


			if (isset($_GET['idPatient'])){
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
								<form action='AjoutMedecinReferant.php' method='POST'>
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
								<center><a href='http:./?patients=ok'>Retour</a></center>";
						}
					}else{
						echo "<H1><center>Choisissez un medecin referant pour ".$res['civiliteP']." ".$res['nomP']." ".$res['prenomP']." </center></H1>
							<form action='AjoutMedecinReferant.php' method='POST'>
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
							<center><a href='./?patients=ok'>Retour</a></center>";
					}
				}
			}
		?>
		
	</div>
</body>
</HTML>


