$(document).ready(function()
{
	var lundi = document.getElementById("debutlundi");
	if(lundi != null)
	{
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

    	lundi = document.getElementById("absencedaylundi");
    	var absdaylundi = lundi.dataset.value;

    	timeAbsence("", absdaylundi, "lundi");
    }

    var mardi = document.getElementById("debutmardi");
	if(mardi!= null)
	{
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

    	mardi = document.getElementById("absencedaymardi");
    	var absdaymardi = mardi.dataset.value;

    	timeAbsence("", absdaymardi, "mardi");
	}

	var mercredi = document.getElementById("debutmercredi");
	if(mercredi != null)
	{
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

    	mercredi = document.getElementById("absencedaymercredi");
    	var absdaymercredi = mercredi.dataset.value;

    	timeAbsence("", absdaymercredi, "mercredi");
    }

    var jeudi = document.getElementById("debutjeudi");
	if(jeudi != null)
	{
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

    	jeudi = document.getElementById("absencedayjeudi");
    	var absdayjeudi = jeudi.dataset.value;

    	timeAbsence("", absdayjeudi, "jeudi");
    }

	var vendredi = document.getElementById("debutvendredi");
	if(vendredi != null)
	{
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

    	vendredi = document.getElementById("absencedayvendredi");
    	var absdayvendredi = vendredi.dataset.value;

    	timeAbsence("", absdayvendredi, "vendredi");
	}

	var samedi = document.getElementById("debutsamedi");
	if(samedi != null)
	{
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

    	samedi = document.getElementById("absencedaysamedi");
    	var absdaysamedi = samedi.dataset.value;

    	timeAbsence("", absdaysamedi, "samedi");
    }


	var dimanche = document.getElementById("debutdimanche");
	if(dimanche != null)
	{
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

    	dimanche = document.getElementById("absencedaydimanche");
    	var absdaydimanche = dimanche.dataset.value;

    	timeAbsence("", absdaydimanche, "dimanche");
    }

    if(startlundi == 'null' | startlundi == '')
        document.getElementById("debutlundi").value = "00:00";
    if(breaklundi == 'null' | breaklundi == '')
        document.getElementById("pauselundi").value = "00:00";
    if(endlundi == 'null' | endlundi == '')
        document.getElementById("finlundi").value = "00:00";
    if(commentlundi == 'null' | commentlundi == '')
        document.getElementById("commentairelundi").value = "";

    if(startmardi == 'null' | startmardi == '')
        document.getElementById("debutmardi").value = "00:00";
    if(breakmardi == 'null' | breakmardi == '')
        document.getElementById("pausemardi").value = "00:00";
    if(endmardi == 'null' | endmardi == '')
        document.getElementById("finmardi").value = "00:00";
    if(commentmardi == 'null' | commentmardi == '')
        document.getElementById("commentairemardi").value = "";

    if(startmercredi == 'null' | startmercredi == '')
        document.getElementById("debutmercredi").value = "00:00";
    if(breakmercredi == 'null' | breakmercredi == '')
        document.getElementById("pausemercredi").value = "00:00";
    if(endmercredi == 'null' | endmercredi == '')
        document.getElementById("finmercredi").value = "00:00";
    if(commentmercredi == 'null' | commentmercredi == '')
        document.getElementById("commentairemercredi").value = "";

    if(startjeudi == 'null' | startjeudi == '')
        document.getElementById("debutjeudi").value = "00:00";
    if(breakjeudi == 'null' | breakjeudi == '')
        document.getElementById("pausejeudi").value = "00:00";
    if(endjeudi == 'null' | endjeudi == '')
        document.getElementById("finjeudi").value = "00:00";
    if(commentjeudi == 'null' | commentjeudi == '')
        document.getElementById("commentairejeudi").value = "";

    if(startvendredi == 'null' | startvendredi == '')
        document.getElementById("debutvendredi").value = "00:00";
    if(breakvendredi == 'null' | breakvendredi == '')
        document.getElementById("pausevendredi").value = "00:00";
    if(endvendredi == 'null' | endvendredi == '')
        document.getElementById("finvendredi").value = "00:00";
    if(commentvendredi == 'null' | commentvendredi == '')
        document.getElementById("commentairevendredi").value = "";

    if(startsamedi == 'null' | startsamedi == '')
        document.getElementById("debutsamedi").value = "00:00";
    if(breaksamedi == 'null' | breaksamedi == '')
        document.getElementById("pausesamedi").value = "00:00";
    if(endsamedi == 'null' | endsamedi == '')
        document.getElementById("finsamedi").value = "00:00";
    if(commentsamedi == 'null' | commentsamedi == '')
        document.getElementById("commentairesamedi").value = "";

    if(startdimanche == 'null' | startdimanche == '')
        document.getElementById("debutdimanche").value = "00:00";
    if(breakdimanche == 'null' | breakdimanche == '')
        document.getElementById("pausedimanche").value = "00:00";
    if(enddimanche == 'null' | enddimanche == '')
        document.getElementById("findimanche").value = "00:00";
    if(commentdimanche == 'null' | commentdimanche == '')
        document.getElementById("commentairedimanche").value = "";

    visibilityAbsenceTime(abslundi, "lundi", absdaylundi);
    visibilityAbsenceTime(absmardi, "mardi", absdaymardi);
    visibilityAbsenceTime(absmercredi, "mercredi", absdaymercredi);
    visibilityAbsenceTime(absjeudi, "jeudi", absdayjeudi);
    visibilityAbsenceTime(absvendredi, "vendredi", absdayvendredi);
    visibilityAbsenceTime(abssamedi, "samedi", absdaysamedi);
    visibilityAbsenceTime(absdimanche, "dimanche", absdaydimanche);

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