<?php include 'header.php'; ?> 

<div class="row" style="position: relative;padding-top:30px; padding-left:40%;">
<div class="col-xs-12 col-sm-12 col-md-4 well well-sm">
	<legend style="text-align:center;"><i class="fas fa-sign-in-alt"></i> Connexion</legend>
	<form id="formConn" name="formConn" action="gestionMembre.php" method="POST" class="form" role="form">
	<br />
	<input class="form-control" id="emailC" name="emailC" placeholder="Adresse Email" type="email" />
	<br />
	<input class="form-control" id="passC" name="passC" placeholder="Mot de passe" type="password" />
	<br />
	<div class="btns" style="width:60%;text-align:center; display: block; margin: 0 auto; ">
		<input type="hidden" id="action" name="action" value="connecter"/>
		<input type="button" value="Se connecter" onclick="validerConn()" class="btn btn-md btn-primary btn-block"/> 
		<button class="btn btn-sm btn-danger btn-block" type="reset">Annuler</button>
	</div>
	</form>
</div>
</div>

<?php include 'footer.php'; ?>  

