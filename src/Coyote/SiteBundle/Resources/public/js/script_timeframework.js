$(document).ready(function()
{
    	var lundi = document.getElementById("deplacement1");
    	var deplundi = lundi.dataset.value;

    	lundi = document.getElementById("commentaire1");
    	var commentlundi = lundi.dataset.value;

    	lundi = document.getElementById("absence1");
    	var abslundi = lundi.dataset.value;
    	if(abslundi == null)
        {
            visibilityAbsenceTime("", 1, absdaylundi);
        }

    	lundi = document.getElementById("absenceday1");
    	var absdaylundi = lundi.dataset.value;

    	timeAbsence("", absdaylundi, "1");

    	var mardi = document.getElementById("deplacement2");
    	var depmardi = mardi.dataset.value;

    	mardi = document.getElementById("commentaire2");
    	var commentmardi = mardi.dataset.value;

    	mardi = document.getElementById("absence2");
    	var absmardi = mardi.dataset.value;
    	if(absmardi == null)
        {
            visibilityAbsenceTime("", 2, absdaymardi);
        }

    	mardi = document.getElementById("absenceday2");
    	var absdaymardi = mardi.dataset.value;

    	timeAbsence("", absdaymardi, "2");

    	var mercredi = document.getElementById("deplacement3");
    	var depmercredi = mercredi.dataset.value;

    	mercredi = document.getElementById("commentaire3");
    	var commentmercredi = mercredi.dataset.value;

    	mercredi = document.getElementById("absence3");
    	var absmercredi = mercredi.dataset.value;
    	if(absmercredi == null)
        {
            visibilityAbsenceTime("", 3, absdaymercredi);
        }

    	mercredi = document.getElementById("absenceday3");
    	var absdaymercredi = mercredi.dataset.value;

    	timeAbsence("", absdaymercredi, "3");

    	var jeudi = document.getElementById("deplacement4");
    	var depjeudi = jeudi.dataset.value;

    	jeudi = document.getElementById("commentaire4");
    	var commentjeudi = jeudi.dataset.value;

    	jeudi = document.getElementById("absence4");
    	var absjeudi = jeudi.dataset.value;
    	if(absjeudi == null)
        {
            visibilityAbsenceTime("", 4, absdayjeudi);
        }

    	jeudi = document.getElementById("absenceday4");
    	var absdayjeudi = jeudi.dataset.value;

    	timeAbsence("", absdayjeudi, "4");
	
    	var vendredi = document.getElementById("deplacement5");
    	var depvendredi = vendredi.dataset.value;

    	vendredi = document.getElementById("commentaire5");
    	var commentvendredi = vendredi.dataset.value;

    	vendredi = document.getElementById("absence5");
    	var absvendredi = vendredi.dataset.value;
    	if(absvendredi == null)
        {
            visibilityAbsenceTime("", 5, absdayvendredi);
        }

    	vendredi = document.getElementById("absenceday5");
    	var absdayvendredi = vendredi.dataset.value;

    	timeAbsence("", absdayvendredi, "5");

    	var samedi = document.getElementById("deplacement6");
    	var depsamedi = samedi.dataset.value;

    	samedi = document.getElementById("commentaire6");
    	var commentsamedi = samedi.dataset.value;

    	samedi = document.getElementById("absence6");
    	var abssamedi = samedi.dataset.value;
        if(abssamedi == null)
        {
            visibilityAbsenceTime("", 6, absdaysamedi);
        }

    	samedi = document.getElementById("absenceday6");
    	var absdaysamedi = samedi.dataset.value;

    	timeAbsence("", absdaysamedi, "6");

    	var dimanche = document.getElementById("deplacement7");
    	var depdimanche = dimanche.dataset.value;

    	dimanche = document.getElementById("commentaire7");
    	var commentdimanche = dimanche.dataset.value;

    	dimanche = document.getElementById("absence7");
    	var absdimanche = dimanche.dataset.value;
        if(absdimanche == null)
        {
            visibilityAbsenceTime("", 7, absdaydimanche);
        }

    	dimanche = document.getElementById("absenceday7");
    	var absdaydimanche = dimanche.dataset.value;

    	timeAbsence("", absdaydimanche, "7");

    if(commentlundi == 'null' | commentlundi == '')
        document.getElementById("commentaire1").value = "";

    if(commentmardi == 'null' | commentmardi == '')
        document.getElementById("commentaire2").value = "";

    if(commentmercredi == 'null' | commentmercredi == '')
        document.getElementById("commentaire3").value = "";

    if(commentjeudi == 'null' | commentjeudi == '')
        document.getElementById("commentaire4").value = "";

    if(commentvendredi == 'null' | commentvendredi == '')
        document.getElementById("commentaire5").value = "";

    if(commentsamedi == 'null' | commentsamedi == '')
        document.getElementById("commentaire6").value = "";

    if(commentdimanche == 'null' | commentdimanche == '')
        document.getElementById("commentaire7").value = "";

    visibilityAbsenceTime(abslundi, 1, absdaylundi);
    visibilityAbsenceTime(absmardi, 2, absdaymardi);
    visibilityAbsenceTime(absmercredi, 3, absdaymercredi);
    visibilityAbsenceTime(absjeudi, 4, absdayjeudi);
    visibilityAbsenceTime(absvendredi, 5, absdayvendredi);
    visibilityAbsenceTime(abssamedi, 6, absdaysamedi);
    visibilityAbsenceTime(absdimanche, 7, absdaydimanche);
    
    timeAbsence("", absdaylundi, "1");
    timeAbsence("", absdaymardi, "2");
    timeAbsence("", absdaymercredi, "3");
    timeAbsence("", absdayjeudi, "4");
    timeAbsence("", absdayvendredi, "5");
    timeAbsence("", absdaysamedi, "6");
    timeAbsence("", absdaydimanche, "7");

	if(deplundi == 0 | deplundi == "")
		document.getElementById('deplacement1').checked = false;
	if(deplundi == 1)
		document.getElementById('deplacement1').checked = true;

    if(depmardi == 0 | depmardi == "")
    	document.getElementById('deplacement2').checked = false;
    if(depmardi == 1)
    	document.getElementById('deplacement2').checked = true;

    if(depmercredi == 0 | depmercredi == "")
    	document.getElementById('deplacement3').checked = false;
    if(depmercredi == 1)
    	document.getElementById('deplacement3').checked = true;

    if(depjeudi == 0 | depjeudi == "")
    	document.getElementById('deplacement4').checked = false;
    if(depjeudi == 1)
    	document.getElementById('deplacement4').checked = true;

    if(depvendredi == 0 | depvendredi == "")
    	document.getElementById('deplacement5').checked = false;
    if(depvendredi == 1)
    	document.getElementById('deplacement5').checked = true;

    if(depsamedi == 0 | depsamedi == "")
    	document.getElementById('deplacement6').checked = false;
    if(depsamedi == 1)
    	document.getElementById('deplacement6').checked = true;

    if(depdimanche == 0 | depdimanche == "")
    	document.getElementById('deplacement7').checked = false;
    if(depdimanche == 1)
    	document.getElementById('deplacement7').checked = true;
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
    if(absence == "Autre")
	{
    	document.getElementById("absence"+jour).selectedIndex = 8;
    	document.getElementById("absenceday"+jour).style.visibility = "hidden";
		document.getElementById("absencetime"+jour).style.visibility = "visible";
		timeAbsence(2, absenceday, jour);
    }
}

function timeAbsence(absence, absenceday, jour)
{
    if(absenceday == "0.5")
    {
    	document.getElementById("absenceday"+jour).selectedIndex = 1;
    }
    if(absenceday == "1")
    {
    	document.getElementById("absenceday"+jour).selectedIndex = 2;
    }
	else
	{
    	if(absenceday != null)
    	    document.getElementById("absencetime"+jour).value = absenceday;
	}
}