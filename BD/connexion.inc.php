<?php
define("SERVEUR","localhost");	//  www-ens.iro.umontreal.ca
define("USAGER","root");	// houimlis_web ou houimlis
define("PASSE","");	//lisp102H
define("BD","houimlis_bdfilms");

if(!$connexion=mysqli_connect(SERVEUR,USAGER,PASSE)){
	echo "Probleme de connexion au serveur de bd";
	exit;
}
mysqli_select_db($connexion, BD);

?>