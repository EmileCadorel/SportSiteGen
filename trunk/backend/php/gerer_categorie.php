<?php

require("Categorie.php"); 

if ( isset($_GET['action'] ) ) {
    if( $_GET['action'] == "ajouter" ) {
	if( isset($_POST['nom']) && isset($_POST['description']))  {
	    if ( Categorie::s_insert($bdd, $_POST['nom'], $_POST['description'])) {
		header("Location:index.php?page=equipe");
	    } else {
		$msg = "Erreur lors de l'ajout de la categorie.";
		header("Location: index.php?page=err&msg=".$msg);
	    }
	} else {
	    $msg = "Erreur, toutes les donnees ne sont pas presentes.";
	    header("Location: index.php?page=err&msg=".$msg);
	}
    } else if ( $_GET['action'] == "edit" && isset($_GET['id'])) {
	if ( isset($_POST['nom']) && isset($_POST['description']) ) {
	    if( Categorie::s_delete_byId($bdd, $_GET['id'] )) {
		if ( Categorie::s_insert($bdd, $_POST['nom'], $_POST['description'] )) {
		    header("Location:index.php?page=equipe");
		} else {
		    $msg = "Erreur lors de la modification de la categorie.";
		    header("Location:index.php?page=err&msg=".$msg);
		}
	    } else {
		$msg = "Erreur lors de la modification de la categorie.(del)";
		header("Location:index.php?page=err&msg=".$msg);
	    }
	} else {
	    $msg = "Erreur toutes les donnees ne sont pas presentes.";
	    header("Location:index.php?page=err&msg=".$msg);
	}
    } else if ( $_GET['action'] == "supprimer" && isset($_GET['id'])) {
	if (Categorie::s_delete_byId($bdd, $_GET['id']) ) {
	    header("Location: index.php?page=equipe");
	} else {
	    $msg = "Erreur lors de la suppression de la categorie.(del)";
	    header("Location:index.php?page=err&msg=".$msg);
	}
    }
 } else {
    if ( $_GET['page'] == "new_categorie" ) {
	include ("html/newcategorie.html");
    } else if ( $_GET['page'] == "edit_categorie") {
	include("html/editcategorie.html");
    } else {
	include("html/equipe.html");
    }
 }
    ?>