<?php 
include 'header.php'; 
?> 
 <div class="row" style="position: relative;padding-top:30px; padding-left:40%;">
	<div class="col-xs-12 col-sm-12 col-md-4 well well-sm">
	<legend style="text-align:center;"><i class="fas fa-user-plus"></i> Inscription</legend>
	<br />
	<form id="formMemb" name="formMemb" action="gestionMembre.php" method="POST" class="form" role="form">	   
		<input class="form-control" id="codeUsager" name="codeUsager" placeholder="Code usager" type="text" />		
		<br />		
		<input class="form-control" id="email" name="email" placeholder="Adresse Email" type="email" />
		<br />	
		<input class="form-control" id="pass" name="pass" placeholder="Mot de passe" type="password" />
		<br />
		<input class="form-control" id="cpass" name="cpass" placeholder="Retaper mot de passe" type="password"/>
		<br>
		<input type="hidden" id="action" name="action" value="enregistrer"/>
		<input type="button" value="Valider" onClick="validerEnreg()" class="btn btn-md btn-primary btn-block"
			style="width:60%;text-align:center;display:block;margin:0 auto;"/> 
	</form>
	</div>
</div>


<?php 

include 'footer.php'; 

?>  


