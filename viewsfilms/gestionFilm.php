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

function ajouter(){
	global $connexion;
	$titre=$_POST['titre'];
	$realisateur=$_POST['realisateur'];
	$categorie=$_POST['categorie'];
	$duree=$_POST['duree'];
	$prix=$_POST['prix'];
	// upload de la photo
	$repo="../images/";
	$tmp = $_FILES['photo']['tmp_name'];
	$fichier= $_FILES['photo']['name'];
	$extension=strrchr($fichier,'.');
	@move_uploaded_file($tmp,$repo.$titre.$extension);
	// Enlever le fichier temporaire chargé
	@unlink($tmp); //effacer le fichier temporaire
	$photo='../images/'.$titre.$extension;
	$req="INSERT INTO tbl_films VALUES(0,'$titre','$realisateur','$categorie','$duree','$prix','$photo')";
	mysqli_query($connexion, $req) or die("Echec en insertion");
	//header('Location: listerFilms.php');
	echo '<script type="text/javascript">',
			 'location.replace("listerFilms.php");;',
			 '</script>';
}

function trouver(){
	global $connexion;
	$noFilm=$_POST['noFilm'];
	$req="SELECT * FROM tbl_films WHERE num='$noFilm'";
	$res = mysqli_query($connexion,$req) or die("Echec de la requête trouver");
	if (mysqli_num_rows($res) > 0){
		$ligne = mysqli_fetch_assoc($res);
		envoyerForm($ligne);
	} else {
        echo "Impossible de trouver le film no : $noFilm";
	}
}

function envoyerForm($res){
	$noFilm=$res['num'];
	$titre=$res['titre'];
	$realisateur=$res['realisateur'];
	$categorie=$res['categorie'];
	$duree=$res['duree'];
	$prix=$res['prix'];
	$photo=$res['pochette'];
	echo "<div class=\"row\" style=\"position: relative;padding-top:30px; padding-left:40%;\">
		<div class=\"col-xs-12 col-sm-12 col-md-4 well well-sm\">\n";
	echo "<legend style=\"text-align:center;\"><i class=\"fa fa-edit\"></i> Modifier un film</legend><br>\n";
	echo "<form id=\"formMAJ\" name=\"formMAJ\" action=\"gestionFilm.php\" method=\"POST\" ENCTYPE=\"multipart/form-data\">\n";
	echo "<span>No du film : </span><input class=\"form-control\" id=\"noFilmMAJ\" name=\"noFilmMAJ\" value=\"$noFilm\" type=\"number\" /><br>\n";
	echo "Titre du film : <input class=\"form-control\" id=\"titreMAJ\" name=\"titreMAJ\" value=\"$titre\" type=\"text\" /><br>\n";
	echo "Realisateur : <input class=\"form-control\" id=\"realisateurMAJ\" name=\"realisateurMAJ\" value=\"$realisateur\" type=\"text\" /><br>\n";
	echo "Categorie : <div class=\"form-group\">
		  <label for=\"categ\">Choisir la categorie:</label>
		  <select class=\"form-control\" id=\"categorieMAJ\" name=\"categorieMAJ\">
			<option value=\"Drame\" selected=(\"$categorie\"==\"Drame\")>Drame</option>
			<option value=\"Comedie\" selected=(\"$categorie\"==\"Comedie\")>Comedie</option>
			<option value=\"Thriller\" selected=(\"$categorie\"==\"Thriller\")>Thriller</option>
			<option value=\"Action\" selected=(\"$categorie\"==\"Action\")>Action</option>
			<option value=\"Science Fiction\" selected=(\"$categorie\"==\"Science Fiction\")>Science Fiction</option>
			<option value=\"Romantique\" selected=(\"$categorie\"==\"Romantique\")>Romantique</option>
		  </select>
		</div>
		<br />\n";
	echo "Duree : <input class=\"form-control\" id=\"dureeMAJ\" name=\"dureeMAJ\" value=\"$duree\" type=\"number\"/><br>\n";
	echo "Prix : <input class=\"form-control\" id=\"prixMAJ\" name=\"prixMAJ\" value=\"$prix\" type=\"number\"/><br>\n";
	echo "Photo : <input class=\"form-control\" id=\"photo\" name=\"photo\" type=\"file\"/><br>\n";
	echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"modifier\"/>\n"; 
	echo "<input type=\"hidden\" id=\"option\" name=\"option\" value=\"miseAjour\"/>\n";
	echo "<input type=\"submit\" value=\"Enregistrer\" class=\"btn btn-md btn-primary btn-block\"
			style=\"width:60%;text-align:center;display:block;margin:0 auto;\"/> \n"; 
	echo "<br><br></form></div></div>\n";
	
}

function mettreAjour(){
	global $connexion;
	$noFilm=$_POST['noFilmMAJ'];
	echo "no du film = ".$noFilm;
	$titre=$_POST['titreMAJ'];
	$realisateur=$_POST['realisateurMAJ'];
	$categorie=$_POST['categorieMAJ'];
	$duree=$_POST['dureeMAJ'];
	$prix=$_POST['prixMAJ'];
	//Upload de la photo
	$rep="../images/";
	$upPhoto=false;
	if (isset($_FILES['photo']['tmp_name'])){
	   //Récuperer ancienne photo et l'effacer
		$req="SELECT * FROM tbl_films WHERE num='$noFilm'"; //recherche du film
		$liste=mysqli_query($connexion,$req) or die("Echec modifier");
		$ligne = mysqli_fetch_array($liste);
		//$ancPhoto=$ligne['pochette'];
		if (file_exists($ligne['pochette']))
			@unlink($ligne['pochette']); //effacer photo
		//Upload de la nouvelle photo
		$tmp = $_FILES['photo']['tmp_name'];
		$fichier= $_FILES['photo']['name'];
		$extension=strrchr($fichier,'.');
		@move_uploaded_file($tmp,$rep.$titre.$extension);
		// Enlever le fichier temporaire chargé
		@unlink($tmp); //effacer le fichier temporaire
		$photo='../images/'.$titre.$extension;
		$upPhoto=true;		
	}
	
	if ($upPhoto==true){
		$req="UPDATE tbl_films SET titre='$titre',realisateur='$realisateur',categorie='$categorie',duree='$duree',prix='$prix',pochette='$photo' WHERE num='$noFilm'";		
	}
	else{
		$req="UPDATE tbl_films SET titre='$titre',realisateur='$realisateur',categorie='$categorie',duree='$duree',prix='$prix' WHERE num='$noFilm'";		
	}
	mysqli_query($connexion,$req) or die("Echec de la requête MAJ");
	echo '<script type="text/javascript">',
			 'location.replace("listerFilms.php");;',
			 '</script>';
}

function supprimer(){
	global $connexion;
	$noFilmS=$_POST['noFilmS'];
	$req= "DELETE FROM tbl_films WHERE num='$noFilmS'";
	mysqli_query($connexion,$req) or die("Echec de la requête Supprimer");
	echo '<script type="text/javascript">',
			 'location.replace("listerFilms.php");',
			 '</script>';
}


$action=$_POST['action'];
switch($action){
	case "ajouter" :
		ajouter();
		break;
	case "modifier" :
		$option=$_POST['option'];
		if ($option=="trouver")
		  trouver();
		else // option == miseAjour
		   mettreAjour();		
	break;
	case "supprimer" :
		supprimer();
		break;
}


mysqli_close($connexion);

include 'footer.php';
?>