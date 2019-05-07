<?php 
session_start();
require_once("../BD/connexion.inc.php");

include 'header.php'; 
echo '<script type="text/javascript">',
		 'headerPublic();',
		 '</script>';
if(isset($_SESSION['usager_poste'])){
	if($_SESSION['usager_poste']=="A"){
		echo '<script type="text/javascript">',
			 'headerAdmin();',
			 '</script>';
		listerFilms();
	} elseif($_SESSION['usager_poste']=="M") {
		echo '<script type="text/javascript">',
			 'headerUsager();',
			 '</script>';
		listerFilmsMembre();
	}
} else {
	listerFilms();
}


function listerFilms(){
	global $connexion;
	$req="SELECT * FROM tbl_films ORDER BY num";
	$res = mysqli_query($connexion,$req) or die("Echec de la requête lister");
	echo "<div class=\"card-deck mb-3\" style=\"display:inline-block;float:left;text-align:center;margin:10px;\">";
	while ($ligne = mysqli_fetch_array($res))
	{ 
		$num=$ligne['num'];
		$pochette=$ligne['pochette'];
		$titre=$ligne['titre'];
		$realisateur=$ligne['realisateur'];
		$categorie=$ligne['categorie'];
		$prix=$ligne['prix'];
		$bande_annonce=$ligne['bande_annonce'];
		echo "<div class=\"card border-warning mb-3\" style=\"float:left;width:13rem;margin:1em;\">\n";
		echo "<span class=\"badge badge-warning\" id=\"numF\" name=\"numF\" style=\"width:30px;\" value=\"$num\">$num</span>\n";
		echo "<img class=\"card-img-top\" src=\"$pochette\" onClick=\"afficherVideo()\" alt=\"Card image top\" style=\"width:12rem;height:20rem;margin-left:0.5rem;\">\n";		
		echo "<div class=\"card-body\"><h6 class=\"card-title\" style=\"font-weight:bold;\">$titre</h6>";
		echo "<p class=\"card-subtitle\">$realisateur</p>";
		echo "<p class=\"card-subtitle\">$categorie</p>";
		echo "<p class=\"card-subtitle\" style=\"font-style:italic;\"> $ $prix</p>";	
		echo "<p class=\"card-subtitle\" id=\"video\" name=\"video\" value=\"$bande_annonce\">$bande_annonce</p>";
		
		echo "<iframe align=\"center\" id=\"video_iframe\" src=\"$bande_annonce\" style=\"visibility:hidden;\" frameborder=\"0\" allowfullscreen></iframe></div></div>";	
	}	
	echo "<div class=\"after-box\" style=\"clear:left;\">";
	/* Libération du résultat */
	mysqli_free_result($res);
}

function listerFilmsMembre() {
	global $connexion;
	$req="SELECT * FROM tbl_films ORDER BY num";
	$res = mysqli_query($connexion,$req) or die("Echec de la requête lister");
	echo "<div class=\"card-deck mb-3\" style=\"display:inline-block;float:left;text-align:center;margin:10px;\">";
	while ($ligne = mysqli_fetch_array($res))
	{ 
		$num=$ligne['num'];
		$pochette=$ligne['pochette'];
		$titre=$ligne['titre'];
		$realisateur=$ligne['realisateur'];
		$categorie=$ligne['categorie'];
		$prix=$ligne['prix'];
		echo "<div class=\"card border-warning mb-3\" style=\"float:left;width:13rem;margin:1em;\">\n";
		echo "<span class=\"badge badge-warning\" id=\"numF\" name=\"numF\" style=\"width:30px;\" value=\"$num\">$num</span>\n";
		echo "<img class=\"card-img-top\" src=\"$pochette\" alt=\"Card image top\" style=\"width:12rem;height:20rem;margin-left:0.5rem;\">\n";	
		echo "<div class=\"card-body\"><h6 class=\"card-title\" style=\"font-weight:bold;\">$titre</h6>";
		echo "<p class=\"card-subtitle\">$realisateur</p>";
		echo "<p class=\"card-subtitle\">$categorie</p>";
		echo "<p class=\"card-subtitle\" style=\"font-style:italic;\"> $ $prix</p><hr>";			
		echo "<form id=\"ajoutPanierForm\" name=\"ajoutPanierForm\" method=\"post\" action=\"\" ENCTYPE=\"multipart/form-data\" 
				style=\"display:inline;float:center;text-align:center;height:auto;\">";
		echo "<select class=\"form-control form-control-sm\" id=\"nbrAjout\" name=\"nbrAjout\" style=\"width:auto;height:auto;float:left;\">";
		for($i=0;$i<=10;$i++){ 
			echo "<option value=".$i.">".$i."</option>";
		} 
		echo "</select>";
		echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"ajouterPanier\"/>";
		echo "<button type=\"submit\" class=\"btn btn-success btn-sm\" style=\"float:right;\"><i class=\"fas fa-cart-plus\"></i> Ajouter</button>";
		echo "<input type=\"hidden\" id=\"numFilm\" name=\"numFilm\" value=\"$num\">";
		echo "</form></div></div>";
	}	
	echo "<div class=\"after-box\" style=\"clear:left;\">";
	
	/* Libération du résultat */
	mysqli_free_result($res);
}

if (isset($_POST['action'])) {
	$action=$_POST['action'];
	if($action=="ajouterPanier") {
		ajouterPanier();
	}
}

function ajouterPanier(){
	global $connexion;
	$idmembre=$_SESSION['id_membre'];
	$numFilm=$_POST['numFilm'];
	$nbrAjout=$_POST['nbrAjout'];
	$req="INSERT INTO tbl_location VALUES('$idmembre','$numFilm','$nbrAjout')";
	mysqli_query($connexion, $req) or die(mysqli_error);
}

mysqli_close($connexion); 

include 'footer.php';

?>