<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="Stat.css" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<TITLE>Carnet de Patient</TITLE>
</head>
<body>
	<div class="container">
		<h1><center>Statistique du cabinet</center></h1>
		<br>
		<h2>Repartition demographique des patients</h2>
		<table id="tableau">
			<tr>
				<td>Tranches d'ages</td>
				<td>Patient Masculin</td>
				<td>Patient Feminin</td>
			</tr>
			<tr>
				<td>Moins de 25 ans</td>
				<td>
					<?php $req=$linkpdo->query("Select count(*) as nbM25 from patient where civiliteP='M.' and DATEDIFF(CURDATE(), `dateNaissanceP`) < '9131.25'");
						if($res=$req->fetch()) {
							echo $res['nbM25'];
						}
					?>
				</td>
				<td>
					<?php $req=$linkpdo->query("Select count(*) as nbMme25 from patient where civiliteP='Mme.' and DATEDIFF(CURDATE(), `dateNaissanceP`) < '9131.25'");
						if($res=$req->fetch()) {
							echo $res['nbMme25'];
						}
					?>
				</td>
			</tr>
			<tr>
				<td>Entre 25 et 50 ans</td>
				<td>
					<?php $req=$linkpdo->query("Select count(*) as nbM2550 from patient where civiliteP='M.' and DATEDIFF(CURDATE(), `dateNaissanceP`) > '9131.25' and DATEDIFF(CURDATE(), `dateNaissanceP`) < '18262.5'");
						if($res=$req->fetch()) {
							echo $res['nbM2550'];
						}
					?>
				</td>
				<td>
					<?php $req=$linkpdo->query("Select count(*) as nbMme2550 from patient where civiliteP='Mme.' and DATEDIFF(CURDATE(), `dateNaissanceP`) > '9131.25' and DATEDIFF(CURDATE(), `dateNaissanceP`) < '18262.5'");
						if($res=$req->fetch()) {
							echo $res['nbMme2550'];
						}
					?>
				</td>
			</tr>	
			<tr>
				<td>Plus de 50 ans</td>
				<td>
					<?php $req=$linkpdo->query("Select count(*) as nbM50 from patient where civiliteP='M.' and DATEDIFF(CURDATE(), `dateNaissanceP`) > '18262.5'");
						if($res=$req->fetch()) {
							echo $res['nbM50'];
						}
					?>
				</td>
				<td>
					<?php $req=$linkpdo->query("Select count(*) as nbMme50 from patient where civiliteP='Mme.' and DATEDIFF(CURDATE(), `dateNaissanceP`) > '18262.5'");
						if($res=$req->fetch()) {
							echo $res['nbMme50'];
						}
					?>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td> Medecin </td>
				<td> Total de consultations </td>
				<td> En heures </td>
			</tr>	
			<?php 
				$req=$linkpdo->query("Select * from medecin");
					while ($res=$req->fetch()) {
						echo "<tr>
								<td> Docteur ".$res['prenomM']." ".$res['nomM']."</td>";
						$req1=$linkpdo->query("Select count(*) as totalConsult, SEC_TO_TIME(SUM(TIME_TO_SEC(duree)))  as totalheure from rdv where idMed=\"".$res['idMed']."\" group by idMed");
						if ($res1=$req1->fetch()){
							echo "<td> ".$res1['totalConsult']." </td>
								  <td> ".$res1['totalheure']."</td>
								</tr>";
						}
					}
			?>
		</table>
	</div>
</body>
</HTML>