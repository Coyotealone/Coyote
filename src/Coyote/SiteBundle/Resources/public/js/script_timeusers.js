$(document).ready(function()
{
	var lundi = document.getElementById("debutlundi");
	var startlundi = lundi.dataset.value;
	
	lundi = document.getElementById("finlundi");
	var endlundi = lundi.dataset.value;
	
	lundi = document.getElementById("pauselundi");
	var breaklundi = lundi.dataset.value;
	
	lundi = document.getElementById("deplacementlundi");
	var deplundi = lundi.dataset.value;
	
	lundi = document.getElementById("tpslundi");
	var workingtimelundi = lundi.dataset.value;
	
	lundi = document.getElementById("commentairelundi");
	var commentlundi = lundi.dataset.value;
	
	lundi = document.getElementById("absencelundi");
	var abslundi = lundi.dataset.value;
	
	lundi = document.getElementById("jourlundi");
	var workinghourslundi = lundi.dataset.value;

    
    var mardi = document.getElementById("debutmardi");
	var startmardi = mardi.dataset.value;
	
	mardi = document.getElementById("finmardi");
	var endmardi = mardi.dataset.value;
	
	mardi = document.getElementById("pausemardi");
	var breakmardi = mardi.dataset.value;
	
	mardi = document.getElementById("deplacementmardi");
	var depmardi = mardi.dataset.value;
	
	mardi = document.getElementById("tpsmardi");
	var workingtimemardi = mardi.dataset.value;
	
	mardi = document.getElementById("commentairemardi");
	var commentmardi = mardi.dataset.value;
	
	mardi = document.getElementById("absencemardi");
	var absmardi = mardi.dataset.value;
	
	mardi = document.getElementById("jourmardi");
	var workinghoursmardi = mardi.dataset.value;
	
	
	var mercredi = document.getElementById("debutmercredi");
	var startmercredi = mercredi.dataset.value;
	
	mercredi = document.getElementById("finmercredi");
	var endmercredi = mercredi.dataset.value;
	
	mercredi = document.getElementById("pausemercredi");
	var breakmercredi = mercredi.dataset.value;
	
	mercredi = document.getElementById("deplacementmercredi");
	var depmercredi = mercredi.dataset.value;
	
	mercredi = document.getElementById("tpsmercredi");
	var workingtimemercredi = mercredi.dataset.value;
	
	mercredi = document.getElementById("commentairemercredi");
	var commentmercredi = mercredi.dataset.value;
	
	mercredi = document.getElementById("absencemercredi");
	var absmercredi = mercredi.dataset.value;
	
	mercredi = document.getElementById("jourmercredi");
	var workinghoursmercredi = mercredi.dataset.value;
	
    
    var jeudi = document.getElementById("debutjeudi");
	var startjeudi = jeudi.dataset.value;
	
	jeudi = document.getElementById("finjeudi");
	var endjeudi = jeudi.dataset.value;
	
	jeudi = document.getElementById("pausejeudi");
	var breakjeudi = jeudi.dataset.value;
	
	jeudi = document.getElementById("deplacementjeudi");
	var depjeudi = jeudi.dataset.value;
	
	jeudi = document.getElementById("tpsjeudi");
	var workingtimejeudi = jeudi.dataset.value;
	
	jeudi = document.getElementById("commentairejeudi");
	var commentjeudi = jeudi.dataset.value;
	
	jeudi = document.getElementById("absencejeudi");
	var absjeudi = jeudi.dataset.value;
	
	jeudi = document.getElementById("jourjeudi");
	var workinghoursjeudi = jeudi.dataset.value;
	
	
	var vendredi = document.getElementById("debutvendredi");
	var startvendredi = vendredi.dataset.value;
	
	vendredi = document.getElementById("finvendredi");
	var endvendredi = vendredi.dataset.value;
	
	vendredi = document.getElementById("pausevendredi");
	var breakvendredi = vendredi.dataset.value;
	
	vendredi = document.getElementById("deplacementvendredi");
	var depvendredi = vendredi.dataset.value;
	
	vendredi = document.getElementById("tpsvendredi");
	var workingtimevendredi = vendredi.dataset.value;
	
	vendredi = document.getElementById("commentairevendredi");
	var commentvendredi = vendredi.dataset.value;
	
	vendredi = document.getElementById("absencevendredi");
	var absvendredi = vendredi.dataset.value;
	
	vendredi = document.getElementById("jourvendredi");
	var workinghoursvendredi = vendredi.dataset.value;
	
	
	var samedi = document.getElementById("debutsamedi");
	var startsamedi = samedi.dataset.value;
	
	samedi = document.getElementById("finsamedi");
	var endsamedi = samedi.dataset.value;
	
	samedi = document.getElementById("pausesamedi");
	var breaksamedi = samedi.dataset.value;
	
	samedi = document.getElementById("deplacementsamedi");
	var depsamedi = samedi.dataset.value;
	
	samedi = document.getElementById("tpssamedi");
	var workingtimesamedi = samedi.dataset.value;
	
	samedi = document.getElementById("commentairesamedi");
	var commentsamedi = samedi.dataset.value;
	
	samedi = document.getElementById("absencesamedi");
	var abssamedi = samedi.dataset.value;
	
	samedi = document.getElementById("joursamedi");
	var workinghourssamedi = samedi.dataset.value;
	
	
	var dimanche = document.getElementById("debutdimanche");
	var startdimanche = dimanche.dataset.value;
	
	dimanche = document.getElementById("findimanche");
	var enddimanche = dimanche.dataset.value;
	
	dimanche = document.getElementById("pausedimanche");
	var breakdimanche = dimanche.dataset.value;
	
	dimanche = document.getElementById("deplacementdimanche");
	var depdimanche = dimanche.dataset.value;
	
	dimanche = document.getElementById("tpsdimanche");
	var workingtimedimanche = dimanche.dataset.value;
	
	dimanche = document.getElementById("commentairedimanche");
	var commentdimanche = dimanche.dataset.value;
	
	dimanche = document.getElementById("absencedimanche");
	var absdimanche = dimanche.dataset.value;
	
	dimanche = document.getElementById("jourdimanche");
	var workinghoursdimanche = dimanche.dataset.value;
    
    if(startlundi == 'null' | startlundi == '')
        document.getElementById("debutlundi").value = "00:00";
    if(breaklundi == 'null' | breaklundi == '')
        document.getElementById("pauselundi").value = "00:00";
    if(endlundi == 'null' | endlundi == '')
        document.getElementById("finlundi").value = "00:00";
    if(workingtimelundi == 'null' | workingtimelundi == '')
        document.getElementById("tpslundi").value = "00:00";
    if(commentlundi == 'null' | commentlundi == '')
        document.getElementById("commentairelundi").value = "";
        
    if(startmardi == 'null' | startmardi == '')
        document.getElementById("debutmardi").value = "00:00";
    if(breakmardi == 'null' | breakmardi == '')
        document.getElementById("pausemardi").value = "00:00";
    if(endmardi == 'null' | endmardi == '')
        document.getElementById("finmardi").value = "00:00";
    if(workingtimemardi == 'null' | workingtimemardi == '')
        document.getElementById("tpsmardi").value = "00:00";
    if(commentmardi == 'null' | commentmardi == '')
        document.getElementById("commentairemardi").value = "";
        
    if(startmercredi == 'null' | startmercredi == '')
        document.getElementById("debutmercredi").value = "00:00";
    if(breakmercredi == 'null' | breakmercredi == '')
        document.getElementById("pausemercredi").value = "00:00";
    if(endmercredi == 'null' | endmercredi == '')
        document.getElementById("finmercredi").value = "00:00";
    if(workingtimemercredi == 'null' | workingtimemercredi == '')
        document.getElementById("tpsmercredi").value = "00:00";
    if(commentmercredi == 'null' | commentmercredi == '')
        document.getElementById("commentairemercredi").value = "";
        
    if(startjeudi == 'null' | startjeudi == '')
        document.getElementById("debutjeudi").value = "00:00";
    if(breakjeudi == 'null' | breakjeudi == '')
        document.getElementById("pausejeudi").value = "00:00";
    if(endjeudi == 'null' | endjeudi == '')
        document.getElementById("finjeudi").value = "00:00";
    if(workingtimejeudi == 'null' | workingtimejeudi == '')
        document.getElementById("tpsjeudi").value = "00:00";
    if(commentjeudi == 'null' | commentjeudi == '')
        document.getElementById("commentairejeudi").value = "";
    
    if(startvendredi == 'null' | startvendredi == '')
        document.getElementById("debutvendredi").value = "00:00";
    if(breakvendredi == 'null' | breakvendredi == '')
        document.getElementById("pausevendredi").value = "00:00";
    if(endvendredi == 'null' | endvendredi == '')
        document.getElementById("finvendredi").value = "00:00";
    if(workingtimevendredi == 'null' | workingtimevendredi == '')
        document.getElementById("tpsvendredi").value = "00:00";
    if(commentvendredi == 'null' | commentvendredi == '')
        document.getElementById("commentairevendredi").value = "";
        
    if(startsamedi == 'null' | startsamedi == '')
        document.getElementById("debutsamedi").value = "00:00";
    if(breaksamedi == 'null' | breaksamedi == '')
        document.getElementById("pausesamedi").value = "00:00";
    if(endsamedi == 'null' | endsamedi == '')
        document.getElementById("finsamedi").value = "00:00";
    if(workingtimesamedi == 'null' | workingtimesamedi == '')
        document.getElementById("tpssamedi").value = "00:00";
    if(commentsamedi == 'null' | commentsamedi == '')
        document.getElementById("commentairesamedi").value = "";
        
    if(startdimanche == 'null' | startdimanche == '')
        document.getElementById("debutdimanche").value = "00:00";
    if(breakdimanche == 'null' | breakdimanche == '')
        document.getElementById("pausedimanche").value = "00:00";
    if(enddimanche == 'null' | enddimanche == '')
        document.getElementById("findimanche").value = "00:00";
    if(workingtimedimanche == 'null' | workingtimedimanche == '')
        document.getElementById("tpsdimanche").value = "00:00";
    if(commentdimanche == 'null' | commentdimanche == '')
        document.getElementById("commentairedimanche").value = "";

	if(abslundi == "Aucune")
		document.getElementById("absencelundi").selectedIndex = 0;
	if(abslundi == "RTT")
		document.getElementById("absencelundi").selectedIndex = 1;
	if(abslundi == 	"Congés payés")
		document.getElementById("absencelundi").selectedIndex = 2;
	if(abslundi == 	"CA")
		document.getElementById("absencelundi").selectedIndex = 3;
	if(abslundi == 	"CEF")
		document.getElementById("absencelundi").selectedIndex = 4;
	if(abslundi == "Congés sans solde")
		document.getElementById("absencelundi").selectedIndex = 5;
	if(abslundi == 	"Maladie/At/Pat")
		document.getElementById("absencelundi").selectedIndex = 6;
	
	if(absmardi == "Aucune")
		document.getElementById("absencemardi").selectedIndex = 0;
	if(absmardi == "RTT")
		document.getElementById("absencemardi").selectedIndex = 1;
	if(absmardi == 	"Congés payés")
		document.getElementById("absencemardi").selectedIndex = 2;
	if(absmardi == 	"CA")
		document.getElementById("absencemardi").selectedIndex = 3;
	if(absmardi == 	"CEF")
		document.getElementById("absencemardi").selectedIndex = 4;
	if(absmardi == "Congés sans solde")
		document.getElementById("absencemardi").selectedIndex = 5;
	if(absmardi == 	"Maladie/At/Pat")
		document.getElementById("absencemardi").selectedIndex = 6;
		
	if(absmercredi == "Aucune")
		document.getElementById("absencemercredi").selectedIndex = 0;
	if(absmercredi == "RTT")
		document.getElementById("absencemercredi").selectedIndex = 1;
	if(absmercredi == "Congés payés")
		document.getElementById("absencemercredi").selectedIndex = 2;
	if(absmercredi == "CA")
		document.getElementById("absencemercredi").selectedIndex = 3;
	if(absmercredi == "CEF")
		document.getElementById("absencemercredi").selectedIndex = 4;
	if(absmercredi == "Congés sans solde")
		document.getElementById("absencemercredi").selectedIndex = 5;
	if(absmercredi == "Maladie/At/Pat")
		document.getElementById("absencemercredi").selectedIndex = 6;
	
	if(absjeudi == "Aucune")
		document.getElementById("absencejeudi").selectedIndex = 0;
	if(absjeudi == "RTT")
		document.getElementById("absencejeudi").selectedIndex = 1;
	if(absjeudi == "Congés payés")
		document.getElementById("absencejeudi").selectedIndex = 2;
	if(absjeudi == "CA")
		document.getElementById("absencejeudi").selectedIndex = 3;
	if(absjeudi == "CEF")
		document.getElementById("absencejeudi").selectedIndex = 4;
	if(absjeudi == "Congés sans solde")
		document.getElementById("absencejeudi").selectedIndex = 5;
	if(absjeudi == "Maladie/At/Pat")
		document.getElementById("absencejeudi").selectedIndex = 6;
	
	if(absvendredi == "Aucune")
		document.getElementById("absencevendredi").selectedIndex = 0;
	if(absvendredi == "RTT")
		document.getElementById("absencevendredi").selectedIndex = 1;
	if(absvendredi == "Congés payés")
		document.getElementById("absencevendredi").selectedIndex = 2;
	if(absvendredi == "CA")
		document.getElementById("absencevendredi").selectedIndex = 3;
	if(absvendredi == "CEF")
		document.getElementById("absencevendredi").selectedIndex = 4;
	if(absvendredi == "Congés sans solde")
		document.getElementById("absencevendredi").selectedIndex = 5;
	if(absvendredi == "Maladie/At/Pat")
		document.getElementById("absencevendredi").selectedIndex = 6;
	
	if(abssamedi == "Aucune")
		document.getElementById("absencesamedi").selectedIndex = 0;
	if(abssamedi == "RTT")
		document.getElementById("absencesamedi").selectedIndex = 1;
	if(abssamedi == "Congés payés")
		document.getElementById("absencesamedi").selectedIndex = 2;
	if(abssamedi == "CA")
		document.getElementById("absencesamedi").selectedIndex = 3;
	if(abssamedi == "CEF")
		document.getElementById("absencesamedi").selectedIndex = 4;
	if(abssamedi == "Congés sans solde")
		document.getElementById("absencesamedi").selectedIndex = 5;
	if(abssamedi == "Maladie/At/Pat")
		document.getElementById("absencesamedi").selectedIndex = 6;
		
	if(absdimanche == "Aucune")
		document.getElementById("absencedimanche").selectedIndex = 0;
	if(absdimanche == "RTT")
		document.getElementById("absencedimanche").selectedIndex = 1;
	if(absdimanche == "Congés payés")
		document.getElementById("absencedimanche").selectedIndex = 2;
	if(absdimanche == "CA")
		document.getElementById("absencedimanche").selectedIndex = 3;
	if(absdimanche == "CEF")
		document.getElementById("absencedimanche").selectedIndex = 4;
	if(absdimanche == "Congés sans solde")
		document.getElementById("absencedimanche").selectedIndex = 5;
	if(absdimanche == "Maladie/At/Pat")
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
        
    var res = timeweek(workingtimelundi, workingtimemardi, workingtimemercredi, workingtimejeudi, workingtimevendredi, workingtimesamedi, workingtimedimanche);
    document.getElementById('timeweek').value = res;
    
    
});

function timeweek(timemonday, timetuesday, timewednesday, timethursday, timefriday, timesunday, timesaturday)
{
    var monday = new Number(timeinminutes(timemonday));
    var tuesday = new Number(timeinminutes(timetuesday));
    var wednesday = new Number(timeinminutes(timewednesday));
    var thursday = new Number(timeinminutes(timethursday));
    var friday = new Number(timeinminutes(timefriday));
    var sunday = new Number(timeinminutes(timesunday));
    var saturday = new Number(timeinminutes(timesaturday));

    var timetotal = new Number(monday+tuesday+wednesday+thursday+friday+sunday+saturday);
    return timeinhours(timetotal);    
}

function timeinminutes(time)
{
    if(typeof(time) != 'undefined')
    {
        var timeend = time.split(':');
        var hours = new Number(timeend[0]);
        var minutes = new Number(timeend[1]);
        var timeminutes = hours * 60 + minutes;
        return timeminutes;
    }
}

function timeinhours(time)
{
    var minutes = time % 60;
    var hour = time - minutes;
    hour = hour / 60;
    if(minutes < 10)
        minutes = '0'+ minutes;
    return hour +'h'+minutes;   
}