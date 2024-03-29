<?php
session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php"; 

	//faire avec post ?????
	$qs = $_GET;
		
	if ($action = valider("action"))
	{
		ob_start ();
		echo "Action = '$action' <br />";
		// ATTENTION : le codage des caractères peut poser PB si on utilise des actions comportant des accents... 
		// A EVITER si on ne maitrise pas ce type de problématiques

		/* TODO: A REVOIR !!
		// Dans tous les cas, il faut etre logue... 
		// Sauf si on veut se connecter (action == Connexion)

		if ($action != "Connexion") 
			securiser("login");
		*/

		// Un paramètre action a été soumis, on fait le boulot...
		switch($action)
		{
			// Connexion //////////////////////////////////////////////////
			case 'SE CONNECTER' :
				$qs = array("view" => "accueil");
				// On verifie la presence des champs login et passe
				if ($login = valider("login"))
				if ($passe = valider("passe"))
				{
					// On verifie l'utilisateur, 
					// et on crée des variables de session si tout est OK
					// Cf. maLibSecurisation
					if (verifUser($login,$passe)) 
					{
						// tout s'est bien passé, doit-on se souvenir de la personne ? 
						if (valider("remember")) 
						{
							setcookie("login",$login , time()+60*60*24*30);
							setcookie("passe",$password, time()+60*60*24*30);
							setcookie("remember",true, time()+60*60*24*30);
						} 
						else {
							setcookie("login","", time()-3600);
							setcookie("passe","", time()-3600);
							setcookie("remember",false, time()-3600);
						}
					}
				} 
			// On affiche deconnexion?>
		
<?php
			break;

		case 'Logout':
			// traitement métier
			session_destroy();
			$qs = array("msg" => "Déconnexion réussie", "view" => "accueil");
			break;

		case 'INSCRIVEZ-VOUS EN CLIQUANT ICI':
			//change la vue pour pouvoir créer son compte
			$qs = array("msg" => "", "view" => "creer_compte");
			break;

		case "S INSCRIRE":
			$pseudo = valider("pseudo");
			$passe = valider("passe");
			$passe2 = valider("passe2");
			$email = valider("mail");

			// Valider l'email
			if (!validateMail($email)) {
				$qs = array("msg" => " adresse email non valide", "view" => "creer_compte");
				break;
			}

			//verifier si les mots de passes correspondent 
			if ($passe != $passe2) {
				$qs = array("msg" => " Les mots de passe ne correspondent pas", "view" => "creer_compte");
				break;
			}
			//verifier si le format de l'email est valide
			if (veriflogin($pseudo)) {
				$qs = array("msg" => " Ce login est déjà utilisé", "view" => "creer_compte");
				break;
			}
			//verifier si l'utilisateur a bien entré un pseudo, mdp et mail
			if (isset($pseudo) || isset($passe) || isset($email)) {
				$qs = array("msg" => " Veuillez entrer un pseudo", "view" => "creer_compte");
				break;
			} 
			//si tout est bon, on créait le compte 
			else 
			{
				creer_compte($pseudo, $passe, $email);
				$qs = array("view" => "accueil");
				break;
			}
			
		

				


		case "Mon compte":
			$qs = array("view" => "mon_compte");
			break;


		case "ValiderModificationCompte":
			$qs = array("view" => "accueil");
			$qs["msg"] = "Compte modifié avec succès";
			$qs["msgType"] = "success";
			$qs["msgTitle"] = "Succès";
			$qs["msgIcon"] = "check";

			$login = valider("login");
			$passe = valider("passe");
			$passe2 = valider("passe2");
			$nom = valider("nom");
			break;


		
				case "Modifier le pseudo":
					$sessionIdPers = $_SESSION["idUser"];
					$pseudo = valider("pseudo");
					if (veriflogin($pseudo)){
						$qs = array("msg" => " Ce login est déjà utilisé", "view" => "mon_compte");
						break;
					}
					else{
					modifierPseudo($sessionIdPers, $pseudo);
					$qs = array("msg" => " Pseudo modifié avec succès", "view" => "mon_compte");
					break;
					}
		
				case "Modifier le mail":
					$sessionIdPers = $_SESSION["idUser"];
					$mail = valider("mail");
					if (verifmail($mail) || (!validateMail($mail))){
						$qs = array("msg" => " Ce mail est déjà utilisé", "view" => "mon_compte");
						break;
					}
					else{
					modifierMail($sessionIdPers, $mail);
					$qs = array("msg" => " Mail modifié avec succès", "view" => "mon_compte");
					break;
					}
		
				case "Modifier le mot de passe":
					$sessionIdPers = $_SESSION["idUser"];
					$passe = valider("passe");
					$passe2 = valider("passe2");
					if ($passe != $passe2) {
					$qs = array("msg" => " Les mots de passe ne correspondent pas", "view" => "modif-mdp");
						break;
					}
					modifierPasse($sessionIdPers, $passe);
					$qs = array("msg" => " Mot de passe modifié avec succès", "view" => "mon_compte");
					break;

			
	}

}

// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
// On redirige vers la page index avec les bons arguments

//header("Location:" . $urlBase . $qs);
rediriger($urlBase, $qs);

// On écrit seulement après cette entête
ob_end_flush();

?>