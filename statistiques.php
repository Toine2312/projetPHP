	<div class="pageInterne">
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



		<?php
			include("jpgraph-3.5.0b1/src/jpgraph.php");
			include("jpgraph-3.5.0b1/src/jpgraph_pie.php");
			/*$graph = new PieGraph(400,400);
		    $s1 = array(array('Moins de 25 ans',$nbM25), array('Entre 25 et 50 ans',$nbM2550), array('Plus de 50 ans',$nbM50));
		    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		    //Chart 1 Example
		    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		    $pc = new PiePlotC($s1, "HOMMES");
		  /*  $pc->set_grid(array('drawBorder'=>false,
					'drawGridlines'=>false,
					'background'=>'#ffffff',
					'shadow'=>false));
		    $pc->set_axes_default(array());
		    
		    $pc->set_series_default(array(
					'renderer'=>'plugin::PieRenderer',
					'rendererOptions'=>array('showDataLabels'=>true)));
		    $pc->set_legend(array('show'=>true,
					'rendererOptions'=> array('numberRows'=> 1),
					'location'=> 's'));
		    $pc->draw(400,400);   */
?>
		     
		    <div id="graphique1">
<?php

			$data = array(27,23,47,17);

			// A new graph
			$graph = new PieGraph(350,200);
			$graph->SetShadow();

			// Setup title
			$graph->title->Set("Example of pie plot with absolute labels");
			$graph->title->SetFont(FF_FONT1,FS_BOLD);

			// The pie plot
			$p1 = new PiePlot($data);

			// Move center of pie to the left to make better room
			// for the legend
			$p1->SetCenter(0.35,0.5);

			// No border
			$p1->ShowBorder(false);

			// Label font and color setup
			$p1->value->SetFont(FF_FONT1,FS_BOLD);
			$p1->value->SetColor("darkred");

			// Use absolute values (type==1)
			$p1->SetLabelType(PIE_VALUE_ABS);

			// Label format
			$p1->value->SetFormat("$%d");
			$p1->value->Show();

			// Size of pie in fraction of the width of the graph
			$p1->SetSize(0.3);

			// Legends
			$p1->SetLegends(array("May ($%d)","June ($%d)","July ($%d)","Aug ($%d)"));
			$graph->legend->Pos(0.05,0.15);

			$graph->Add($p1);
			$graph->Stroke();

    ?>
	</div>
	</div>