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

	lundi = document.getElementById("absencedaylundi");
	var absdaylundi = lundi.dataset.value;

	timeAbsence("", absdaylundi, "lundi");


	var mardi = document.getElementById("deplacementmardi");
	var depmardi = mardi.dataset.value;

	mardi = document.getElementById("commentairemardi");
	var commentmardi = mardi.dataset.value;

	mardi = document.getElementById("absencemardi");
	var absmardi = mardi.dataset.value;

	mardi = document.getElementById("jourmardi");
	var workinghoursmardi = mardi.dataset.value;

	mardi = document.getElementById("absencedaymardi");
	var absdaymardi = mardi.dataset.value;

	timeAbsence("", absdaymardi, "mardi");


	var mercredi = document.getElementById("deplacementmercredi");
	var depmercredi = mercredi.dataset.value;

	mercredi = document.getElementById("commentairemercredi");
	var commentmercredi = mercredi.dataset.value;

	mercredi = document.getElementById("absencemercredi");
	var absmercredi = mercredi.dataset.value;

	mercredi = document.getElementById("jourmercredi");
	var workinghoursmercredi = mercredi.dataset.value;

	mercredi = document.getElementById("absencedaymercredi");
	var absdaymercredi = mercredi.dataset.value;

	timeAbsence("", absdaymercredi, "mercredi");


	var jeudi = document.getElementById("deplacementjeudi");
	var depjeudi = jeudi.dataset.value;

	jeudi = document.getElementById("commentairejeudi");
	var commentjeudi = jeudi.dataset.value;

	jeudi = document.getElementById("absencejeudi");
	var absjeudi = jeudi.dataset.value;

	jeudi = document.getElementById("jourjeudi");
	var workinghoursjeudi = jeudi.dataset.value;

	jeudi = document.getElementById("absencedayjeudi");
	var absdayjeudi = jeudi.dataset.value;

	timeAbsence("", absdayjeudi, "jeudi");


	var vendredi = document.getElementById("deplacementvendredi");
	var depvendredi = vendredi.dataset.value;

	vendredi = document.getElementById("commentairevendredi");
	var commentvendredi = vendredi.dataset.value;

	vendredi = document.getElementById("absencevendredi");
	var absvendredi = vendredi.dataset.value;

	vendredi = document.getElementById("jourvendredi");
	var workinghoursvendredi = vendredi.dataset.value;

	vendredi = document.getElementById("absencedayvendredi");
	var absdayvendredi = vendredi.dataset.value;

	timeAbsence("", absdayvendredi, "vendredi");


	var samedi = document.getElementById("deplacementsamedi");
	var depsamedi = samedi.dataset.value;

	samedi = document.getElementById("commentairesamedi");
	var commentsamedi = samedi.dataset.value;

	samedi = document.getElementById("absencesamedi");
	var abssamedi = samedi.dataset.value;

	samedi = document.getElementById("joursamedi");
	var workinghourssamedi = samedi.dataset.value;

	samedi = document.getElementById("absencedaysamedi");
	var absdaysamedi = samedi.dataset.value;

	timeAbsence("", absdaysamedi, "samedi");


	var dimanche = document.getElementById("deplacementdimanche");
	var depdimanche = dimanche.dataset.value;

	dimanche = document.getElementById("commentairedimanche");
	var commentdimanche = dimanche.dataset.value;

	dimanche = document.getElementById("absencedimanche");
	var absdimanche = dimanche.dataset.value;

	dimanche = document.getElementById("jourdimanche");
	var workinghoursdimanche = dimanche.dataset.value;

	dimanche = document.getElementById("absencedaydimanche");
	var absdaydimanche = dimanche.dataset.value;

	timeAbsence("", absdaydimanche, "dimanche");


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

    if(deplundi == 0 | deplundi == "")
		document.getElementById('deplacementlundi').checked = false;
	if(deplundi == 1)
		document.getElementById('deplacementlundi').checked = true;

    if(depmardi == 0 | depmardi == "")
    	document.getElementById('deplacementmardi').checked = false;
    if(depmardi == 1)
    	document.getElementById('deplacementmardi').checked = true;

    if(depmercredi == 0 | depmercredi == "")
    	document.getElementById('deplacementmercredi').checked = false;
    if(depmercredi == 1)
    	document.getElementById('deplacementmercredi').checked = true;

    if(depjeudi == 0 | depjeudi == "")
    	document.getElementById('deplacementjeudi').checked = false;
    if(depjeudi == 1)
    	document.getElementById('deplacementjeudi').checked = true;

    if(depvendredi == 0 | depvendredi == "")
    	document.getElementById('deplacementvendredi').checked = false;
    if(depvendredi == 1)
    	document.getElementById('deplacementvendredi').checked = true;

    if(depsamedi == 0 | depsamedi == "")
    	document.getElementById('deplacementsamedi').checked = false;
    if(depsamedi == 1)
    	document.getElementById('deplacementsamedi').checked = true;

    if(depdimanche == 0 | depdimanche == "")
    	document.getElementById('deplacementdimanche').checked = false;
    if(depdimanche == 1)
    	document.getElementById('deplacementdimanche').checked = true;

    visibilityAbsenceTime(abslundi, "lundi", absdaylundi);
    visibilityAbsenceTime(absmardi, "mardi", absdaymardi);
    visibilityAbsenceTime(absmercredi, "mercredi", absdaymercredi);
    visibilityAbsenceTime(absjeudi, "jeudi", absdayjeudi);
    visibilityAbsenceTime(absvendredi, "vendredi", absdayvendredi);
    visibilityAbsenceTime(abssamedi, "samedi", absdaysamedi);
    visibilityAbsenceTime(absdimanche, "dimanche", absdaydimanche);
});

