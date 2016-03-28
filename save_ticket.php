<!DOCTYPE html>
<html lang="fr">
	<head>
    	<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="static/css/style.css">
	</header>
	<body>

		<?php
			include('functions_main.php')
			include('functions.php';)

			$error = 0;
			$numero_recu = $_POST['numero_recu'];
			$numero_ticket = $_POST['numero_ticket'];
			$date_entree = versTimeStamp($_POST['date_entree']);
			$date_sortie = versTimeStamp($_POST['date_sortie']);
			$prix = $_POST['prix'];
			$tva = $_POST['tva'];

			if(!isset($numero_recu) || !isset($numero_ticket) || !isset($date_entree) || !isset($date_sortie) || !isset($prix) || !isset($tva)){
				$error = 1;
			}

			if($error == 0){
				insertTicket($numero_recu, $numero_ticket, $date_entree, $date_sortie, $prix, $tva);
				Echo('Enregistrement OK');
			}
		?>

		<!-- Mise en forme du ticket -->

		<div class="ticket">
			     DESIGNA  FRANCE</br>
			      OSNY – CERGY</br>
			</br>
			SORTIE        :    20</br>
			RECU NO  :         21088</br>
			</br>
			TICKET HORAIRE</br>
			 No  01  011  0035428</br>
			ENTR . 25 .02 .16 09 :07</br>
			PAYE . 25 .02 .16 17 :14</br>
			???????</br>
			 No EMV00XXXX0000000</br>
			</br>
			PRIX    :       6.00 EUR</br>
			PAYE    :       6.00 EUR</br>
			------------------------</br>
			TVA  20.0%      1.00 EUR</br>
			PAYE HT   :     5.00 EUR</br>
			------------------------</br>
			  0Jr  08Hr  06Min</br>
			</br>
			MERCI ET AU REVOIR</br>

		</div>
	</body>
</html>