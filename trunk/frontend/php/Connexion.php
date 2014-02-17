<?php

class Connexion {

    /*
     *  Si des données ont été envoyées (post), on vérifie si pseudo et mdp concordent
     *  \param bdd : représente la connexion à la bdd
     *  \return : true si la connexion s'est déroulée correctement sinon false
     */
	public function connect($bdd) {
		if(isset($_POST['pseudo']) && isset($_POST['password'])) {
			$pseudo = $_POST['pseudo'];
			$pass   = $_POST['password'];

			/* On cherche un utilisateur avec le pseudo demandé */
			$profil = new Profil($bdd);
			$user = $profil->search_byName($pseudo);

			/* On vérifie que le mot de passe entré est le même que celui associé au pseudo dans la bdd */ 
			if($user) {
				if(md5($pass) == $user['Mdp']) {
					$_SESSION['connected'] = true;
					$_SESSION['user'] = $user; //on garde en mémoire le résultat de la requete, cad les info du user
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}

?>