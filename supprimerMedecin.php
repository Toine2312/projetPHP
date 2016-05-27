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
			if (isset($_GET['idMed'])){
				$id=$_GET['idMed'];
				include"./ConnexionBDD.php";

					$req = $linkpdo->prepare('DELETE FROM medecin WHERE idMed = :id');
					$req->execute(array('id' => $id)); 
					echo "<center><h2>Contact supprimé avec succes !</h2></center>";
					echo "<meta http-equiv='refresh' content='1; URL=http://localhost/Tpdut/DUTToulouse/ExCours/GestionCabinetMedical/?medecins=ok''></meta>";
			}
		?>
	</div>
</body>
</HTML>