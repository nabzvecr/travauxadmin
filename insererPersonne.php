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
				nom du script : insererPersonne.php
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
				<h1>Ajoutez une personne</h1>
				<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
					<div>
	<label for="zoneNom" >Nom :</label>
		<input class="form-control" type="text" id="zoneNom" name="zoneNom" placeholder="Entrez le nom" required />
	</div>
	<div>
		<label for="zonePrenom">Prénom : </label>
		<input class="form-control" type="text" name="zonePrenom" placeholder="Entrez le prénom" required />
	</div>
	<div>
	<label for="zoneVille"> Ville :</label>
		<input class="form-control" type="text" name="zoneVille" placeholder="Entrez la ville">
		</select>
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

				$nomRecus	= utf8_decode($_POST['zoneNom']);
				$prenomRecus= utf8_decode($_POST['zonePrenom']);
				$villeRecus	= $_POST['zoneVille'];
				

			if ($conn = mysqli_connect($host, $user, $passwd, $mabase))
			{
				$reqInsert = " INSERT INTO personne(nom, prenom, ville) VALUES ('$nomRecus', '$prenomRecus', '$villeRecus')";

				if ($result = mysqli_query($conn, $reqInsert, MYSQLI_USE_RESULT)) 
				{
					echo'<h2>Vous avez ajouté la personne</h2>';
					echo '<a class="font" href="/accueilAdmin.html">Revenir à l\'accueil </a>';
				}
				else
				{
					die('<script type="text/javascript">alert("bug , verifier qu il n y ait pas  d accent ou caracteres speciaux");location.replace("javascript:history.go(-1)")</script>');
				}
			}
			}
			function sanitizeString($var)
 			{
 				if (get_magic_quotes_gpc())
 				{
 					$var = stripslashes($var);
 				}
 				$var = strip_tags($var);
 				$var = htmlentities($var);
 				return $var;

 			}
			
 
?>
	</body>
</html>