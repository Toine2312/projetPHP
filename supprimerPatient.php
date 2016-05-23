<!DOCTYPE>
<HTML>
<head>
<TITLE>Carnet Contact</TITLE>
</head>
<body>
	<div class="container">
		<?php
			if (isset($_GET['idPatient'])){
				$id=$_GET['idPatient'];
				include"./ConnexionBDD.php";

					$req = $linkpdo->prepare('DELETE FROM patient WHERE idPatient = :id');
					$req->execute(array('id' => $id)); 
					echo "<center><h2>Contact supprimé avec succes !</h2></center>";
					echo "<meta http-equiv='refresh' content='2; URL=http://localhost/Tpdut/DUTToulouse/ExCours/GestionCabinetMedical/Patient.php'></meta>";
			}
		?>
	</div>
</body>
</HTML>