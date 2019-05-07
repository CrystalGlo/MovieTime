var emailHeader="";
function validerEnreg(){
	var valide=true;
	var code=document.getElementById("codeUsager").value;
	var email=document.getElementById("email").value;
	var pass=document.getElementById("pass").value;
    var cpass=document.getElementById("cpass").value;

	if((code=="") || (email=="") || (pass=="") || (cpass=="")){
		alert("SVP remplir tous les champs");
		valide=false;
	}	
	if(pass!=cpass){
		alert("Mots de passe differents");
		valide=false;
	}
	if(valide){
		document.formMemb.submit();
	}
}

function validerConn(){
	var valide=true;
	var emailC=document.getElementById("emailC").value;
	emailHeader=emailC;
	var pass=document.getElementById("passC").value;
	if((emailC=="") || (pass=="")){
		alert("SVP remplir tous les champs");
		valide=false;
	}	
	if(valide){
		emailHeader=emailC;
		document.formConn.submit();
	}
}

function validerAjoutF(){
	var valide = true;
	var titre=document.getElementById("titre").value;
	var realisateur=document.getElementById("realisateur").value;
	var duree=document.getElementById("duree").value;
	var prix=document.getElementById("prix").value;
	var photo=document.getElementById("photo").value;
	if((titre=="") || (realisateur=="") || (duree=="") || (prix=="") || (photo=="")){
		alert("SVP remplir tous les champs");
		valide=false;
	}
	if(valide){
		document.formAjout.submit();
	}
}

function afficherVideo() {
	//var $this=$(this);
	/*var video = document.getElementById("video").innerHTML;
	alert("hello " + video);*/
	var video_iframe = document.getElementById("video_iframe");
	video_iframe.style.visibility='visible';
	//video_iframe.src=video_iframe.src+"?autoplay=1";
	video_iframe.width="560";
	video_iframe.height="315";
}

function headerPublic(){
	document.getElementById("headerBefore").style.visibility='visible';
	document.getElementById("headerAfter").style.visibility='hidden';
	document.getElementById("optionsAdmin").style.visibility='hidden';
}

function headerAdmin(){
	document.getElementById("headerBefore").style.visibility='hidden';
	document.getElementById("headerAfter").style.visibility='visible';
	document.getElementById("headerAfter").style.position='static';
	document.getElementById("optionsAdmin").style.visibility='visible';
	//document.getElementById("connEmail").innerHTML =emailHeader;
}

function headerUsager(){
	document.getElementById("headerBefore").style.visibility='hidden';
	document.getElementById("headerAfter").style.visibility='visible';
	document.getElementById("headerAfter").style.position='static';
	document.getElementById("optionsAdmin").style.visibility='hidden';
	document.getElementById("panier_logo").style.visibility='visible';
	//document.getElementById("connEmail").innerHTML=emailHeader;
}
