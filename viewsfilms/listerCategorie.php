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
	} elseif($_SESSION['usager_poste']=="M") {
		echo '<script type="text/javascript">',
			 'headerUsager();',
			 '</script>';
	}
}

function listerCategorie(){
	global $connexion;	
    $categorie = $_GET['categorie'];
	$req="SELECT * FROM tbl_films WHERE categorie='".$categorie."' ORDER BY num";
	$res = mysqli_query($connexion,$req) or die("Echec de la requête lister");
	echo "<div class=\"card-deck border-primary mb-3\" style=\"display:inline-block;float:left;text-align:center;margin:10px;\">";
	while ($ligne = mysqli_fetch_array($res))
	{
		$num=$ligne['num'];
		$pochette=$ligne['pochette'];
		$titre=$ligne['titre'];
		$realisateur=$ligne['realisateur'];
		$categorie=$ligne['categorie'];
		$prix=$ligne['prix'];
		echo "<div class=\"card border-primary mb-3\" style=\"float:left;width:13rem;margin:1em;\">\n";
		echo "<span class=\"badge badge-primary\" id=\"numF\" name=\"numF\" style=\"width:30px;\" value=\"$num\"></span>\n";
		echo "<img class=\"card-img-top\" src=\"$pochette\" alt=\"Card image top\" style=\"width:12rem;height:20rem;margin-left:0.5rem;\">\n";
		echo "<div class=\"card-body\"><h6 class=\"card-title\" style=\"font-weight:bold;\">$titre</h6>";
		echo "<p class=\"card-subtitle\">$realisateur</p>";
		echo "<p class=\"card-subtitle\">$categorie</p>";
		echo "<p class=\"card-subtitle\" style=\"font-style:italic;\"> $ $prix</p><hr>";
		
		echo "<form id=\"ajoutPanierForm\" name=\"ajoutPanierForm\" method=\"post\" action=\"gestionPanier.php\" ENCTYPE=\"multipart/form-data\" 
				style=\"display:inline;float:center;text-align:center;height:auto:\">";
		echo "<select class=\"form-control form-control-sm\" id=\"nbrAjout\" name=\"nbrAjout\" style=\"width:auto;height:auto;float:left;\">";
		echo "<span id=\"numFilm\" name=\"numFilm\" style=\"visibility:hidden;\" value=\"$num\"></span>";
		for($i=0;$i<=10;$i++){ 
			echo "<option value=".$i.">".$i."</option>";
		} 
		echo "</select>";
		echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"ajouterPanier\"/>";
		echo "<button type=\"submit\" class=\"btn btn-success btn-sm\" style=\"float:right;\"><i class=\"fas fa-cart-plus\"></i> Ajouter</button>";
		echo "</form></div></div>";
	}	
	echo "<div class=\"after-box\" style=\"clear:left;\">";
	/* Libération du résultat */
	mysqli_free_result($res);
	
}

listerCategorie();
mysqli_close($connexion);
include 'footer.php';

?>