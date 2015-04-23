$(document).ready(function()
{
    $("#absence1").change(function()
    {
        var absence1 = document.getElementById("absence1").value;
        visibilityAbsenceTime(absence1, 1);
    })

    $("#absence2").change(function()
    {
        var absence2 = document.getElementById("absence2").value;
        visibilityAbsenceTime(absence2, 2);
    })

    $("#absence3").change(function()
    {
        var absence3 = document.getElementById("absence3").value;
        visibilityAbsenceTime(absence3, 3);
    })

    $("#absence4").change(function()
    {
        var absence4 = document.getElementById("absence4").value;
        visibilityAbsenceTime(absence4, 4);
    })

    $("#absence5").change(function()
    {
        var absence5 = document.getElementById("absence5").value;
        visibilityAbsenceTime(absence5, 5);
    })

    $("#absence6").change(function()
    {
        var absence6 = document.getElementById("absence6").value;
        visibilityAbsenceTime(absence6, 6);
    })

    $("#absence7").change(function()
    {
        var absence7 = document.getElementById("absence7").value;
        visibilityAbsenceTime(absence7, 7);
    })

    $("#absencetime1").change(function()
    {
        var absencetime1 = document.getElementById("absencetime1").value;
        absencetime1 = splitformatTime(absencetime1);
        absencetime1 = formatTime(absencetime1);
        document.getElementById("absencetime1").value = absencetime1;
        visibilityAbsenceTime(absencetime1, 1);
    })

    $("#absencetime2").change(function()
    {
        var absencetime2 = document.getElementById("absencetime2").value;
        absencetime2 = splitformatTime(absencetime2);
        absencetime2 = formatTime(absencetime2);
        document.getElementById("absencetime2").value = absencetime2;
        visibilityAbsenceTime(absencetime2, 2);
    })

    $("#absencetime3").change(function()
    {
        var absencetime3 = document.getElementById("absencetime3").value;
        absencetime3 = splitformatTime(absencetime3);
        absencetime3 = formatTime(absencetime3);
        document.getElementById("absencetime3").value = absencetime3;
        visibilityAbsenceTime(absencetime3, 3);
    })

    $("#absencetime4").change(function()
    {
        var absencetime4 = document.getElementById("absencetime4").value;
        absencetime4 = splitformatTime(absencetime4);
        absencetime4 = formatTime(absencetime4);
        document.getElementById("absencetime4").value = absencetime4;
        visibilityAbsenceTime(absencetime4, 4);
    })

    $("#absencetime5").change(function()
    {
        var absencetime5 = document.getElementById("absencetime5").value;
        absencetime5 = splitformatTime(absencetime5);
        absencetime5 = formatTime(absencetime5);
        document.getElementById("absencetime5").value = absencetime5;
        visibilityAbsenceTime(absencetime5, 5);
    })

    $("#absencetime6").change(function()
    {
        var absencetime6 = document.getElementById("absencetime6").value;
        absencetime6 = splitformatTime(absencetime6);
        absencetime6 = formatTime(absencetime6);
        document.getElementById("absencetime6").value = absencetime6;
        visibilityAbsenceTime(absencetime6, 6);
    })

    $("#absencetime7").change(function()
    {
        var absencetime7 = document.getElementById("absencetime7").value;
        absencetime7 = splitformatTime(absencetime7);
        absencetime7 = formatTime(absencetime7);
        document.getElementById("absencetime7").value = absencetime7;
        visibilityAbsenceTime(absencetime7, 7);
    })

    $("#start1").change(function()
    {
        var start1 = document.getElementById("start1").value;
        start1 = splitformatTime(start1);
        start1 = formatTime(start1);
        document.getElementById("start1").value = start1;
        var end1 = document.getElementById("end1").value;
        var break1 = document.getElementById("break1").value;

        var time1 = calculWorkingTime(start1, end1, break1);
        var day1 = calculWorkingDay(time1);
        if(time1 != null)
            document.getElementById("workingtime1").value = time1;
    })

    $("#break1").change(function()
    {
        var start1 = document.getElementById("start1").value;
        var end1 = document.getElementById("end1").value;
        var break1 = document.getElementById("break1").value;
        break1 = splitformatTime(break1);
        break1 = formatTime(break1);
        document.getElementById("break1").value = break1;

        var time1 = calculWorkingTime(start1, end1, break1);
        var day1 = calculWorkingDay(time1);
        if(time1 != null)
            document.getElementById("workingtime1").value = time1;
    })

    $("#end1").change(function()
    {
        var start1 = document.getElementById("start1").value;
        var end1 = document.getElementById("end1").value;
        end1 = splitformatTime(end1);
        end1 = formatTime(end1);
        document.getElementById("end1").value = end1;
        var break1 = document.getElementById("break1").value;

        var time1 = calculWorkingTime(start1, end1, break1);
        var day1 = calculWorkingDay(time1);
        if(time1 != null)
            document.getElementById("workingtime1").value = time1;
    })


    $("#start2").change(function()
    {
        var start2 = document.getElementById("start2").value;
        start2 = splitformatTime(start2);
        start2 = formatTime(start2);
        document.getElementById("start2").value = start2;
        var end2 = document.getElementById("end2").value;
        var break2 = document.getElementById("break2").value;

        var time2 = calculWorkingTime(start2, end2, break2);
        var day2 = calculWorkingDay(time2);
        if(time2 != null)
            document.getElementById("workingtime2").value = time2;
    })

    $("#break2").change(function()
    {
        var start2 = document.getElementById("start2").value;
        var end2 = document.getElementById("end2").value;
        var break2 = document.getElementById("break2").value;
        break2 = splitformatTime(break2);
        break2 = formatTime(break2);
        document.getElementById("break2").value = break2;

        var time2 = calculWorkingTime(start2, end2, break2);
        var day2 = calculWorkingDay(time2);
        if(time2 != null)
            document.getElementById("workingtime2").value = time2;
    })

    $("#end2").change(function()
    {
        var start2 = document.getElementById("start2").value;
        var end2 = document.getElementById("end2").value;
        end2 = splitformatTime(end2);
        end2 = formatTime(end2);
        document.getElementById("end2").value = end2;
        var break2 = document.getElementById("break2").value;

        var time2 = calculWorkingTime(start2, end2, break2);
        var day2 = calculWorkingDay(time2);
        if(time2 != null)
            document.getElementById("workingtime2").value = time2;
    })


    $("#start3").change(function()
    {
        var start3 = document.getElementById("start3").value;
        start3 = splitformatTime(start3);
        start3 = formatTime(start3);
        document.getElementById("start3").value = start3;
        var end3 = document.getElementById("end3").value;
        var break3 = document.getElementById("break3").value;

        var time3 = calculWorkingTime(start3, end3, break3);
        var day3 = calculWorkingDay(time3);
        if(time3 != null)
            document.getElementById("workingtime3").value = time3;
    })

    $("#break3").change(function()
    {
        var start3 = document.getElementById("start3").value;
        var end3 = document.getElementById("end3").value;
        var break3 = document.getElementById("break3").value;
        break3 = splitformatTime(break3);
        break3 = formatTime(break3);
        document.getElementById("break3").value = break3;

        var time3 = calculWorkingTime(start3, end3, break3);
        var day3 = calculWorkingDay(time3);
        if(time3 != null)
            document.getElementById("workingtime3").value = time3;
    })

    $("#end3").change(function()
    {
        var start3 = document.getElementById("start3").value;
        var end3 = document.getElementById("end3").value;
        end3 = splitformatTime(end3);
        end3 = formatTime(end3);
        document.getElementById("end3").value = end3;
        var break3 = document.getElementById("break3").value;

        var time3 = calculWorkingTime(start3, end3, break3);
        var day3 = calculWorkingDay(time3);
        if(time3 != null)
            document.getElementById("workingtime3").value = time3;
    })


    $("#start4").change(function()
    {
        var start4 = document.getElementById("start4").value;
        start4 = splitformatTime(start4);
        start4 = formatTime(start4);
        document.getElementById("start4").value = start4;
        var end4 = document.getElementById("end4").value;
        var break4 = document.getElementById("break4").value;

        var time4 = calculWorkingTime(start4, end4, break4);
        var day4 = calculWorkingDay(time4);
        if(time4 != null)
            document.getElementById("workingtime4").value = time4;
    })

    $("#break4").change(function()
    {
        var start4 = document.getElementById("start4").value;
        var end4 = document.getElementById("end4").value;
        var break4 = document.getElementById("break4").value;
        break4 = splitformatTime(break4);
        break4 = formatTime(break4);
        document.getElementById("break4").value = break4;

        var time4 = calculWorkingTime(start4, end4, break4);
        var day4 = calculWorkingDay(time4);
        if(time4 != null)
            document.getElementById("workingtime4").value = time4;
    })

    $("#end4").change(function()
    {
        var start4 = document.getElementById("start4").value;
        var end4 = document.getElementById("end4").value;
        end4 = splitformatTime(end4);
        end4 = formatTime(end4);
        document.getElementById("end4").value = end4;
        var break4 = document.getElementById("break4").value;

        var time4 = calculWorkingTime(start4, end4, break4);
        var day4 = calculWorkingDay(time4);
        if(time4 != null)
            document.getElementById("workingtime4").value = time4;
    })


    $("#start5").change(function()
    {
        var start5 = document.getElementById("start5").value;
        start5 = splitformatTime(start5);
        start5 = formatTime(start5);
        document.getElementById("start5").value = start5;
        var end5 = document.getElementById("end5").value;
        var break5 = document.getElementById("break5").value;

        var time5 = calculWorkingTime(start5, end5, break5);
        var day5 = calculWorkingDay(time5);
        if(time5 != null)
            document.getElementById("workingtime5").value = time5;
    })

    $("#break5").change(function()
    {
        var start5 = document.getElementById("start5").value;
        var end5 = document.getElementById("end5").value;
        var break5 = document.getElementById("break5").value;
        break5 = splitformatTime(break5);
        break5 = formatTime(break5);
        document.getElementById("break5").value = break5;

        var time5 = calculWorkingTime(start5, end5, break5);
        var day5 = calculWorkingDay(time5);
        if(time5 != null)
            document.getElementById("workingtime5").value = time5;
    })

    $("#end5").change(function()
    {
        var start5 = document.getElementById("start5").value;
        var end5 = document.getElementById("end5").value;
        end5 = splitformatTime(end5);
        end5 = formatTime(end5);
        document.getElementById("end5").value = end5;
        var break5 = document.getElementById("break5").value;

        var time5 = calculWorkingTime(start5, end5, break5);
        var day5 = calculWorkingDay(time5);
        if(time5 != null)
            document.getElementById("workingtime5").value = time5;
    })


    $("#start6").change(function()
    {
        var start6 = document.getElementById("start6").value;
        start6 = splitformatTime(start6);
        start6 = formatTime(start6);
        document.getElementById("start6").value = start6;
        var end6 = document.getElementById("end6").value;
        var break6 = document.getElementById("break6").value;

        var time6 = calculWorkingTime(start6, end6, break6);
        var day6 = calculWorkingDay(time6);
        if(time6 != null)
            document.getElementById("workingtime6").value = time6;
    })

    $("#break6").change(function()
    {
        var start6 = document.getElementById("start6").value;
        var end6 = document.getElementById("end6").value;
        var break6 = document.getElementById("break6").value;
        break6 = splitformatTime(break6);
        break6 = formatTime(break6);
        document.getElementById("break6").value = break6;

        var time6 = calculWorkingTime(start6, end6, break6);
        var day6 = calculWorkingDay(time6);
        if(time6 != null)
            document.getElementById("workingtime6").value = time6;
    })

    $("#end6").change(function()
    {
        var start6 = document.getElementById("start6").value;
        var end6 = document.getElementById("end6").value;
        end6 = splitformatTime(end6);
        end6 = formatTime(end6);
        document.getElementById("end6").value = end6;
        var break6 = document.getElementById("break6").value;

        var time6 = calculWorkingTime(start6, end6, break6);
        var day6 = calculWorkingDay(time6);
        if(time6 != null)
            document.getElementById("workingtime6").value = time6;
    })


    $("#start7").change(function()
    {
        var start7 = document.getElementById("start7").value;
        start7 = splitformatTime(start7);
        start7 = formatTime(start7);
        document.getElementById("start7").value = start7;
        var end7 = document.getElementById("end7").value;
        var break7 = document.getElementById("break7").value;

        var time7 = calculWorkingTime(start7, end7, break7);
        var day7 = calculWorkingDay(time7);
        if(time7 != null)
            document.getElementById("workingtime7").value = time7;
    })

    $("#break7").change(function()
    {
        var start7 = document.getElementById("start7").value;
        var end7 = document.getElementById("end7").value;
        var break7 = document.getElementById("break7").value;
        break7 = splitformatTime(break7);
        break7 = formatTime(break7);
        document.getElementById("break7").value = break7;

        var time7 = calculWorkingTime(start7, end7, break7);
        var day7 = calculWorkingDay(time7);
        if(time7 != null)
            document.getElementById("workingtime7").value = time7;
    })

    $("#end7").change(function()
    {
        var start7 = document.getElementById("start7").value;
        var end7 = document.getElementById("end7").value;
        end7 = splitformatTime(end7);
        end7 = formatTime(end7);
        document.getElementById("end7").value = end7;
        var break7 = document.getElementById("break7").value;

        var time7 = calculWorkingTime(start7, end7, break7);
        var day7 = calculWorkingDay(time7);
        if(time7 != null)
            document.getElementById("workingtime7").value = time7;
    })

    $("#startauto").change(function()
    {
        var startauto = document.getElementById("startauto").value;
        startauto = splitformatTime(startauto);
        startauto = formatTime(startauto);
        document.getElementById("startauto").value = startauto;
    })

    $("#breakauto").change(function()
    {
        var breakauto = document.getElementById("breakauto").value;
        breakauto = splitformatTime(breakauto);
        breakauto = formatTime(breakauto);
        document.getElementById("breakauto").value = breakauto;
    })

    $("#endauto").change(function()
    {
        var endauto = document.getElementById("endauto").value;
        endauto = splitformatTime(endauto);
        endauto = formatTime(endauto);
        document.getElementById("endauto").value = endauto;
    })


    $("#saisie_auto").click(function()
    {
    	var check = 'check_1;check_2;check_3;check_4;check_5;check_6;check_7';
    	var jour = '1;2;3;4;5;6;7';
    	check = check.split(';');
    	jour = jour.split(';');
    	var boucle = 0;
    	while(boucle < 7)
    	{
    		if(document.getElementById(check[boucle]).checked == true)
    		{
    			document.getElementById('start'+jour[boucle]).value = document.getElementById('debutauto').value;
    			document.getElementById('end'+jour[boucle]).value = document.getElementById('finauto').value;
    			document.getElementById('break'+jour[boucle]).value = document.getElementById('pauseauto').value;
    		}
    		boucle++;
    	}
    })

});

