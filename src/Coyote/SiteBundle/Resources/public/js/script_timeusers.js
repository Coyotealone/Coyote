$(document).ready(function()
{
	initValue();

});

function timeweek(workingtime)
{
	var index = 0;
	var time = new Array();
	for(index=1;index<8;index++)
	{
		if (workingtime[index] != null)
	        time[index] = new Number(timeinminutes(workingtime[index]));
	    if (workingtime[index] == null)
	        time[index] = new Number(0);
	}

    var timetotal = new Number(time[1]+time[2]+time[3]+time[4]+time[5]+time[6]+time[7]);
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

function initValue()
{
	var value = "";
	var workingtime = new Array();
	var i = 0;
	for(i=1;i<8;i++)
	{
		value = document.getElementById("start"+i);
		if(value != null)
		{
	    	var start = value.dataset.value;

	    	value = document.getElementById("end"+i);
	    	var end = value.dataset.value;

	    	value = document.getElementById("break"+i);
	    	var pause = value.dataset.value;

	    	value = document.getElementById("travel"+i);
	    	var travel = value.dataset.value;

	    	value = document.getElementById("workingtime"+i);
	    	workingtime[i] = value.dataset.value;

	    	value = document.getElementById("comment"+i);
	    	var comment = value.dataset.value;

	    	value = document.getElementById("absenceday"+i);
	    	var absenceday = value.dataset.value;
	    	
	    	value = document.getElementById("absence"+i);
	    	var absence = value.dataset.value;
	    	if (absence == null)
	        {
	            visibilityAbsenceTime("", i, absenceday);
	        }
	    	if (absence != null)
	    	{
	    		visibilityAbsenceTime(absence, i, absenceday);
	    	}
	    	timeAbsence("", absenceday, i);
	    	
	    	if (travel == 0 | travel == "")
	    		document.getElementById('trave'+i).checked = false;
	    	if (travel == 1)
	    		document.getElementById('travel'+i).checked = true;
	    }
		
	    if(document.getElementById('timeweek') != null)
	        document.getElementById('timeweek').value = timeweek(workingtime);
	}
}