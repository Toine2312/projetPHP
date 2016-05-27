<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="Medecin.css" />
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
				$id=$_POST['id'];

				include"./ConnexionBDD.php";
				
				$req = $linkpdo->prepare('UPDATE medecin SET civiliteM= :nvCivilite, nomM= :nvNom, prenomM= :nvPrenom WHERE idMed= :id');
				$req->execute(array('nvCivilite' => $civiliteP,
									'nvNom' => $nom,
									'nvPrenom' => $prenom,
									'id' => $id));

				echo "<center><h2>Medecin modifié avec succes !</h2></center>";
				echo "<meta http-equiv='refresh' content='1; URL=./?medecins=ok'></meta>";
				
			}


			if (isset($_GET['idMed'])){
				$id=$_GET['idMed'];
				include"./ConnexionBDD.php";
				$req=$linkpdo->query("Select * from medecin where idMed='$id'");
				if($res=$req->fetch()) {
					echo "<H1><center>Modifier ce medecin ?</center></H1>
							<form action='modifierMedecin.php' method='POST'>
								<table align='center' bgcolor='D8D8D8' style='border-radius: 10px'>
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
										<td colspan=2 align='center'><input type='submit' value='Oui, Modifier'><input type='hidden' name='id' value=".$res['idMed']."></td>
									</tr>
								</table>
							</form>
							<center><a href='./?medecins=ok'>Non, Retour</a></center>";
				}
			}
		?>
		
	</div>
</body>
</HTML>