function saisie_auto()
{
	var check = 'check_1;check_2;check_3;check_4;check_5;check_6;check_7';
	var jour = '1;2;3;4;5;6;7';
	check = check.split(';');
	jour = jour.split(';');
	var boucle = 0;
	while(boucle < 7)
	{
		if(document.getElementById(check[boucle]).checked == true)
		{
			document.getElementById('start'+jour[boucle]).value = document.getElementById('debutauto').value;
			document.getElementById('end'+jour[boucle]).value = document.getElementById('finauto').value;
			document.getElementById('break'+jour[boucle]).value = document.getElementById('pauseauto').value;
		}
		boucle++;
	}
}

function calculWorkingTime(debut, fin, pause)
{
    if(debut == "" && fin == "" && pause == "")
	    return "0:00";
	if(debut == "00:00" && fin == "00:00" && pause == "00:00")
		return "0:00";
	if(debut == "0:00" && fin == "0:00" && pause == "0:00")
		return "0:00";
    if(debut == "" || fin == "" || pause == "")
        return null;
	else
	{
		if(fin == "")
			fin = "24:00";
		if(fin == "0:00")
			fin = "24:00";
		if(fin == "00:00")
			fin = "24:00";
		var timestart = Hour_to_Second(debut);
		var timeend = Hour_to_Second(fin);
		var timebreak = Hour_to_Second(pause);

		var worktime = timeend-timestart;
		worktime = worktime-timebreak;
		if(worktime < 0)
		    return Second_to_Hour(0);
        if(isNaN(worktime) == true)
            return null;
        else
		    return Second_to_Hour(worktime);
    }
}

