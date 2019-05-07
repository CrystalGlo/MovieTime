<?php 
include 'header.php';

require_once("../BD/connexion.inc.php");
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
$requete="INSERT INTO tbl_membres VALUES(0,'$codeUsager','$email','$pass','$poste')";
$stmt = $connexion->prepare($requete); //requette préparée
$stmt->execute();

echo "Membre ".$email." vous etes maintenant enregistre";

include 'footer.php'; 
?>  