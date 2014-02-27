<?php

/**
 * Date: 15/01/14
 *
 * Script d'administration du cms
 *
 */

session_start();
require("../mysql_connect.php");
require("php/fonctions.php");

/* Si l'admin n'est pas connecté, on l'envoie sur la page de login */
if(!isset($_SESSION['admin_connected']) || !$_SESSION['admin_connected']) {
	if(isset($_GET['page'])) {
        if($_GET['page'] == "err") {
            include("php/err.php");
        }
    }
    $_SESSION['admin_connected'] = false;
	include("html/authen.html");
} else { /* Sinon on vérifie si il a demandé une page en particulier */
	if(isset($_GET['page']) || isset($_POST['page'])) {
		$page = $_REQUEST['page'];

		switch($page) {
/*ARTICLE*/
			case 'article':
				include("php/article.php");
				break;
			case 'new_article':
				include("html/newarticle.html");
				break;
            case 'edit_article':
                include("html/editarticle.html");
                break;
/*MEMBRE*/
            case 'membre':
                include("html/membre.html");
                break;
            case 'new_membre':
                include("html/newmembre.html");
                break;
            case 'edit_membre':
                include("html/editmembre.html");
                break;
/*EQUIPE*/
            case 'equipe':
                include("html/equipe.html");
                break;
            case 'new_equipe':
                include("html/newequipe.html");
                break;
            case 'edit_equipe':
                include("html/editequipe.html");
                break;
/*AUTRE*/
            case 'logout':
                include("php/logout.php");
                break;
            case 'err':
                include("php/err.php");
            case 'info':
                include("php/info.php");
                break;
            case 'configuration':
                include("php/config.php");
                break;
			default:
				include("html/accueil.html");
		}
	} else {
		include("html/accueil.html");
	}
}
?>