<!doctype html>
<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <title>Bibliothèque en ligne</title>
	  <link rel="stylesheet" type="text/css" href="../creative.css"> 
	</head>
	<body>
			<!--Définition d'un tableau HTML -->
		   
		  <?php
			/*************************************************************************
				nom du script : insererEmprunteur.php
				Description : ce script se connecte au SGBD MySQL,
				              envoie une requête pour insérer des données
							  de la table livre et affiche le résultat dans un
							  tableau HTML
				Version : 1.0
				Date	: 26/11/2019
				Auteur	: prof
			*************************************************************************/
			
			// paramètres de connexion
			
			if(!isset($_POST["Valider"]))
			{
			?>
			<h1>Ajoutez un emprunt</h1>
			<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
			<div>
				<label for="zoneNumlivre" >Numéro du livres :</label>
				<input class="form-control2" type="number" id="zoneNumlivre" name="zoneNumlivre" placeholder="Entrez le numéro du livre" required />
			</div>
			<div>
				<label for="zoneNumpersonne">Numéro de la personne : </label>
				<input class="form-control2" type="number" name="zoneNumpersonne" placeholder="Entrez le numéro de la personne" required />
			</div>
			<div>
				<label for="zoneSortie"> Mettre la date d'emprunt : </label>
				<input class="form-control2" type="date" name="zoneSortie" placeholder="Entrez la date d'emprunt">
			</div>
			<div>
				<label for="zoneRetour" >Mettre la date de retour d'emprunt :</label>
				<input class="form-control2" type="date" id="zoneRetour" name="zoneRetour" placeholder="Entrez la date de retour du livre" required />
			</div>
			<div>
				<button type="submit" class="btn btn-outline-success" name="Valider">Valider</button>
				<button type="reset" class="btn btn-outline-warning">Réinitialiser</button>
			</div>
	
			</form>
			<a class="btn btn-outline-success" href="javascript:history.go(-1)">Retour à l'acceuil</a>
			<?php
 			}
			else 
			{
				$host 	= 'localhost';
				$user 	= 'root' ;   
				$passwd = '';
				$mabase = 'biblio2';

				$numlivreRecus	= utf8_decode($_POST['zoneNumlivre']);
				$numpersonneRecus= utf8_decode($_POST['zoneNumpersonne']);
				$sortieRecus	= $_POST['zoneSortie'];
				$retourRecus	= utf8_decode($_POST['zoneRetour']);
				

			if ($conn = mysqli_connect($host, $user, $passwd, $mabase))
			{
				$reqInsert = " INSERT INTO emprunt(numlivre, numpersonne, sortie, retour) VALUES ('$numlivreRecus', '$numpersonneRecus', '$sortieRecus','$retourRecus')";

				if ($result = mysqli_query($conn, $reqInsert, MYSQLI_USE_RESULT)) 
				{
					echo'<h2>Vous avez ajouté un emprunt</h2>';
					echo '<a class="font" href="/accueilAdmin.html">Revenir à l\'accueil </a>';
				}
				else
				{
					die('<script type="text/javascript">alert("N°livre N°personne et/ou date incorect");location.replace("javascript:history.go(-1)")</script>');
				}
			}
			}
			
 
?>
	</body>
</html>