function visibilityAbsenceTime(absence, jour, absenceday)
{
    if(absence == "Aucune" || absence == "")
	{
		document.getElementById("absence"+jour).selectedIndex = 0;
		document.getElementById("absenceday"+jour).style.visibility = "hidden";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
    }
	if(absence == "RTT")
	{
		document.getElementById("absence"+jour).selectedIndex = 1;
		document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";

		timeAbsence(0, absenceday, jour);
    }
	if(absence == "CP")
	{
		document.getElementById("absence"+jour).selectedIndex = 2;
		document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
		timeAbsence(0, absenceday, jour);
	}
	if(absence == "CA")
	{
		document.getElementById("absence"+jour).selectedIndex = 3;
		document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
		timeAbsence(0, absenceday, jour);
	}
	if(absence == "CSS")
	{
		document.getElementById("absence"+jour).selectedIndex = 4;
		document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
		timeAbsence(0, absenceday, jour);
    }
	if(absence == "AT")
	{
    	document.getElementById("absence"+jour).selectedIndex = 5;
    	document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
		timeAbsence(0, absenceday, jour);
	}
	if(absence == "MP")
	{
    	document.getElementById("absence"+jour).selectedIndex = 6;
    	document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
		timeAbsence(0, absenceday, jour);
	}
	if(absence == "Recup")
	{
    	document.getElementById("absence"+jour).selectedIndex = 7;
    	document.getElementById("absenceday"+jour).style.visibility = "hidden";
		document.getElementById("absencetime"+jour).style.visibility = "visible";
		timeAbsence(2, absenceday, jour);
    }

    visibilityAbsenceTime(abslundi, "lundi", absdaylundi);
    visibilityAbsenceTime(absmardi, "mardi", absdaymardi);
    visibilityAbsenceTime(absmercredi, "mercredi", absdaymercredi);
    visibilityAbsenceTime(absjeudi, "jeudi", absdayjeudi);
    visibilityAbsenceTime(absvendredi, "vendredi", absdayvendredi);
    visibilityAbsenceTime(abssamedi, "samedi", absdaysamedi);
    visibilityAbsenceTime(absdimanche, "dimanche", absdaydimanche);
}

function timeAbsence(absence, absenceday, jour)
{
    //if(absence == 0)
    //{
        if(absenceday == "0.5")
        {
        	document.getElementById("absenceday"+jour).selectedIndex = 1;
        }
        if(absenceday == "1")
        {
        	document.getElementById("absenceday"+jour).selectedIndex = 2;
        }
	//}
	else
	{
    	document.getElementById("absencetime"+jour).value = absenceday;
	}
}
