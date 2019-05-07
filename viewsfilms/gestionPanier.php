<?php 
session_start();
require_once("../BD/connexion.inc.php");

include 'header.php'; 
if($_SESSION['usager_poste']=="A"){
	echo '<script type="text/javascript">',
			 'headerAdmin();',
			 '</script>';
} elseif($_SESSION['usager_poste']=="M") {
	echo '<script type="text/javascript">',
			 'headerUsager();',
			 '</script>';
} else{
	echo '<script type="text/javascript">',
			 'headerPublic();',
			 '</script>';
} 

function listerAchat(){
	global $connexion;
	$sous_total=0;
	$idmembre=$_SESSION['id_membre'];
	$req= "SELECT * FROM tbl_films, tbl_location WHERE tbl_location.idm = $idmembre AND tbl_films.num = tbl_location.num_film ORDER BY tbl_location.num_film";
	$res = mysqli_query($connexion,$req) or die("Echec de la requête lister achat");
	echo "<form id=\"listeAchatForm\" name=\"listeAchatForm\" method=\"POST\" action=\"\" style=\"margin-left:25px;margin-right:25px;\" ENCTYPE=\"multipart/form-data\">";
	echo "<br><h4><i class=\"fas fa-cart-arrow-down\"></i> Votre panier";
	echo "<button type=\"submit\" class=\"btn btn-danger btn-sm\" id=\"st_btn\" name=\"st_btn\" style=\"float:right;\"><i class=\"fas fa-shopping-cart\"></i> Vider le panier</button></h4>";
	echo "<br><div class=\"table-responsive\"><table class=\"table\"><thead class=\"thead-light\">";
	echo "<tr><th scope=\"col\">Pochette</th><th scope=\"col\">Titre</th><th scope=\"col\">Quantite</th><th scope=\"col\">Prix</th><th scope=\"col\"></th></tr></thead><tbody>";
	while ($ligne = mysqli_fetch_array($res))
	{
		$num_film=$ligne['num_film'];
		$pochette=$ligne['pochette'];
		$titre=$ligne['titre'];
		$nbr_achat=$ligne['nbr_achat'];
		$prix=$ligne['prix'];
		$sous_total+=$prix * $nbr_achat;
		echo "<tr>
		  <td scope=\"row\"><img class=\"card-img-top\" src=\"$pochette\" style=\"height:6rem;width:4rem;\"></td>
		  <td>$titre</td>
		  <td>$nbr_achat</td>
		  <td>$prix</td>";
		echo "<td><button type=\"submit\" class=\"btn btn-danger btn-sm\" id=\"s_btn\" name=\"s_btn\" value=\"$num_film\"> Supprimer</button></td></tr>";
	}
	$tvq=round(($sous_total * 9.975 / 100), 2);
	$tps=round(($sous_total * 5 / 100), 2);
	$total=round($sous_total + $tvq + $tps, 2);
	echo "</tbody></table></div>";
	echo "<div style=\"float:right;margin-bottom:40px;\"><div style=\"font-weight:bold;\">Sous-total : <span style=\"font-weight:normal;font-style:italic;\">$$sous_total</span></div>";
	echo "<div style=\"font-weight:bold;\">TVQ : <span style=\"font-weight:normal;font-style:italic;\">$$tvq</span></div>";
	echo "<div style=\"font-weight:bold;\">TPS : <span style=\"font-weight:normal;font-style:italic;\">$$tps</span></div>";
	echo "<div style=\"font-weight:bold;\">Total : <span style=\"font-weight:normal;font-style:italic;\">$$total</span></div></div>";
	echo "<div><input type=\"hidden\" id=\"action\" name=\"action\" value=\"afficherFormPayer\"/>";
	echo "<button type=\"submit\" class=\"btn btn-success btn-md\" id=\"btn_payer\"><i class=\"far fa-credit-card\"></i> Payer</button></div>";
	echo "</form>";
	/* Libération du résultat */
	mysqli_free_result($res);
}

listerAchat();

if(isset($_POST['st_btn'])) {
	supprimerTout();
}	
else if(isset($_POST['s_btn'])) {
	supprimer();
}	

if(isset($_POST['action'])) {
	$action=$_POST['action'];
	switch($action){
		case "afficherFormPayer" :
			afficherFormPayer();
			break;
		case "validerPaiement" :
			validerPaiement();
			break;
	}
}

function supprimer() {
	global $connexion;
	$idmembre=$_SESSION['id_membre'];
	$film_select=$_POST['s_btn'];
	$req= "DELETE FROM tbl_location WHERE idm = '$idmembre' AND num_film = '$film_select'";
	mysqli_query($connexion,$req) or die("Echec de la requête Supprimer");
	echo '<script type="text/javascript">',
			 'location.replace("gestionPanier.php");',
			 '</script>';
 }

function supprimerTout() {
	global $connexion;
	$req= "DELETE FROM tbl_location";
	mysqli_query($connexion,$req) or die("Echec de la requête tout supprimer");
	echo '<script type="text/javascript">',
			 'location.replace("gestionPanier.php");',
			 '</script>';
}

function afficherFormPayer() { 	
	echo "<br><br><br><form action=\"gestionPanier.php\" method=\"post\">";
	echo "<div class=\"row\"><div class=\"col-md-6\"><div class=\"form-group\"></div></div>";
	echo "<div class=\"display-td\"><img class=\"img-responsive pull-right\" src=\"http://i76.imgup.net/accepted_c22e0.png\"></div>";
	echo "<div class=\"col-md-6\"><div class=\"form-group\"></div></div></div>";
	echo "<div class=\"row\"><div class=\"col-md-4\"><div class=\"form-group\"></div></div>";
	echo "<div class=\"col-md-4\"><div class=\"form-group\"><label for=\"cardNumber\">No de la carte</label>";
	echo "<div class=\"input-group\"><input type=\"tel\" class=\"form-control\" name=\"cardNumber\" placeholder=\"No de carte valide\" required/></div></div></div>";
	echo "<div class=\"col-md-4\"><div class=\"form-group\"></div></div></div>";
	echo "<div class=\"row\"><div class=\"col-md-4\"><div class=\"form-group\"></div></div>";
	echo "<div class=\"col-md-3\"><div class=\"form-group\"><label for=\"cardExpiry\"><span class=\"hidden-xs\">Date d'expiration</span></label>";
	echo "<input type=\"tel\" class=\"form-control\" name=\"cardExpiry\" placeholder=\"MM / YY\" required /></div></div>";
	echo "<div class=\"col-md-1\"><div class=\"form-group\"><label for=\"cardCVC\">CV code</label>";
	echo "<input type=\"tel\" class=\"form-control\" name=\"cardCVC\" placeholder=\"CVC\" required /></div></div>";
	echo "<div class=\"col-md-4\"><div class=\"form-group\"></div></div></div>";
	echo "<div class=\"row\"><div class=\"col-md-5\"><div class=\"form-group\"></div></div>";
	echo "<div><input type=\"hidden\" id=\"action\" name=\"action\" class=\"col-md-2\" value=\"validerPaiement\"/>";
	echo "<button type=\"submit\" class=\"btn btn-success btn-md\">Valider paiement <i class=\"fas fa-dollar-sign\"></i></button></div>";
	
	echo "<div class=\"col-md-7\"><div class=\"form-group\"></div></div></div></form>";
}

function validerPaiement() {
	echo '<script type="text/javascript">',
		 'alert("Votre paiement a ete effectue avec succes!")',
		 '</script>';
	supprimerTout();
}

mysqli_close($connexion);

include 'footer.php'; 
?> 
