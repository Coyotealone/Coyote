$(document).ready(function()
{
	initvalue();
});

function visibilityAbsenceTime(absence, jour, absenceday)
{
	if(absence == "Aucune" | absence == "")
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
    }
	if(absence == "CP")
	{
		document.getElementById("absence"+jour).selectedIndex = 2;
		document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
	}
	if(absence == "CA")
	{
		document.getElementById("absence"+jour).selectedIndex = 3;
		document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
	}
	if(absence == "CSS")
	{
		document.getElementById("absence"+jour).selectedIndex = 4;
		document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
    }
    if(absence == "AT")
	{
    	document.getElementById("absence"+jour).selectedIndex = 5;
    	document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
	}
	if(absence == "MP")
	{
    	document.getElementById("absence"+jour).selectedIndex = 6;
    	document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
	}
	if(absence == "Recup")
	{
    	document.getElementById("absence"+jour).selectedIndex = 7;
    	document.getElementById("absenceday"+jour).style.visibility = "hidden";
		document.getElementById("absencetime"+jour).style.visibility = "visible";
    }
    if(absence == "Autre")
	{
    	document.getElementById("absence"+jour).selectedIndex = 8;
    	document.getElementById("absenceday"+jour).style.visibility = "hidden";
		document.getElementById("absencetime"+jour).style.visibility = "visible";
    }
}

function timeAbsence(absenceday, jour)
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

function workingday(value, day)
{
	if (value == "1")
	{
		document.getElementById(day).selectedIndex = 3;
	}
	if (value == "0.5")
	{
		document.getElementById(day).selectedIndex = 2;
	}
	if (value == "0")
	{
		document.getElementById(day).selectedIndex = 1;
	}
}

function initvalue()
{
	var travel = new Array();
	var comment = new Array();
	var absence = new Array();
	var absenceday = new Array();
	var workdingday = new Array();
	var i = 0;
	var value = null;
	for(i=1; i<8; i++)
	{
		value = document.getElementById("travel"+i);
		travel[i] = value.dataset.value;
		value = document.getElementById("comment"+i);
    	comment[i] = value.dataset.value;
    	value = document.getElementById("absenceday"+i);
    	absenceday[i] = value.dataset.value;
    	value = document.getElementById("absence"+i);
    	absence[i] = value.dataset.value;
    	if (absence[i] == null)
        {
            visibilityAbsenceTime("", i, absenceday[i]);
        }
    	if (absence[i] != null)
    		visibilityAbsenceTime(absence[i], i, absenceday[i]);
    	value = document.getElementById("day"+i);
    	workingday[i] = value.dataset.value;
    	if (workingday[i] != null)
    		workingday(workingday[i], "day"+i);
    	timeAbsence(absenceday[i], i);
	}
	inittravel(travel);
	initcomment(comment);
}

function inittravel(travel)
{
	var i = 0;
	for(i=1;i<8;i++)
	{
		if(travel[i] == 0 | travel[i] == "")
			document.getElementById("travel"+i).checked = false;
		if(travel[i] == 1)
			document.getElementById("travel"+i).checked = true;
	}
}

function initcomment(comment)
{
	var i = 0;
	for(i=1;i<8;i++)
	{
		if(comment[i] == 'null' | comment[i] == '')
		    document.getElementById("comment"+i).value = "";
	}
}