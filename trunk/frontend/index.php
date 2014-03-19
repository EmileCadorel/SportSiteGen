<?php

session_start();

require_once("../mysql_connect.php"); //la variable $bdd vient d'ici
require_once("fonctions.php");
require_once("php/Init.php");
require_once("php/Header.php");
require_once("php/Content.class.php");
require_once("../tpl/libs/Smarty.class.php");
require_once("php/Aside.php");
$smarty  = new Smarty();

/* On initialise le cms en nous connectant à la BDD, on récupérant le template à utiliser, ainsi que les fichiers */
$init_cms = new Init($bdd);
$template = $init_cms->get_template();
$name     = $init_cms->get_name();

$url_style = "templates/".$template."/css/";
$styles = array($url_style."design.css", $url_style."header.css", $url_style."content.css", $url_style."aside.css");

/* On récupère le header Dont le menu */
$head = new Header($bdd);
$header = $head->get_content();
$connect = $head->get_content_connexion();

//On récupère le Aside 
$as = new Aside($bdd);
$asidenews = $as->get_content_news();
$asidecal  = $as->get_content_calendrier();


/*On récupère le footer
  $fo = new Footer($bdd);
  $footer = $fo->get_content();
*/

// On récupère le corps du texte suivant ce qui a été demandé
$content = new Content($bdd, $template, $smarty);
if(isset($_GET['page']) || isset($_POST['page'])) {
    $page = $_REQUEST['page'];
    $param = get_params($_GET, $_POST); /* On récupère tous les params sauf la page */
    $content_html = $content->get_html($page, $param);

    if ($page == "deconnexion"){
	unset($_SESSION);
	session_destroy();
	header("Location:  index.php");
    }
} else {
    $content_html = $content->get_html("accueil");
}


$smarty->assign("Style", $styles);
$smarty->assign("Header", $header);
$smarty->assign("Name", $name);
$smarty->assign("AsideNews", $asidenews);
$smarty->assign("AsideCal", $asidecal);
$smarty->assign("Content", $content_html);
$smarty->assign("Connect", $connect);
//$smarty->assign("Footer", $footer);

$smarty->display("templates/".$template."/index.html");

?>