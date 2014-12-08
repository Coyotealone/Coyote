$(document).ready(function()
{
	var lundi = document.getElementById("deplacementlundi");
	var deplundi = lundi.dataset.value;

	lundi = document.getElementById("commentairelundi");
	var commentlundi = lundi.dataset.value;

	lundi = document.getElementById("absencelundi");
	var abslundi = lundi.dataset.value;

	lundi = document.getElementById("jourlundi");
	var workinghourslundi = lundi.dataset.value;


	var mardi = document.getElementById("deplacementmardi");
	var depmardi = mardi.dataset.value;

	mardi = document.getElementById("commentairemardi");
	var commentmardi = mardi.dataset.value;

	mardi = document.getElementById("absencemardi");
	var absmardi = mardi.dataset.value;

	mardi = document.getElementById("jourmardi");
	var workinghoursmardi = mardi.dataset.value;


	var mercredi = document.getElementById("deplacementmercredi");
	var depmercredi = mercredi.dataset.value;

	mercredi = document.getElementById("commentairemercredi");
	var commentmercredi = mercredi.dataset.value;

	mercredi = document.getElementById("absencemercredi");
	var absmercredi = mercredi.dataset.value;

	mercredi = document.getElementById("jourmercredi");
	var workinghoursmercredi = mercredi.dataset.value;


	var jeudi = document.getElementById("deplacementjeudi");
	var depjeudi = jeudi.dataset.value;

	jeudi = document.getElementById("commentairejeudi");
	var commentjeudi = jeudi.dataset.value;

	jeudi = document.getElementById("absencejeudi");
	var absjeudi = jeudi.dataset.value;

	jeudi = document.getElementById("jourjeudi");
	var workinghoursjeudi = jeudi.dataset.value;


	var vendredi = document.getElementById("deplacementvendredi");
	var depvendredi = vendredi.dataset.value;

	vendredi = document.getElementById("commentairevendredi");
	var commentvendredi = vendredi.dataset.value;

	vendredi = document.getElementById("absencevendredi");
	var absvendredi = vendredi.dataset.value;

	vendredi = document.getElementById("jourvendredi");
	var workinghoursvendredi = vendredi.dataset.value;


	var samedi = document.getElementById("deplacementsamedi");
	var depsamedi = samedi.dataset.value;

	samedi = document.getElementById("commentairesamedi");
	var commentsamedi = samedi.dataset.value;

	samedi = document.getElementById("absencesamedi");
	var abssamedi = samedi.dataset.value;

	samedi = document.getElementById("joursamedi");
	var workinghourssamedi = samedi.dataset.value;


	var dimanche = document.getElementById("deplacementdimanche");
	var depdimanche = dimanche.dataset.value;

	dimanche = document.getElementById("commentairedimanche");
	var commentdimanche = dimanche.dataset.value;

	dimanche = document.getElementById("absencedimanche");
	var absdimanche = dimanche.dataset.value;

	dimanche = document.getElementById("jourdimanche");
	var workinghoursdimanche = dimanche.dataset.value;


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


	if(abslundi == "Aucune")
		document.getElementById("absencelundi").selectedIndex = 0;
	if(abslundi == "RTT")
		document.getElementById("absencelundi").selectedIndex = 1;
	if(abslundi == 	"Congés payés")
		document.getElementById("absencelundi").selectedIndex = 2;
	if(abslundi == 	"CA")
		document.getElementById("absencelundi").selectedIndex = 3;
	if(abslundi == "Congés sans solde")
		document.getElementById("absencelundi").selectedIndex = 4;
	if(abslundi == 	"Maladie/At/Pat")
		document.getElementById("absencelundi").selectedIndex = 5;

	if(absmardi == "Aucune")
		document.getElementById("absencemardi").selectedIndex = 0;
	if(absmardi == "RTT")
		document.getElementById("absencemardi").selectedIndex = 1;
	if(absmardi == 	"Congés payés")
		document.getElementById("absencemardi").selectedIndex = 2;
	if(absmardi == 	"CA")
		document.getElementById("absencemardi").selectedIndex = 3;
	if(absmardi == "Congés sans solde")
		document.getElementById("absencemardi").selectedIndex = 4;
	if(absmardi == 	"Maladie/At/Pat")
		document.getElementById("absencemardi").selectedIndex = 5;

	if(absmercredi == "Aucune")
		document.getElementById("absencemercredi").selectedIndex = 0;
	if(absmercredi == "RTT")
		document.getElementById("absencemercredi").selectedIndex = 1;
	if(absmercredi == "Congés payés")
		document.getElementById("absencemercredi").selectedIndex = 2;
	if(absmercredi == "CA")
		document.getElementById("absencemercredi").selectedIndex = 3;
	if(absmercredi == "Congés sans solde")
		document.getElementById("absencemercredi").selectedIndex = 4;
	if(absmercredi == "Maladie/At/Pat")
		document.getElementById("absencemercredi").selectedIndex = 5;

	if(absjeudi == "Aucune")
		document.getElementById("absencejeudi").selectedIndex = 0;
	if(absjeudi == "RTT")
		document.getElementById("absencejeudi").selectedIndex = 1;
	if(absjeudi == "Congés payés")
		document.getElementById("absencejeudi").selectedIndex = 2;
	if(absjeudi == "CA")
		document.getElementById("absencejeudi").selectedIndex = 3;
	if(absjeudi == "Congés sans solde")
		document.getElementById("absencejeudi").selectedIndex = 4;
	if(absjeudi == "Maladie/At/Pat")
		document.getElementById("absencejeudi").selectedIndex = 5;

	if(absvendredi == "Aucune")
		document.getElementById("absencevendredi").selectedIndex = 0;
	if(absvendredi == "RTT")
		document.getElementById("absencevendredi").selectedIndex = 1;
	if(absvendredi == "Congés payés")
		document.getElementById("absencevendredi").selectedIndex = 2;
	if(absvendredi == "CA")
		document.getElementById("absencevendredi").selectedIndex = 3;
	if(absvendredi == "Congés sans solde")
		document.getElementById("absencevendredi").selectedIndex = 4;
	if(absvendredi == "Maladie/At/Pat")
		document.getElementById("absencevendredi").selectedIndex = 5;

	if(abssamedi == "Aucune")
		document.getElementById("absencesamedi").selectedIndex = 0;
	if(abssamedi == "RTT")
		document.getElementById("absencesamedi").selectedIndex = 1;
	if(abssamedi == "Congés payés")
		document.getElementById("absencesamedi").selectedIndex = 2;
	if(abssamedi == "CA")
		document.getElementById("absencesamedi").selectedIndex = 3;
	if(abssamedi == "Congés sans solde")
		document.getElementById("absencesamedi").selectedIndex = 4;
	if(abssamedi == "Maladie/At/Pat")
		document.getElementById("absencesamedi").selectedIndex = 5;

	if(absdimanche == "Aucune")
		document.getElementById("absencedimanche").selectedIndex = 0;
	if(absdimanche == "RTT")
		document.getElementById("absencedimanche").selectedIndex = 1;
	if(absdimanche == "Congés payés")
		document.getElementById("absencedimanche").selectedIndex = 2;
	if(absdimanche == "CA")
		document.getElementById("absencedimanche").selectedIndex = 3;
	if(absdimanche == "Congés sans solde")
		document.getElementById("absencedimanche").selectedIndex = 4;
	if(absdimanche == "Maladie/At/Pat")
		document.getElementById("absencedimanche").selectedIndex = 5;

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
