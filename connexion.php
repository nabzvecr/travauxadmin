<!doctype html>
<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <title>Connexion</title>

	<link rel="stylesheet" type="text/css" href="./creative.css">
	</head>
	<body>
	<h3 class="white">Se connecter !</h3>
					<form action="connexion.php" class="popup-form" method="post">
						<input type="email" class="form-control form-white" name = "zoneEmail" placeholder="Email" required>
						<input type="password" class="form-control form-white" name = "zonePassword" placeholder="Mot de passe" required>
						<div class="checkbox-holder text-left">
							
						</div>
						<button type="submit" name="Valider" class="btn btn-outline-success">Se connecter</button>
					</form>
		<?php
		/*************************************************************************
				nom du script : connexion.php
				Description   : Ce script propose un  formulaire de connexion.
								Une fois le formulaire soumis les données sont
								comparées à celles enregistrées dans la BD.
								Si les paramètres de connexions sont correctes
								on enregistre l'email de l'utilisateur dans une 
								variable de session et on indique à l'utilisateur 
								qu'il est connecté
				Version : 1.0
				Date	: 13/12/2019
				Auteur	: prof
			*************************************************************************/
			
			// on determine si on doit afficher ou traiter le formulaire
			if (isset($_POST["Valider"]))
			{
				// traitement des données envoyées par le formulaire
				
				/* on recupere les données du formulaire et on les "aseptise" avant de les utiliser 
				   pour cela on va creer une fonction de nettoyage qu'on va utiliser
				*/
				/* on recupere de manière brut les données */
				$email_Lue 			= $_POST['zoneEmail'];
				$Mdp_Lue 			= $_POST['zonePassword'];
				$emailAdmin = "root.lib@pro.fr";
				
				/* on aseptise les données récupérées avant de les utiliser pour 
				   lutter contre la faille XSS */
				$email_Lue  		= sanitizeString($email_Lue);
				$Mdp_Lue  			= sanitizeString($Mdp_Lue);
				
								
				// on se connecte au SGBD
				
				// paramètres de connexion
				$host 	= 'localhost';
				$user 	= 'root';   
				$passwd = '';
				$mabase = 'biblio2';
			
				//tentative de connexion au SGBD MySQL  
				if ($conn = mysqli_connect($host,$user,$passwd,$mabase))
				{
									
					// preparation de la requete de récuparation des données de l'utilisateur
					$req  = "SELECT * FROM connexion WHERE email = '$email_Lue'";
					              
					// on tente d'envoyer la requête
					if($result = mysqli_query($conn, $req))
					{
						/* On teste pour voir si la requete à renvoyé des éléments.
						   Si c'est le cas on compare le mot de passe crypté avec celui
						   fournit par l'utilisateur.
						   Si tout est OK on cree une variable de session pour mémoriser
						   de page en page l'émail de l'utilisateur
						*/
						
						// on teste que le nombre de ligne renvoyé par la requete est > 0
						$nbLignes = mysqli_num_rows($result);
						if ($nbLignes==1)
						{
							// extraction de la ligne envoyée par la requête
							$row =mysqli_fetch_assoc($result);
							
							// recuperation du mot de passe dans la ligne
							$Mdp_crypt_BD= $row['mdp'];
							
											
							// on compare le mot passe envoyé à celui enregistré(crypté)
							if (password_verify($Mdp_Lue, $Mdp_crypt_BD)) 
							{
								// enregistrement dans une variable de session de l'email de l'utilisateur
								if ($email_Lue == $emailAdmin)
								{ 
									session_start();
									$_SESSION['emailUser'] = $email_Lue;
									echo '<h1>  Vous êtes connecté vous pouvez accéder a l\'accueil !</h1><br>';
									echo '<a class="font" href="accueilAdmin.html">--> Accueil <--</a>'; 
								} else {
								// demarrer le mecanisme des sessions
								session_start();
								// enregistrer l'émail dans la variable de session "emailUser"
								$_SESSION['emailUser'] = $email_Lue ; 
								echo '<h1>  Vous êtes connecté vous pouvez accéder a l\'accueil !</h1><br>';
								echo '<a class="font" href="accueil.html">--> Accueil <--</a>';
								}
							} 					
							else 
							{
								echo 'paramètres de connexion non valides';
							}
							
						}	
						else
						{
							echo "paramètres de connexion non valides ";
						}
					}
					else
					{
						// erreur de requête
						die ("erreur de requête");
					}
				}	
				else
				{
					// echec de la connexion à la BD 
					die("problème de connexion au serveur de base de données");	
				}
			}
			else
			{
			
				
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