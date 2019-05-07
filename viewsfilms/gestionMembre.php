<?php

session_start();
include 'header.php';
require_once("../BD/connexion.inc.php");

function enregistrer(){
	global $connexion;
	$codeUsager=$_POST['codeUsager'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$poste = "";
	if($codeUsager == "admin") {
		$poste = "A";
	}
	else {
		$poste = "M";
	}
	$requete="INSERT INTO tbl_membres VALUES(0,'$codeUsager','$email','$poste')";
	mysqli_query($connexion,$requete) or die("Echec en insertion");
	$req="INSERT INTO tbl_connexion VALUES('$codeUsager','$email','$pass')";
	mysqli_query($connexion,$req) or die("Echec en insertion connexion");
	$_SESSION['usager_poste']=$poste;
	echo 'Le membre '.$email.' est bien enregistre, veuillez vous connecter';
}

function connecter(){
	global $connexion;
	$email=$_POST['emailC'];
	$pass=$_POST['passC'];
	$requete="SELECT * FROM tbl_connexion WHERE email='$email' AND pass='$pass'";
	$res = mysqli_query($connexion,$requete) or die("Echec de la requête connexion");
	$req="SELECT * FROM tbl_membres WHERE email='$email'";
	$res2 = mysqli_query($connexion,$req) or die("Echec de la requête connexion");
	if (mysqli_num_rows($res2) > 0){
		$row = mysqli_fetch_assoc($res2);
		$poste=$row["poste"];
		$_SESSION['usager_poste']=$poste;
		$_SESSION['id_membre']=$row['idm'];
		echo '<script type="text/javascript">',
			 'location.replace("listerFilms.php");;',
			 '</script>';
	}
    else {
        echo "Probleme de connexion pour $email";
		header('Location: listerFilms.php');
		exit;
	}
}

$action=$_POST['action'];
switch($action){
	case "enregistrer" :
		enregistrer();
		break;
	case "connecter" :
		connecter();
		break;
}

mysqli_close($connexion);

include 'footer.php';

?>