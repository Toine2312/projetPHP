
		<?php 
				include("Date.php");
				$date = new Date();
				$annee = date("Y");
				$calendrier = $date->getAll($annee);
				//print_r($calendrier);
				$events = rdvMedecin($_POST["medRef"], $annee);
				
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
											$time = strtotime("$annee-$m-j");
											if($j == 1 && $w != 1){
												$col= $w-1;
												echo "<td colspan='".$col."'></td>";
											}
											echo "<td>".$j."</td>";
											echo "<div class='events'>";
												if (isset($events[$time])) {
													foreach ($events[$time] as $e) {
														echo "<li>".$e."</li>";
													}
												}
											echo "</div>";
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

		<?php
	
			function rdvMedecin($idMed, $annee){
					include("ConnexionBDD.php");
					$r = array();
					$res = $linkpdo->query('SELECT * FROM rdv WHERE idMed=$idMed ORDER BY dateRdv DESC, heure DESC'); 
					while($data = $res->fetch()) { 
						$heureFin = $data["heure"]+$data["duree"];
						$r[strtotime($data["dateRDV"])][$data["idRDv"]] = $data["heure"]." - ".$heureFin." En consultation" ;

					}
					return $r;
			}
		 ?>

		</div>


