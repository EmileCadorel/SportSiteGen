<?php

require("php/Joueur.php");

if (isset($_GET['action']) ) {
    if ( $_GET['action'] == "ajouter") {
	if (isset($_POST['nom']) 
	    && isset($_POST['prenom'])
	    && isset($_POST['poste'])
	    && isset($_POST['photo']) 
	    && isset($_POST['desc'])) {
	    if ( Joueur::s_insert($bdd, $_GET['id_team'], $_POST['nom'], $_POST['photo'], $_POST['prenom'], $_POST['poste'], $_POST['desc'])) {
		    header("Location:index.php?page=edit_equipe&id=".$_GET['id_team']);
	    } else {
		$msg = "Erreur lors de l'ajout d'un joueur";
		header("Location:index.php?page=err&msg=".$msg);
	    }
	} else {
	    $msg = "Erreur il manque des informations";
	    header("Location:index.php?page=err&page_r=equipe&msg=".$msg);
	}	    
    } else if ( $_GET['action'] == "supprimer" ) {
	if ( Joueur::s_delete_byId($bdd, $_GET['id']) ) {
	    header("Location: index.php?page=edit_equipe&id=".$_GET['id_team']);
	} else {
	    $msg = "Erreur lors de la suppression du joueur";
	    header("Location: index.php?page=err&page_r=equipe&msg=".$msg);
	}
    } else if ( $_GET['action'] == "edit" ) {
	if ( Joueur::s_update($bdd, $_GET['id'], $_POST['nom'], $_POST['photo'], $_POST['prenom'], $_POST['poste'], $_POST['desc']) ) {
	    header("Location: index.php?page=edit_equipe&id=".$_GET['id_team']);
	} else {
	    echo "jhfdjhfk";
	    $msg = "Erreur lors de la mise a jour du joueur";
	    //    header("Location: index.php?page=err&page_r=equipe&msg=".$msg);
	}
    }
} else {
    if ( $_GET['page'] == "new_joueur" ) {
	include("html/newjoueur.html");
    } else if ($_GET['page'] == "edit_joueur") {
	include("html/editjoueur.html");
    } else {
	include("html/equipe.html");
    }
}


?>