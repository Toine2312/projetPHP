<?php
	class Date{

		var $jourSemaine = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
		var $Mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		
		function getAll($annee){
			$r= $array= array();

			$date = strtotime($annee."-01-01");
			while (date("Y", $date) <= $annee) {
				$y = date("Y", $date);
				$m = date("n", $date);
				$j = date("j", $date);
				$js = date("N", $date);
				$r[$y][$m][$j] = $js;
				$date = strtotime(date("Y-m-d", $date).'1 DAY');
			}

			return $r;
		}
	}
?>