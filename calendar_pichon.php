<?php

date_default_timezone_set('Europe/Paris');
date_default_timezone_set('UTC');

$year = 2016;
$month = "03";
$day = "01";
$period = "2015/2016";

$id = 1005;

$jourdelan = "-01-01";
$fetetravail = "-05-01";
$huitmai = "-05-08";
$fetenationale = "-07-14";
$assomption = "-08-15";
$toussaint = "-11-01";
$armistice = "-11-11";
$noel = "-12-25";

$date = date('Y-m-d',strtotime(date($year.'-'.$month.'-'.$day)));

for($i=0;$i<365;$i++)
{
	$date_nX = date('Y-m-d', strtotime("$date +".$i." day"));
	$date_explode = date_parse($date_nX);
	$year = $date_explode['year'];
	
	if($date_nX == $year."06-01")
	{
		$year_1 = $year++;
		$period = $year."/".$year_1;
	}
	if($date_nX == $year.$jourdelan)
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == lundiPaques($year))
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == $year.$fetetravail)
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == $year.$huitmai)
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == jeudiAscension($year))
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == lundiPentecote($year))
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == $year.$fetenationale)
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == $year.$assomption)
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == $year.$toussaint)
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == $year.$armistice)
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX == $year.$noel)
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','1','".$period.');';
	}
	if($date_nX != $year.$jourdelan && $date_nX != lundiPaques($year) && $date_nX != $year.$fetetravail
		&& $date_nX != $year.$huitmai && $date_nX != jeudiAscension($year) && $date_nX != lundiPentecote($year)
		&& $date_nX != $year.$fetenationale && $date_nX != $year.$assomption && $date_nX != $year.$toussaint
		&& $date_nX != $year.$armistice && $date_nX != $year.$noel)
	{
		echo "INSERT timetable VALUES ('".$id."','".$date_nX."','0','".$period.');';
	}
	
	echo "\r\n";;
	$id++;
}

private function lundiPaques($year)
{
	date_default_timezone_set('Europe/Paris');
	date_default_timezone_set('UTC');
	$date_paques = paques(0, $year);
	$date = date('Y-m-d', strtotime("$date_paques +1 day"));
	return $date;
}

private function jeudiAscension($year)
{
	date_default_timezone_set('Europe/Paris');
	date_default_timezone_set('UTC');
	$date_paques = paques(0, $year);
	$date = date('Y-m-d', strtotime("$date_paques +39 day"));
	return $date;
}

private function lundiPentecote($year)
{
	date_default_timezone_set('Europe/Paris');
	date_default_timezone_set('UTC');
	$date_paques = paques(0, $year);
	$date = date('Y-m-d', strtotime("$date_paques +50 day"));
	return $date;
}

private function paques($Jourj=0, $annee=NULL)
{
    /* *** Algorithme de Oudin, calcul de Pâque postérieure à 1583 ***
     * Transcription pour le langage PHP par david96 le 23/03/2010
     * *** Source : www.concepteursite.com/paques.php ***
     * Attributs de la fonction :
     * $Jourj : représente le jour de la semaine
     * (0=dimanche, 1=lundi...)
     * par défaut c'est le dimanche
     * $annee : représente l'année recherchée pour la date de Pâques
     * par défaut c'est l'année en cours.
     * */
    $annee=($annee==NULL) ? date("Y") : $annee;

    $G = $annee%19;
    $C = floor($annee/100);
    $C_4 = floor($C/4);
    $E = floor((8*$C + 13)/25);
    $H = (19*$G + $C - $C_4 - $E + 15)%30;

    if($H==29)
    {
        $H=28;
    }
    elseif($H==28 && $G>10)
    {
        $H=27;
    }
    $K = floor($H/28);
    $P = floor(29/($H+1));
    $Q = floor((21-$G)/11);
    $I = ($K*$P*$Q - 1)*$K + $H;
    $B = floor($annee/4) + $annee;
    $J1 = $B + $I + 2 + $C_4 - $C;
    $J2 = $J1%7; //jour de pâques (0=dimanche, 1=lundi....)
    $R = 28 + $I - $J2; // résultat final :)
    $mois = $R>30 ? 4 : 3; // mois (1 = janvier, ... 3 = mars...)
    $Jour = $mois==3 ? $R : $R-31;

    return date("Y-m-d",mktime(0,0,0,$mois,$Jour+$Jourj,$annee));
}


?>