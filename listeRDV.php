<?php
	$res = $linkpdo->query('SELECT * FROM rdv ORDER BY date ,heure DESC'); 
	///Affichage des entrées du résultat une à une
	echo "<center><table>";
	echo "<tr> 
				<td>nom |</td>
				<td>prenom |</td>
				<td>adresse |</td>
				<td>cp |</td>
				<td>ville |</td>
				<td>numTel |</td>
				<td>Modifier |</td>
				<td>Supprimer</td>
		</tr>";
	$i=0;
	while($data = $res->fetch()) { 
		echo "<tr> 
				<form action='index.php' method='POST' id=".$i.">
				<input type='hidden' name='id' value='".$data['idContact']."'>
				<td><input type = 'text' name='nom'readonly value='".$data['nom']."'</input></td>
				<td><input type = 'text' name='prenom' readonly value='".$data['prenom']."'</input></td>
				<td><input type = 'text' name='adresse' readonly value='".$data['adresse']."'</td>
				<td><input type = 'text' name='cp' readonly value='".$data['cp']."'</td>
				<td><input type = 'text' name='ville'readonly value='".$data['ville']."'</td>
				<td><input type = 'text' name='tel' readonly value='".$data['numTel']."'</td>
				<td><input src='modifier.png' type='submit' value='modifier' align='middle'name = 'modifier'></input></td>
				<td><input src='croix.png' type='submit'  value='supprimer'align='middle' name = 'supprimer'></input></td>
				</form>
		</tr>";
		$i++;
    	}
    	echo "</table></center>";
	///Fermeture du curseur d'analyse des résultats
   	$res->closeCursor(); 
?>
