<!doctype html>
<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <title>Bibliothèque en ligne</title>
	  <link rel="stylesheet" type="text/css" href="../creative.css">
	</head>
	<body>
			<h1>Client(e)s emprunteurs/rices </h1>
			<!--Définition d'un tableau HTML -->
			<table> 
				<tr><th>Numlivre</th><th>Titre</th><th>Auteur</th><th>Genre</th><th>Numpersonne</th><th>Nom</th><th>Prenom</th><th>Ville</th><th>Sortie</th><th>Retour</th></tr>
		   
		  <?php
			/*************************************************************************
				nom du script : affiche_emprunteur.php
				Description : ce script se connecte au SGBD MySQL,
				              envoie une requête pour recuperrer les données
							  de la table livre et affiche le résultat dans un
							  tableau HTML
				Version : 1.0
				Date	: 19/11/2019
				Auteur	: prof
			*************************************************************************/
			
			// paramètres de connexion
			$host 	= 'localhost';
			$user 	= 'root' ;   
			$passwd = '';
			$mabase = 'biblio2';
			
			//tentative de connexion au SGBD MySQL  
			if ($conn = mysqli_connect($host,$user,$passwd,$mabase))
			{
				// connexion à la base de données OK
				// preparation de la requête
				$req = "SELECT * FROM emprunt join personne on emprunt.numpersonne=personne.numpersonne
											  join livre on emprunt.numlivre=livre.numlivre";	
				
				// envoie de la requete
				if($result = mysqli_query($conn, $req, MYSQLI_USE_RESULT))
				{
					// requête ok il faut traiter la réponse
					// tant qu'il y a des ligne à traiter
					while ( $row =mysqli_fetch_assoc($result))
					{
						// on recupere les champs de la ligne
						$numLivreLue 	= $row['numlivre'];
						$numpersonneLue = utf8_encode ($row['numpersonne']);
						$nomLue 		= utf8_encode ($row['nom']);
						$prenomLue		= utf8_encode ($row['prenom']);
						$villeLue		= utf8_encode ($row['ville']);
						$titreLue		= utf8_encode ($row['titre']);
						$auteurLue		= utf8_encode ($row['auteur']);
						$genreLue		= utf8_encode ($row['genre']);
						$sortieLue 		= utf8_encode ($row['sortie']);
						$retourLue 		= utf8_encode ($row['retour']);
						
						
						// afficher la ligne
						echo "<tr><td>$numLivreLue</td><td>$titreLue</td><td>$auteurLue</td><td>$genreLue</td><td>$numpersonneLue</td><td>$nomLue</td><td>$prenomLue</td><td>$villeLue</td><td>$sortieLue</td><td>$retourLue</td></tr>";
					}
				}
				else{
					// erreur de requête
					die ("erreur de requête");
				}
			}
			else{
					// echec de la connexion à la BD 
				die("problême de connexion au serveur de base de données");	
			}
				
			
		  
		  
		  
		  
		  ?>
		  </table>
 <a class="btn btn-outline-success" href="javascript:history.go(-1)">Retour à l'acceuil</a>
	</body>
</html>
