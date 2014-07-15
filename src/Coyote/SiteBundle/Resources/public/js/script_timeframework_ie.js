$(document).ready(function()
{	
	var lundi = document.getElementById("deplacementlundi");
	var deplundi = lundi.getAttribute('data-value');
	
	lundi = document.getElementById("commentairelundi");
	var commentlundi = lundi.getAttribute('data-value');
	
	lundi = document.getElementById("absencelundi");
	var abslundi = lundi.getAttribute('data-value');
	
	lundi = document.getElementById("jourlundi");
	var workinghourslundi = lundi.getAttribute('data-value');
	
    		
	var mardi = document.getElementById("deplacementmardi");
	var depmardi = mardi.getAttribute('data-value');
	
	mardi = document.getElementById("commentairemardi");
	var commentmardi = mardi.getAttribute('data-value');
	
	mardi = document.getElementById("absencemardi");
	var absmardi = mardi.getAttribute('data-value');
	
	mardi = document.getElementById("jourmardi");
	var workinghoursmardi = mardi.getAttribute('data-value');
	
	
	var mercredi = document.getElementById("deplacementmercredi");
	var depmercredi = mercredi.getAttribute('data-value');
	
	mercredi = document.getElementById("commentairemercredi");
	var commentmercredi = mercredi.getAttribute('data-value');
	
	mercredi = document.getElementById("absencemercredi");
	var absmercredi = mercredi.getAttribute('data-value');
	
	mercredi = document.getElementById("jourmercredi");
	var workinghoursmercredi = mercredi.getAttribute('data-value');
	
	
	var jeudi = document.getElementById("deplacementjeudi");
	var depjeudi = jeudi.getAttribute('data-value');
	
	jeudi = document.getElementById("commentairejeudi");
	var commentjeudi = jeudi.getAttribute('data-value');
	
	jeudi = document.getElementById("absencejeudi");
	var absjeudi = jeudi.getAttribute('data-value');
	
	jeudi = document.getElementById("jourjeudi");
	var workinghoursjeudi = jeudi.getAttribute('data-value');
	
	
	var vendredi = document.getElementById("deplacementvendredi");
	var depvendredi = vendredi.getAttribute('data-value');
	
	vendredi = document.getElementById("commentairevendredi");
	var commentvendredi = vendredi.getAttribute('data-value');
	
	vendredi = document.getElementById("absencevendredi");
	var absvendredi = vendredi.getAttribute('data-value');
	
	vendredi = document.getElementById("jourvendredi");
	var workinghoursvendredi = vendredi.getAttribute('data-value');
	
			
	var samedi = document.getElementById("deplacementsamedi");
	var depsamedi = samedi.getAttribute('data-value');
	
	samedi = document.getElementById("commentairesamedi");
	var commentsamedi = samedi.getAttribute('data-value');
	
	samedi = document.getElementById("absencesamedi");
	var abssamedi = samedi.getAttribute('data-value');
	
	samedi = document.getElementById("joursamedi");
	var workinghourssamedi = samedi.getAttribute('data-value');
	
			
	var dimanche = document.getElementById("deplacementdimanche");
	var depdimanche = dimanche.getAttribute('data-value');
	
	dimanche = document.getElementById("commentairedimanche");
	var commentdimanche = dimanche.getAttribute('data-value');
	
	dimanche = document.getElementById("absencedimanche");
	var absdimanche = dimanche.getAttribute('data-value');
	
	dimanche = document.getElementById("jourdimanche");
	var workinghoursdimanche = dimanche.getAttribute('data-value');
    

    if(commentlundi == 'null' | commentlundi == '')
        document.getElementById("commentairelundi").value = "";
        
    if(commentmardi == 'null' | commentmardi == '')
        document.getElementById("commentairemardi").value = "";
        
    if(commentmercredi == 'null' | commentmercredi == '')
        document.getElementById("commentairemercredi").value = "";
        
    if(commentjeudi == 'null' | commentjeudi == '')
        document.getElementById("commentairejeudi").value = "";
    
    if(commentvendredi == 'null' | commentvendredi == '')
        document.getElementById("commentairevendredi").value = "";
        
    if(commentsamedi == 'null' | commentsamedi == '')
        document.getElementById("commentairesamedi").value = "";
        
    if(commentdimanche == 'null' | commentdimanche == '')
        document.getElementById("commentairedimanche").value = "";
       
    if(workinghourslundi == '1')
        document.getElementById("jourlundi").value = "1";
        
    if(workinghoursmardi == '1')
        document.getElementById("jourmardi").value = "1";
        
    if(workinghoursmercredi == '1')
        document.getElementById("jourmercredi").value = "1";
        
    if(workinghoursjeudi == '1')
        document.getElementById("jourjeudi").value = "1";
    
    if(workinghoursvendredi == '1')
        document.getElementById("jourvendredi").value = "1";
        
    if(workinghourssamedi == '1')
        document.getElementById("joursamedi").value = "1";
        
    if(workinghoursdimanche == '1')
        document.getElementById("jourdimanche").value = "1";
        
    
    if(workinghourslundi == '0.5')
        document.getElementById("jourlundi").value = "0.5";
        
    if(workinghoursmardi == '0.5')
        document.getElementById("jourmardi").value = "0.5";
        
    if(workinghoursmercredi == '0.5')
        document.getElementById("jourmercredi").value = "0.5";
        
    if(workinghoursjeudi == '0.5')
        document.getElementById("jourjeudi").value = "0.5";
    
    if(workinghoursvendredi == '0.5')
        document.getElementById("jourvendredi").value = "0.5";
        
    if(workinghourssamedi == '0.5')
        document.getElementById("joursamedi").value = "0.5";
        
    if(workinghoursdimanche == '0.5')
        document.getElementById("jourdimanche").value = "0.5"; 
        

	if(abslundi == "aucune")
		document.getElementById("absencelundi").selectedIndex = 0;
	if(abslundi == "rtt")
		document.getElementById("absencelundi").selectedIndex = 1;
	if(abslundi == 	"cp")
		document.getElementById("absencelundi").selectedIndex = 2;
	if(abslundi == 	"ca")
		document.getElementById("absencelundi").selectedIndex = 3;
	if(abslundi == 	"cef")
		document.getElementById("absencelundi").selectedIndex = 4;
	if(abslundi == "css")
		document.getElementById("absencelundi").selectedIndex = 5;
	if(abslundi == 	"mal")
		document.getElementById("absencelundi").selectedIndex = 6;
	
	if(absmardi == "aucune")
		document.getElementById("absencemardi").selectedIndex = 0;
	if(absmardi == "rtt")
		document.getElementById("absencemardi").selectedIndex = 1;
	if(absmardi == 	"cp")
		document.getElementById("absencemardi").selectedIndex = 2;
	if(absmardi == 	"ca")
		document.getElementById("absencemardi").selectedIndex = 3;
	if(absmardi == 	"cef")
		document.getElementById("absencemardi").selectedIndex = 4;
	if(absmardi == "css")
		document.getElementById("absencemardi").selectedIndex = 5;
	if(absmardi == 	"mal")
		document.getElementById("absencemardi").selectedIndex = 6;
		
	if(absmercredi == "aucune")
		document.getElementById("absencemercredi").selectedIndex = 0;
	if(absmercredi == "rtt")
		document.getElementById("absencemercredi").selectedIndex = 1;
	if(absmercredi == "cp")
		document.getElementById("absencemercredi").selectedIndex = 2;
	if(absmercredi == "ca")
		document.getElementById("absencemercredi").selectedIndex = 3;
	if(absmercredi == "cef")
		document.getElementById("absencemercredi").selectedIndex = 4;
	if(absmercredi == "css")
		document.getElementById("absencemercredi").selectedIndex = 5;
	if(absmercredi == "mal")
		document.getElementById("absencemercredi").selectedIndex = 6;
	
	if(absjeudi == "aucune")
		document.getElementById("absencejeudi").selectedIndex = 0;
	if(absjeudi == "rtt")
		document.getElementById("absencejeudi").selectedIndex = 1;
	if(absjeudi == "cp")
		document.getElementById("absencejeudi").selectedIndex = 2;
	if(absjeudi == "ca")
		document.getElementById("absencejeudi").selectedIndex = 3;
	if(absjeudi == "cef")
		document.getElementById("absencejeudi").selectedIndex = 4;
	if(absjeudi == "css")
		document.getElementById("absencejeudi").selectedIndex = 5;
	if(absjeudi == "mal")
		document.getElementById("absencejeudi").selectedIndex = 6;
	
	if(absvendredi == "aucune")
		document.getElementById("absencevendredi").selectedIndex = 0;
	if(absvendredi == "rtt")
		document.getElementById("absencevendredi").selectedIndex = 1;
	if(absvendredi == "cp")
		document.getElementById("absencevendredi").selectedIndex = 2;
	if(absvendredi == "ca")
		document.getElementById("absencevendredi").selectedIndex = 3;
	if(absvendredi == "cef")
		document.getElementById("absencevendredi").selectedIndex = 4;
	if(absvendredi == "css")
		document.getElementById("absencevendredi").selectedIndex = 5;
	if(absvendredi == "mal")
		document.getElementById("absencevendredi").selectedIndex = 6;
	
	if(abssamedi == "aucune")
		document.getElementById("absencesamedi").selectedIndex = 0;
	if(abssamedi == "rtt")
		document.getElementById("absencesamedi").selectedIndex = 1;
	if(abssamedi == "cp")
		document.getElementById("absencesamedi").selectedIndex = 2;
	if(abssamedi == "ca")
		document.getElementById("absencesamedi").selectedIndex = 3;
	if(abssamedi == "cef")
		document.getElementById("absencesamedi").selectedIndex = 4;
	if(abssamedi == "css")
		document.getElementById("absencesamedi").selectedIndex = 5;
	if(abssamedi == "mal")
		document.getElementById("absencesamedi").selectedIndex = 6;
		
	if(absdimanche == "aucune")
		document.getElementById("absencedimanche").selectedIndex = 0;
	if(absdimanche == "rtt")
		document.getElementById("absencedimanche").selectedIndex = 1;
	if(absdimanche == "cp")
		document.getElementById("absencedimanche").selectedIndex = 2;
	if(absdimanche == "ca")
		document.getElementById("absencedimanche").selectedIndex = 3;
	if(absdimanche == "cef")
		document.getElementById("absencedimanche").selectedIndex = 4;
	if(absdimanche == "css")
		document.getElementById("absencedimanche").selectedIndex = 5;
	if(absdimanche == "mal")
		document.getElementById("absencedimanche").selectedIndex = 6;
	
	if(deplundi == 0 | deplundi == "")
		document.getElementById('deplacementlundi').selectedIndex=0;
	if(deplundi == 1)
		document.getElementById('deplacementlundi').selectedIndex=1;
		
	if(depmardi == 0 | depmardi == "")
		document.getElementById('deplacementmardi').selectedIndex=0;
	if(depmardi == 1)
		document.getElementById('deplacementmardi').selectedIndex=1;
		
	if(depmercredi == 0 | depmercredi == "")
		document.getElementById('deplacementmercredi').selectedIndex=0;
	if(depmercredi == 1)
		document.getElementById('deplacementmercredi').selectedIndex=1;
		
	if(depjeudi == 0 | depjeudi == "")
		document.getElementById('deplacementjeudi').selectedIndex=0;
	if(depjeudi == 1)
		document.getElementById('deplacementjeudi').selectedIndex=1;
		
	if(depvendredi == 0 | depvendredi == "")
		document.getElementById('deplacementvendredi').selectedIndex=0;
	if(depvendredi == 1)
		document.getElementById('deplacementvendredi').selectedIndex=1;
		
	if(depsamedi == 0 | depsamedi == "")
		document.getElementById('deplacementsamedi').selectedIndex=0;
	if(depsamedi == 1)
		document.getElementById('deplacementsamedi').selectedIndex=1;
	if(depdimanche == 0 | depdimanche == "")
		document.getElementById('deplacementdimanche').selectedIndex=0;
	if(depdimanche == 1)
		document.getElementById('deplacementdimanche').selectedIndex=1;
});
