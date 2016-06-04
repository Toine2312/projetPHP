<div class="pageInterne">
	<p id="titrestat">Statistique du cabinet</p>
	<br>
	
	<div id="PageStat">
		<div id="divtableauStatPat">
			<p id="textstat">Repartition demographique des patients</p>
			<table id="tableauStatPat">
				<thead id="enteteTabStatPat">
					<tr>
						<td>Tranches d'ages</td>
						<td>Patient Masculin</td>
						<td>Patient Feminin</td>
					</tr>
				</thead>
				<tbody id="donneesStatPat">
					<tr>
						<td>Moins de 25 ans</td>
						<td>
							<?php $req=$linkpdo->query("Select count(*) as nbM25 from patient where civiliteP='M.' and DATEDIFF(CURDATE(), `dateNaissanceP`) < '9131.25'");
								if($res=$req->fetch()) {
									echo $res['nbM25'];
									$nbM25 = $res['nbM25'];
								}
							?>
						</td>
						<td>
							<?php $req=$linkpdo->query("Select count(*) as nbMme25 from patient where civiliteP='Mme.' and DATEDIFF(CURDATE(), `dateNaissanceP`) < '9131.25'");
								if($res=$req->fetch()) {
									echo $res['nbMme25'];
									$nbMme25 =$res['nbMme25'];
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
									$nbM2550 = $res['nbM2550'];
								}
							?>
						</td>
						<td>
							<?php $req=$linkpdo->query("Select count(*) as nbMme2550 from patient where civiliteP='Mme.' and DATEDIFF(CURDATE(), `dateNaissanceP`) > '9131.25' and DATEDIFF(CURDATE(), `dateNaissanceP`) < '18262.5'");
								if($res=$req->fetch()) {
									echo $res['nbMme2550'];
									$nbMme2550 = $res['nbMme2550'];
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
									$nbM50 = $res['nbM50'];
								}
							?>
						</td>
						<td>
							<?php $req=$linkpdo->query("Select count(*) as nbMme50 from patient where civiliteP='Mme.' and DATEDIFF(CURDATE(), `dateNaissanceP`) > '18262.5'");
								if($res=$req->fetch()) {
									echo $res['nbMme50'];
									$nbMme50 = $res['nbMme50'];
								}
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		
		<div id="divtableauStatMed">
			<p id="textstat">Statistique Medecins</p>
			<table id="tableauStatMed">
				<thead id="enteteTabStatMed">
					<tr>
						<td> Medecin </td>
						<td> Total de consultations </td>
						<td> En heures </td>
					</tr>
				</thead>
				<tbody id="donneesStatMed">
					<?php 
						$req=$linkpdo->query("Select * from medecin");
							while ($res=$req->fetch()) {
								echo "<tr>
										<td> Docteur ".$res['prenomM']." ".$res['nomM']."</td>";
								$req1=$linkpdo->query("Select count(*) as totalConsult, SEC_TO_TIME(SUM(TIME_TO_SEC(duree)))  as totalheure from rdv where idMed=\"".$res['idMed']."\" group by idMed");
								if ($res1=$req1->fetch()){
									if ($res1['totalConsult'] == null) {
									echo "<td> 0 </td>
										  <td> 00:00:00 </td>
										</tr>";	
									}else{								
									echo "<td> ".$res1['totalConsult']." </td>
										  <td> ".$res1['totalheure']."</td>
										</tr>";
									}
								}
							}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>