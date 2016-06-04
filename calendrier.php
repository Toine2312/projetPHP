<!DOCTYPE HTML>
<html>
	<head>	
		<title>Cabinet Medical</title>
		<link rel="icon" type="image/png" href="./logoPetitMedical.ico" />
		<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="Patient.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="Medecin.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="Stat.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="rdv.css" media="all"/>
	</head>
	<body>
		<?php 
				include("Date.php");
				$date = new Date();
				$annee = date("Y");
				$calendrier = $date->getAll($annee);
				//print_r($calendrier);
				
			?>
		<div class="calendrier">
			<div class="mois">
				<ul>
					<?php 
						$i=1;
						foreach ($date->Mois as $m) {
							echo "<li><a href='?consult=ok&mois=".$i."'>".substr($m, 0, 3)."</a></li>";
							$i++;
						}
					?>
				</ul>
			</div>
			<?php 
				$calendrier = current($calendrier); 
			?>
			<?php 
				foreach ($calendrier as $m=>$jour) { 
					if($_GET["mois"] == $m){ ?>
				
						<div class="affichMois">
							<table>
								<thead>
									<?php
									foreach ($date->jourSemaine as $jS) {
										echo "<th>".substr($jS, 0, 3)."</th>";
									}
									?>
								</thead>
								<tbody>
									<tr>
										<?php 
										$jourFin= end($jour);
										foreach ($jour as $j=>$w) {
											if($j == 1 && $w != 1){
												$col= $w-1;
												echo "<td colspan='".$col."'></td>";
											}
											echo "<td>".$j."</td>";
											if($w%7 == 0){
												echo "</tr><tr>";
											}
										 }
										 if ($jourFin != 7) {
										 	$col= 7 - $jourFin;
											echo "<td colspan='".$col."'></td>";
										 }
										 ?>
									</tr>
								</tbody>
							</table>
						</div>	
			<?php 
					}
				}?>
		</div>
	</body>
</html>
