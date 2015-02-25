$(document).ready(function()
{
	var lundi = document.getElementById("debut1");
	if(lundi != null)
	{
    	var startlundi = lundi.dataset.value;

    	lundi = document.getElementById("fin1");
    	var endlundi = lundi.dataset.value;

    	lundi = document.getElementById("pause1");
    	var breaklundi = lundi.dataset.value;

    	lundi = document.getElementById("deplacement1");
    	var deplundi = lundi.dataset.value;

    	lundi = document.getElementById("tps1");
    	var workingtimelundi = lundi.dataset.value;

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
    }

    var mardi = document.getElementById("debut2");
	if(mardi!= null)
	{
    	var startmardi = mardi.dataset.value;

    	mardi = document.getElementById("fin2");
    	var endmardi = mardi.dataset.value;

    	mardi = document.getElementById("pause2");
    	var breakmardi = mardi.dataset.value;

    	mardi = document.getElementById("deplacement2");
    	var depmardi = mardi.dataset.value;

    	mardi = document.getElementById("tps2");
    	var workingtimemardi = mardi.dataset.value;

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
	}

	var mercredi = document.getElementById("debut3");
	if(mercredi != null)
	{
    	var startmercredi = mercredi.dataset.value;

    	mercredi = document.getElementById("fin3");
    	var endmercredi = mercredi.dataset.value;

    	mercredi = document.getElementById("pause3");
    	var breakmercredi = mercredi.dataset.value;

    	mercredi = document.getElementById("deplacement3");
    	var depmercredi = mercredi.dataset.value;

    	mercredi = document.getElementById("tps3");
    	var workingtimemercredi = mercredi.dataset.value;

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
    }

    var jeudi = document.getElementById("debut4");
	if(jeudi != null)
	{
    	var startjeudi = jeudi.dataset.value;

    	jeudi = document.getElementById("fin4");
    	var endjeudi = jeudi.dataset.value;

    	jeudi = document.getElementById("pause4");
    	var breakjeudi = jeudi.dataset.value;

    	jeudi = document.getElementById("deplacement4");
    	var depjeudi = jeudi.dataset.value;

    	jeudi = document.getElementById("tps4");
    	var workingtimejeudi = jeudi.dataset.value;

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
    }

	var vendredi = document.getElementById("debut5");
	if(vendredi != null)
	{
    	var startvendredi = vendredi.dataset.value;

        vendredi = document.getElementById("fin5");
    	var endvendredi = vendredi.dataset.value;

    	vendredi = document.getElementById("pause5");
    	var breakvendredi = vendredi.dataset.value;

    	vendredi = document.getElementById("deplacement5");
    	var depvendredi = vendredi.dataset.value;

    	vendredi = document.getElementById("tps5");
    	var workingtimevendredi = vendredi.dataset.value;

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
	}

	var samedi = document.getElementById("debut6");
	if(samedi != null)
	{
    	var startsamedi = samedi.dataset.value;

    	samedi = document.getElementById("fin6");
    	var endsamedi = samedi.dataset.value;

    	samedi = document.getElementById("pause6");
    	var breaksamedi = samedi.dataset.value;

    	samedi = document.getElementById("deplacement6");
    	var depsamedi = samedi.dataset.value;

    	samedi = document.getElementById("tps6");
    	var workingtimesamedi = samedi.dataset.value;

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
    }


	var dimanche = document.getElementById("debut7");
	if(dimanche != null)
	{
    	var startdimanche = dimanche.dataset.value;

    	dimanche = document.getElementById("fin7");
    	var enddimanche = dimanche.dataset.value;

    	dimanche = document.getElementById("pause7");
    	var breakdimanche = dimanche.dataset.value;

    	dimanche = document.getElementById("deplacement7");
    	var depdimanche = dimanche.dataset.value;

    	dimanche = document.getElementById("tps7");
    	var workingtimedimanche = dimanche.dataset.value;

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
    }

    if(startlundi == 'null' | startlundi == '')
        document.getElementById("debut1").value = "00:00";
    if(breaklundi == 'null' | breaklundi == '')
        document.getElementById("pause1").value = "00:00";
    if(endlundi == 'null' | endlundi == '')
        document.getElementById("fin1").value = "00:00";
    if(commentlundi == 'null' | commentlundi == '')
        document.getElementById("commentaire1").value = "";

    if(startmardi == 'null' | startmardi == '')
        document.getElementById("debut2").value = "00:00";
    if(breakmardi == 'null' | breakmardi == '')
        document.getElementById("pause2").value = "00:00";
    if(endmardi == 'null' | endmardi == '')
        document.getElementById("fin2").value = "00:00";
    if(commentmardi == 'null' | commentmardi == '')
        document.getElementById("commentaire2").value = "";

    if(startmercredi == 'null' | startmercredi == '')
        document.getElementById("debut3").value = "00:00";
    if(breakmercredi == 'null' | breakmercredi == '')
        document.getElementById("pause3").value = "00:00";
    if(endmercredi == 'null' | endmercredi == '')
        document.getElementById("fin3").value = "00:00";
    if(commentmercredi == 'null' | commentmercredi == '')
        document.getElementById("commentaire3").value = "";

    if(startjeudi == 'null' | startjeudi == '')
        document.getElementById("debut4").value = "00:00";
    if(breakjeudi == 'null' | breakjeudi == '')
        document.getElementById("pause4").value = "00:00";
    if(endjeudi == 'null' | endjeudi == '')
        document.getElementById("fin4").value = "00:00";
    if(commentjeudi == 'null' | commentjeudi == '')
        document.getElementById("commentaire4").value = "";

    if(startvendredi == 'null' | startvendredi == '')
        document.getElementById("debut5").value = "00:00";
    if(breakvendredi == 'null' | breakvendredi == '')
        document.getElementById("pause5").value = "00:00";
    if(endvendredi == 'null' | endvendredi == '')
        document.getElementById("fin5").value = "00:00";
    if(commentvendredi == 'null' | commentvendredi == '')
        document.getElementById("commentaire5").value = "";

    if(startsamedi == 'null' | startsamedi == '')
        document.getElementById("debut6").value = "00:00";
    if(breaksamedi == 'null' | breaksamedi == '')
        document.getElementById("pause6").value = "00:00";
    if(endsamedi == 'null' | endsamedi == '')
        document.getElementById("fin6").value = "00:00";
    if(commentsamedi == 'null' | commentsamedi == '')
        document.getElementById("commentaire6").value = "";

    if(startdimanche == 'null' | startdimanche == '')
        document.getElementById("debut7").value = "00:00";
    if(breakdimanche == 'null' | breakdimanche == '')
        document.getElementById("pause7").value = "00:00";
    if(enddimanche == 'null' | enddimanche == '')
        document.getElementById("fin7").value = "00:00";
    if(commentdimanche == 'null' | commentdimanche == '')
        document.getElementById("commentaire7").value = "";

    visibilityAbsenceTime(abslundi, 1, absdaylundi);
    visibilityAbsenceTime(absmardi, 2, absdaymardi);
    visibilityAbsenceTime(absmercredi, 3, absdaymercredi);
    visibilityAbsenceTime(absjeudi, 4, absdayjeudi);
    visibilityAbsenceTime(absvendredi, 5, absdayvendredi);
    visibilityAbsenceTime(abssamedi, 6, absdaysamedi);
    visibilityAbsenceTime(absdimanche, 7, absdaydimanche);

	if(deplundi == 0 | deplundi == "")
		document.getElementById('deplacement0').checked = false;
	if(deplundi == 1)
		document.getElementById('deplacement0').checked = true;

    if(depmardi == 0 | depmardi == "")
    	document.getElementById('deplacement1').checked = false;
    if(depmardi == 1)
    	document.getElementById('deplacement1').checked = true;

    if(depmercredi == 0 | depmercredi == "")
    	document.getElementById('deplacement2').checked = false;
    if(depmercredi == 1)
    	document.getElementById('deplacement2').checked = true;

    if(depjeudi == 0 | depjeudi == "")
    	document.getElementById('deplacement3').checked = false;
    if(depjeudi == 1)
    	document.getElementById('deplacement3').checked = true;

    if(depvendredi == 0 | depvendredi == "")
    	document.getElementById('deplacement4').checked = false;
    if(depvendredi == 1)
    	document.getElementById('deplacement4').checked = true;

    if(depsamedi == 0 | depsamedi == "")
    	document.getElementById('deplacement5').checked = false;
    if(depsamedi == 1)
    	document.getElementById('deplacement5').checked = true;

    if(depdimanche == 0 | depdimanche == "")
    	document.getElementById('deplacement6').checked = false;
    if(depdimanche == 1)
    	document.getElementById('deplacement6').checked = true;

    var res = timeweek(workingtimelundi, workingtimemardi, workingtimemercredi, workingtimejeudi, workingtimevendredi, workingtimesamedi, workingtimedimanche);
    if(document.getElementById('timeweek') != null)
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
    	if(absenceday != null)
    	    document.getElementById("absencetime"+jour).value = absenceday;
	}
}