function calculWorkingDay(worktime)// Calcul de la journée de travail
{
	if(worktime == "00:00" || worktime == "0:00")
		return 0;
    if(worktime == null || worktime == "")
        return null;
	var timeday = Hour_to_Second(worktime);
	if(timeday <= 0)
		timeday = "0";
	if(timeday > 0 && timeday <= 12600)
		timeday = "0.5";
	if(timeday > 12600)
		timeday = 1;
	return timeday;
}

function Hour_to_Second(time)// Transformation d'un temps en H:M en seconde
{
	var timesec = time.split(':');
	var sec = 3600*timesec[0] + 60*timesec[1];
	return sec;
}

function Second_to_Hour(time)// Transformation d'un temps en seconde en H:M:S
{
	var ss = time % 60;
	var m = (time - ss) / 60;
	var mm = m % 60;
    var hh = (m - mm) / 60;
	if(ss=='0')
		ss = '00';
	if(mm == '0')
		mm = '00';
	if(mm < 10 && mm > 0)
		mm = '0'+mm;
	var restime = hh+':'+mm;
	return restime;
}

function formatTime(time)
{
    var value = time;
    if(time.length == 4)
    {
        value = time.substr(0, 2) +':'+ time.substr(2, 2);
        return value;
    }
    if(time.length == 3)
    {
        value = time.substr(0, 1) +':'+ time.substr(1, 2);
        return value;
    }
    else
        return value;
}

function splitformatTime(time)
{
    var value = time.split(':');
    if(value.length == 2)
    {
        value = value[0] + value[1];
        return value;
    }
    else
        return time;
}

function visibilityAbsenceTime(absence, jour)
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