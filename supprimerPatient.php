<!DOCTYPE>
<HTML>
<head>
<link rel="stylesheet" href="patient.css" />
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
<TITLE>Carnet de Patient</TITLE>
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
					echo "<meta http-equiv='refresh' content='1; URL=./?patients=ok''></meta>";
			}
		?>
	</div>
</body>
</HTML>