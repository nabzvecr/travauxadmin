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
				nom du script : insererLivres.php
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
				<h1>Ajoutez un livre</h1>
				<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
					<div class="form-group">
	<label for="zoneTitre" >Titre :</label>
		<input class="form-control" type="text" id="zoneTitre" name="zoneTitre" placeholder="Entrez le titre du livre" size="7" required />
	</div>
	<div class="form-group">
		<label  for="zoneAuteur">Auteur : </label>
		<input class="form-control" type="text" name="zoneAuteur" placeholder="Entrez l'auteur" required />
	</div>
	<div class="form-group">
	<label for="zoneGenre"> Sélectionner le genre : </label>	
		<select class="custom-select mr-sm-2" name="zoneGenre" id="zoneGenre">
			<option>Roman</option>
			<option>Nouvelle</option>
			<option>BD</option>
			<option>Poesie</option>
		</select>
	</div>
	<div class="form-group">
		<label  for="zonePrix">Prix : </label>
		<input class="form-control2" type="number" name="zonePrix" id="zonePrix" required/>
	</div>
	<div class="form-group">
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

				$titreRecus	= utf8_decode($_POST['zoneTitre']);
				$auteurRecus= utf8_decode($_POST['zoneAuteur']);
				$genreRecus	= utf8_decode($_POST['zoneGenre']);
				$prixRecus	= $_POST['zonePrix'];


				$titreRecus	= sanitizeString($titreRecus);
				$auteurRecus= sanitizeString($auteurRecus);
				$genreRecus	= sanitizeString($genreRecus);
				$prixRecus	= sanitizeString($prixRecus);

			if ($conn = mysqli_connect($host, $user, $passwd, $mabase))
			{
				$reqInsert = " INSERT INTO livre(titre, auteur, genre, prix) VALUES ('$titreRecus', '$auteurRecus', '$genreRecus', $prixRecus)";

				if ($result = mysqli_query($conn, $reqInsert, MYSQLI_USE_RESULT)) 
				{
					echo'<h2>Vous avez ajouté le livre</h2>';
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
