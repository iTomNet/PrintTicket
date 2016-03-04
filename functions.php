<?php

	/**
	 *
	 * @author Tommy Gruwez
	 * @package PrintTicket
	 */
	/**
	 * Fonction permettant la récupération du dernier enregistrement
	 *
	 * @return Liste des données du dernier enregistrement
	 */
	function lastTicket(){
		global $db;
		$qry = $db->prepare("SELECT * FROM ticket LIMIT 1");
		return $qry->execute();
	}

	/**
	 * Fonction d'enreistrement d'un nouveau ticket
	 *
	 * @param int $numero_recu du nouveau ticket
	 * @param int $numero_ticket du nouveau ticket
	 * @param date $date_entree date d'entree dans le parking
	 * @param date $date_sortie date de sortie du parking
	 * @param int $prix du ticket
	 * @param int $tva du ticket
	 * @return Insertion du nouveua ticket
	 */
	function insertTicket($numero_recu, $numero_ticket, $date_entree, $date_sortie, $prix, $tva){
		global $db;
		$qry = $db->prepare("	INSERT INTO ticket 
								SET 	numero_recu=?,
										numero_ticket=?,
										dtae_entree=?,
										date_sortie=?,
										prix=?,
										tva=?");
		return $qry->execute(array(
				$numero_recu,
				$numero_ticket,
				$date_entree,
				$date_sortie,
				$prix,
				$tva
		));
	}

?>