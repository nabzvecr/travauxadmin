<!doctype html>
<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <title>S'inscrire</title>
	<link rel="stylesheet" type="text/css" href="./creative.css">
	</head>
	<body>
	<h3 class="white">S'inscrire dès maintenant !</h3>
						<form action="inscription.php" method="post" class="popup-form">
							<input type="email" class="form-control form-white"  id="ZoneEmail" name="zoneEmail" placeholder="Email" required>
							<input type="password" class="form-control form-white" id="ZonePassword" name="zonePassword" placeholder="Mot de passe" required>
							<input type="text" class="form-control form-white" id="ZoneNom" name="zoneNom" placeholder="Nom" required>
							<input type="text" class="form-control form-white" id="ZonePrenom" name="zonePrenom" placeholder="Prénom" required> 
							<input type="text" class="form-control form-white" id="ZoneVille" name="zoneVille" placeholder="Ville" required>
							<button type="submit" name="Valider" class="btn btn-outline-success">Valider</button>
							
						</form>
		<?php
			/*************************************************************************
				nom du script : inscription.php
				Description   : Ce script propose un formulaire d'inscription.
								Une fois le formulaire soumis, ce script récupere
								les données, les vérifie.
								Si tout est OK le login et le mot de passe crypté
								est ajouté à la base de données
				Version : 1.0
				Date	: 17/12/2019
				Auteur	: prof
			*************************************************************************/
			
			// on determine si on doit afficher ou traiter le formulaire
			if (isset($_POST["Valider"]))
			{
				// traitement des données envoyées par le formulaire
				
				/* on recupere les données du formulaire et on les "aseptise" avant de les utiliser 
				   pour cela on va creer une fonction de nettoyage qu'on va utiliser
				*/
				
				$email_Lue    = utf8_decode($_POST['zoneEmail']);
				$MotDepasse	  = utf8_decode($_POST['zonePassword']);
				$nomLue		  = utf8_decode($_POST['zoneNom']);
				$prenomLue    = utf8_decode($_POST['zonePrenom']);
				$villeLue	  = utf8_decode($_POST['zoneVille']);
			
				
				/* on aseptise les données récupérées avant de les utiliser = lutte faille XSS */
				$email_Lue  = sanitizeString($email_Lue);
				$MotDepasse = sanitizeString($MotDepasse);
				$nomLue		= sanitizeString($nomLue);
				$prenomLue	= sanitizeString($prenomLue);
				$villeLue	= sanitizeString($villeLue);
				
				// on verifie que l'émail n'est pas vide et que les mot de passe sont identique
				if (empty($email_Lue) || empty($MotDepasse) || empty($nomLue) || empty($prenomLue) || empty($villeLue))
				{
					echo " tous les champs ne sont pas complétés/vous avez mis un accent au prénom";
				}
				else
				{
					// on enregistre les données dans la BD 
					// on se connecte au SGBD
				
					// paramètres de connexion
					$host 	= 'localhost';
					$user 	= 'root' ;   
					$passwd = '';
					$mabase = 'biblio2';
					
					// on crypte (hachage) le mot de passe 
					$MotPassCrypte = password_hash($MotDepasse, PASSWORD_DEFAULT);
									
					// on envoie une requete pour inserrer les données
				
					//tentative de connexion au SGBD MySQL  
					if ($conn = mysqli_connect($host,$user,$passwd,$mabase))
					{
						// connexion OK, on prepare la requete et on l'envoie
							
						// préparation de la requête
						$reqInsert = " INSERT INTO connexion (email, mdp)
									   VALUES ('$email_Lue','$MotPassCrypte')";
						$reqInsert1 = " INSERT INTO personne (nom, prenom, ville)
										VALUES ('$nomLue','$prenomLue','$villeLue')";
									   
												
						// on tente d'envoyer la requête
						if($result = mysqli_query($conn, $reqInsert, MYSQLI_USE_RESULT))
						{
							if($result1 = mysqli_query($conn, $reqInsert1, MYSQLI_USE_RESULT))
							{
							echo '<h1>Vous êtes enregistré<h1>';
							echo '<a class="font"  href="index.php">Page d\'accueil du site </a>';
							}
						}
						else
						{
							// erreur de requête
						
							die ('<script type="text/javascript">alert("utilisateur deja enregistré/même coordonnées");location.replace("javascript:history.go(-1)")</script>');
						}
					
					}	
					else
					{
						// echec de la connexion à la BD 
						die("problème de connexion au serveur de base de données");	
					}
				}	
					
			}
								
				/* Fonctions pour aseptiser les données utilisateurs */
				// aseptiser les chaines de caractères
				function sanitizeString($var)
				{
					if (get_magic_quotes_gpc())
					{
						// supprimer les slashes
						$var = stripslashes($var);
					}
					// suppression des tags
					$var = strip_tags($var);
					// convertir la chaine en HTML
					$var = htmlentities ($var);
					return $var;
				}
				
					
			?>	
	
	</body>
</html>