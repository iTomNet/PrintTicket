<?php

	//fonction de conversion des valeurs de champs de date JJ/MM/AAAA ==> AAAA-MM-JJ
	function versDateMySQL($date)
	{
		if (isset($date) && $date!='')
		{
			$composantes=explode('/',$date);
			return (sprintf('%04d',$composantes[2]) . '-' . sprintf('%02d',$composantes[1]) . '-' . sprintf('%02d',$composantes[0]));
		}
		else
		{
			return '';
		}
	}
	
	// fonction de conversion de date AAAA-MM-JJ ==> JJ/MM/AAAA
	function versDateStandard($date)
	{
		if (isset($date) && $date!='')
		{
			$composantes=explode('-',$date);
			return (substr($composantes[2],0,2) . '/' . $composantes[1] . '/' . $composantes[0]); // le substr pour le cas où on a envoyé un datetime
		}else
		{
			return '';
		}
	}
	
	// fonction de conversion de date AAAA-MM-JJ ==> JJ-MM-AAAA
	function versDateStandardUS($date)
	{
		if (isset($date) && $date!='')
		{
			$composantes=explode('-',$date);
			return (substr($composantes[2],0,2) . '-' . $composantes[1] . '-' . $composantes[0]); // le substr pour le cas où on a envoyé un datetime
		}else
		{
			return '';
		}
	}
	
	// fonction de conversion de date AAAA-MM-JJ ==> JJ/MM
	function versDateStandardSansAnnee($date)
	{
		if (isset($date) && $date!='')
		{
			$composantes=explode('-',$date);
			return (substr($composantes[2],0,2) . '/' . $composantes[1]); // le substr pour le cas où on a envoyé un datetime
		}else
		{
			return '';
		}
	}
	
	// fonction de conversion de date et heure AAAA-MM-JJ HH:NN:SS ==> JJ/MM/AAAA HH:NN
	function versDateHeureStandard($dateTime)
	{
		if (isset($dateTime) && $dateTime!='')
		{
			return (versDateStandard(substr($dateTime,0,10)) . substr($dateTime,10,6));
		}
		else
		{
			return '';
		}
	}
	
	// fonction de conversion de date et heure AAAA-MM-JJ HH:NN:SS ==> JJ/MM HH:NN
	function versDateHeureStandardSansAnnee($dateTime)
	{
		if (isset($dateTime) && $dateTime!='')
		{
			return (versDateStandardSansAnnee(substr($dateTime,0,10)) . substr($dateTime,10,6));
		}
		else
		{
			return '';
		}
	}
	
	// fonction de récupération de l'heure standard
	function versHeureStandard($dateTime)
	{
		if (isset($dateTime) && $dateTime!='')
		{
			return (substr($dateTime,10,6));
		}
		else
		{
			return '';
		}
	}
	
	//fonction de conversion d'une date au format numérique AAAAMMJJ en format MySQL
	function numversDateMySQL($date)
	{
		if (isset($date) && $date!='')
		{
			return substr($date,0,4) . '-' . substr($date,4,2) . '-' . substr($date,6,2);
		}
		else
		{
			return '';
		}
	}
	
	//fonction qui renvoie la date au format MySQL d'un timestamp : Timestamp ==> AAAA-MM-JJ
	function versDateUS($timestamp)
	{
	  $datetime = date('Y-m-d', $timestamp);
	  return $datetime;
	}
	
	//fonction qui renvoie la date au format MySQL d'un timestamp : Timestamp ==> AAAA-MM-JJ HH:NN:SS
	function versDateTimeUS($timestamp)
	{
	  $datetime = date('Y-m-d H:i:s', $timestamp);
	  return $datetime;
	}
	
	//fonction qui renvoie la date au format MySQL d'un timestamp : Timestamp ==> AAAA-MM-JJ
	function versDateFR($timestamp)
	{
	  $datetime = date('d-m-Y', $timestamp);
	  return $datetime;
	}
	
	//fonction qui renvoie la date au format MySQL d'un timestamp : Timestamp ==> AAAA-MM-JJ HH:NN:SS
	function versDateTimeFR($timestamp)
	{
	  $datetime = date('d-m-Y H:i:s', $timestamp);
	  return $datetime;
	}
	
	//fonction qui renvoie le timestamp d'une date au format MySQL : AAAA-MM-JJ HH:NN:SS ==> Timestamp
	function versTimeStamp($date) {
		$annee=substr($date,0,4);
		$mois=substr($date,5,2);
		$jour=substr($date,8,2);
		$heure=substr($date,11,2);
		$minute=substr($date,14,2);
		$seconde=substr($date,17,2);
		
		return mktime($heure,$minute,$seconde,$mois,$jour,$annee);
	
	}
	
	//fonction qui renvoie l'initiale du mois de numéro indiqué
	function lettreMois($mois) {
		return substr("JFMAMJJASOND",$mois-1,1);	
	}
	
	//fonction qui renvoie le nombre de jours du mois de numéro indiqué
	function nombreJoursMois($mois)
	{
		return substr( "312831303130313130313031", ( $mois - 1 ) * 2, 2 );
	}
	
	//fonction qui renvoie le nom court du jour de la semaine (1=lundi, 7=dimanche)
	function nomCourtJourSemaine($num) {
		return substr("LuMaMeJeVeSaDi",($num-1)*2,2);
	}
	
	//fonction qui renvoie le nom long du jour de la semaine (1=lundi, 7=dimanche)
	function nomLongJourSemaine($num)
	{
		switch($num)
		{
			case 1:return 'lundi';
			case 2:return 'mardi';
			case 3:return 'mercredi';
			case 4:return 'jeudi';
			case 5:return 'vendredi';
			case 6:return 'samedi';
			case 7:return 'dimanche';
			default:return '*** inconnu ***';
		}
	}
	
	//fonction qui renvoie le timestamp du premier jour de la semaine passée en paramètre
	//$a : année, $s : semaine
	function timestampPremierJourSemaine($a,$s)
	{
		//test si la semaine demandée existe pour l'année demandée
		//recherche de numéro de la dernière semaine de l'année (qui n'est pas forcément le numéro de la semaine du 31/12 !!!)
		$ts = mktime( 0, 0, 0, 12, 31, $a );
		while( date( 'W', $ts ) < 50 )
			$ts -= 86400;
			
		//vérification de la validité du numéro de semaine
		if ($s<=0 || $s>date('W',$ts)){
			return false;
		}
		//la semaine existe, on calcule !
				
		$ts=mktime( 12, 0, 0, 1, 1 + 7 * ( $s - 1 ), $a ); //timestamp du 1er janvier + s semaines de l'année a
		//ON SE PLACE A 12h POUR EVITER UN SAUT DE SEMAINE LORS DU CHANGEMENT D'HEURE !!!
		
		//si l'année ou la semaine obtenue ne sont pas conformes, on incrémente (cas où le 1er janvier est dans la dernière semaine de l'année précédente)
		while( date( 'Y', $ts ) != $a || date( 'W', $ts ) != $s )
			$ts+=86400; // nb de secondes dans une journée
		
		//une fois qu'on est sur la bonne semaine, on se ramène au lundi
		//cette opération est nécessaire pour les années pour lesquelles le 1er janvier se situe après le premier jour de la première semaine !!!!
		while( date( 'W', $ts - 86400 ) == $s )
			$ts -= 86400;
		
		return $ts;
	}
	
	//retourne le jour $j de la semaine $s de l'année $a.
	function timestampJourSemaine( $a, $s, $j )
	{
		return ( timestampPremierJourSemaine( $a, $s ) + ( $j - 1 ) * 24 * 3600 );
	}
	
	//fonction qui calcule l'écart en nombre de jours entre 2 timestamps, en prenant en compte le jour de chaque timestamp
	// cette fonction est utile pour calculer des écarts entre dates, en évitant de faire des arrondis de pas de 86400s,
	// en particulier aux périodes de changements d'heure où les journées ne font pas 24h...
	// le nombre renvoyé sera positif si $ts2>$ts1
	function ecartJours($ts1,$ts2)
	{
		$a1=date('Y',$ts1); //année
		$m1=date('n',$ts1); //mois sans zéro initial
		$j1=date('j',$ts1); //jour sans zéro initial
		$a2=date('Y',$ts2); //année
		$m2=date('n',$ts2); //mois sans zéro initial
		$j2=date('j',$ts2); //jour sans zéro initial
		if ($a1==$a2 && $m1==$m2)
		{
			//si les deux timestamps sont dans le même mois de la même année, calcul simple
			return($j2-$j1);
		}else
		{
			//timestamp de fin du calcul, calés sur 12h
			$tsFin = mktime( 12,0,0,$m2,$j2,$a2 );
			$delta=0;
			
			//sens du pas pour aller de $ts1 à $ts2 : vers le futur(1) ou vers le passé (-1)
			if( $ts2 > $ts1 ){
				while( mktime( 12, 0, 0, $m1, ( $j1 + $delta ), $a1) < $tsFin )
					$delta++;
			}else{
				while( mktime( 12, 0, 0, $m1, ( $j1 + $delta ), $a1) > $tsFin )
					$delta--;
			}			
			
			return $delta;
		}
	
	}
	
	function timestampTrimestre( $timestamp )
	{
		$mois = date( 'n', $timestamp );
		return( ceil ( ( $mois ) / 3 ) );
	}
	
	//fonction qui renvoie le trimestre du  mois passé en paramètre
	function trimestreDuMois($mois){
		return(floor($mois-1)/3+1);
	}
	
	//fonction qui renvoie le trimestre de la semaine passée en paramètre
	function trimestreDeLaSemaine( $annee, $semaine )
	{
		$mois = getMonthHebdo( $annee, $semaine );
		return( ceil ( ( $mois ) / 3 ) );
	}
	
	//fonction qui renvoie la semaine de l'année, du  mois et du jour passées en paramètre
	function semaineDuJour($annee, $mois, $jour){
		//timestamp du premier jour du mois
		$ts=mktime( 12,0,0,$mois,$jour,$annee );
		return date('W', $ts);
	}
	function PremiereSemaineTrimestreHebdo( $annee, $semaine )
	{
		// On récupère le timestamp du premier jour de la semaine en cours.
		$ts = timestampPremierJourSemaine( $annee, $semaine );

		// On ajoute 3 jours et 12 heures pour atteindre le jeudi de cette semaine.
		$ts += 3600 * 24 * 3;
		
		// On récupère le mois du jeudi
		$mois = date( "n", $ts);
		
		// On récupère le trimestre du mois du jeudi
		$trimestre = ceil ( $mois / 3 );
		
		// On fait des pas de 7 jours en arrière tout en vérifiant qu'on ne change pas de trimestre
		while( ceil ( date( "n", $ts - 3600 * 24 * 7 ) / 3 ) == $trimestre )
			$ts -= 3600 * 24 * 7;
			
		return (date('W', $ts - 3600 * 24 * 3));
	}
	
	function DerniereSemaineTrimestreHebdo( $annee, $semaine )
	{
		// On récupère le timestamp du premier jour de la semaine en cours.
		$ts = timestampPremierJourSemaine( $annee, $semaine );

		// On ajoute 3 jours et 12 heures pour atteindre le jeudi de cette semaine.
		$ts += 3600 * 24 * 3;
		
		// On récupère le mois du jeudi
		$mois = date( "n", $ts);
		
		// On récupère le trimestre du mois du jeudi
		$trimestre = ceil ( $mois / 3 );
		
		// On fait des pas de 7 jours en arrière tout en vérifiant qu'on ne change pas de trimestre
		while( ceil ( date( "n", $ts + 3600 * 24 * 7 ) / 3 ) == $trimestre )
			$ts += 3600 * 24 * 7;
			
		return (date('W', $ts + 3600 * 24 * 3));
	}

	function PremiereSemaineMoisHebdo( $annee, $semaine )
	{
		// On récupère le timestamp du premier jour de la semaine en cours.
		$ts = timestampPremierJourSemaine( $annee, $semaine );

		// On ajoute 3 jours et 12 heures pour atteindre le jeudi de cette semaine.
		$ts += 3600 * 24 * 3;
		
		// On récupère le mois du jeudi
		$mois = date( "n", $ts);
		
		// On fait des pas de 7 jours en arrière tout en vérifiant qu'on ne change pas de mois
		while( date( "n", $ts - 3600 * 24 * 7 ) == $mois )
			$ts -= 3600 * 24 * 7;
			
		return (date('W', $ts - 3600 * 24 * 3));
	}
	
	function DerniereSemaineMoisHebdo( $annee, $semaine )
	{
		// On récupère le timestamp du premier jour de la semaine en cours.
		$ts = timestampPremierJourSemaine( $annee, $semaine );

		// On ajoute 3 jours et 12 heures pour atteindre le jeudi de cette semaine.
		$ts += 3600 * 24 * 3;
		
		// On récupère le mois du jeudi
		$mois = date( "n", $ts);	
		
		// On fait des pas de 7 jours en avant tout en vérifiant qu'on ne change pas de mois
		while( date( "n", $ts + 3600 * 24 * 7 ) == $mois )
			$ts += 3600 * 24 * 7;
			
		return (date('W', $ts + 3600 * 24 * 3));
	}
	
	//fonction qui renvoie l'année correspondant à la semaine du timestamp fourni.
	//utile pour les derniers ou premiers jours d'une année
	// ex 31/12/2012 = semaine 1 de 2013
	function anneeDeLaSemaine($ts)
	{
		$annee = date( 'Y', $ts );
		$mois=date( 'n', $ts );
		$semaine=date( 'W', $ts );
	
		//cas première semaine de l'année démarrant par un jour de l'année précédente
		if ( $semaine == 1 && $mois == 12 )
		{
			return( $annee + 1 );
		}
		
		//cas dernière semaine de l'année finissant par un jour de l'année suivante
		if ( $semaine >50  && $mois == 1 )
		{
			return( $annee - 1 );
		}
		
		//cas général
		return $annee;
	}
	
	//fonction qui renvoie le numero du mois en fonction de l'année et de la semaine
	//ex annee:2013, semaine:2 => mois:1
	function getMonth( $annee, $semaine )
	{
		$mois = 1;
		while( $mois < 13 )
		{
			$jour = 1;
			while( $jour < 32 )
			{
				if( checkdate( $mois, $jour, $annee ) )
				{
					if( date( "W", mktime( 0, 0, 0, $mois, $jour, $annee ) ) == $semaine )
						return $mois;
				}
				$jour++;
			}
			$mois++;
		}
	}
	//fonction qui renvoie le mois hebdo associé à la semaine = le mois du jeudi de la semaine
	function getMonthHebdo( $annee, $semaine )
	{
		$ts=timestampPremierJourSemaine($annee,$semaine); //timestamp du lundi de la semaine
		$ts+=3*86400; //timestamp du jeudi de la semaine
		return(date('n',$ts));
		
	}

	//fonction qui renvoie le timestamp du premier jour de la première semaine d'un mois hebdo
	function timestampPremiereSemaineMoisHebdo($annee,$mois){
		//timestamp du premier jour du mois
		$ts=mktime( 12,0,0,$mois,1,$annee );
		
		//numéro du jour dans la semaine
		$num_jour=date('N',$ts);
		
		//si le premier jour du mois est après le jeudi, la première semaine du mois est donc la suivante, on se décale d'une semaine
		if ($num_jour>4){
			$ts+=604800;
		}
		
		//on se ramène au lundi de la semaine
		$ts-=($num_jour-1)*86400;
		
		return $ts;
	}
	
	//fonction qui renvoie le timestamp du dernier jour de la première semaine d'un mois hebdo
	function timestampDerniereSemaineMoisHebdo($annee,$mois){
		
		//on récupère le timestamp du premier jour de la première semaine du mois suivant
		if ($mois<12){
			$ts=timestampPremiereSemaineMoisHebdo($annee,$mois+1);
		}else{
			$ts=timestampPremiereSemaineMoisHebdo($annee+1,1);		
		}
		
		//on recule d'une semaine
		$ts-=604800;
		
		return $ts;
	}
	
	//fonction qui renvoie le timestamp du premier jour de la première semaine d'un trimestre
	function timestampPremiereSemaineTrimestreHebdo($annee, $trimestre){
		$mois = ($trimestre - 1) * 3 + 1;
		return timestampPremiereSemaineMoisHebdo($annee,$mois);
	}
	
	//fonction qui renvoie le timestamp du premier jour de la derniere semaine d'un trimestre
	function timestampDerniereSemaineTrimestreHebdo($annee, $trimestre){
		$mois = ($trimestre - 1) * 3 + 1;
		$mois +=2; //On se place au dernier mois du trimestre
		return timestampDerniereSemaineMoisHebdo($annee,$mois);
		
	}
	
	/* nombre de semaines dans une année $annee */
	function NombreSemainesDansAnnee($annee)
	{
		$jour = mktime(0,0,0, 12, 31, $annee);
		$semaine = date("W", $jour);

		if ($semaine == 1)
			return 52;
		else return $semaine;
	}

	
	/**
	*	Fonction de sauvegarde de la trace d'une mise à jour
	*	@param $codeMaj 		varchar(30) Libelle/Item/Code de la mise à jour
	*	@param $userFirstName 	varchar		Prénom de la personne ayant fait la mise à jour
	*	@param $userLastName 	varchar 	Nom de la personne ayant fait la mise à jour
	*	@param $fileMajName 	varchar		Nom du fichier téléchargé
	*
	*/
	function traceMaj($codeMaj,$userFirstName,$userLastName,$fileMajName){
		global $db;
		
		$qryMaj=$db->prepare('INSERT INTO dates_maj SET Item=?,DateMaj=NOW(),MajPar=?,Info=?');
		$qryMaj->execute(array($codeMaj,$userFirstName . ' ' . $userLastName,substr($fileMajName,0,100)));	
	}
	
	/**
	*	Fonction qui permet d'insérer une valeur n'importe où dans un tableau à l'aide de l'indice
	*	@param array $tab Le tableau où l'on va insérer la nouvelle valeur.
	*	@param int|string|bool $valeurInsert La valeur à insérer.
	*	@param int $indice La position à laquelle on veut ajouter la valeur.
	*	@return array Un nouveau tableau qui contient notre nouvelle valeur placée.
	*/
	function insert_i($tab,$valeurInsert,$indice)
	{
		$nouveauTab = array();
		foreach($tab as $cle=>$valeur)
		{
		   if ($cle == $indice)
				array_push($nouveauTab,$valeurInsert);
	 
		   array_push($nouveauTab,$valeur);
		}
	 
	   return $nouveauTab;
	}
	
	/**
	*	Fonction qui permet de calculer le nombre de jour entre deux dates
	*	@param date $debut
	*	@param date $fin
	*	@return int le nombre de jours entre les deux dates
	*/
	function nbJours($debut, $fin) {
        //60 secondes X 60 minutes X 24 heures dans une journée
        $nbSecondes= 60*60*24;
 
        $debut_ts = strtotime($debut);
        $fin_ts = strtotime($fin);
        $diff = $fin_ts - $debut_ts;
        return round($diff / $nbSecondes);
    }
	
?>