$(document).ready(function()
{
    //document.getElementById("absencedayselectlundi").style.visibility = "hidden";
    //document.getElementById("absencedayinputlundi").style.visibility = "hidden";
    $("#absencelundi").change(function()
    {
        var absencelundi = document.getElementById("absencelundi").value;
        visibilityAbsenceTime(absencelundi, "lundi");
    })

    $("#absencemardi").change(function()
    {
        var absencemardi = document.getElementById("absencemardi").value;
        visibilityAbsenceTime(absencemardi, "mardi");
    })

    $("#absencemercredi").change(function()
    {
        var absencemercredi = document.getElementById("absencemercredi").value;
        visibilityAbsenceTime(absencemercredi, "mercredi");
    })

    $("#absencejeudi").change(function()
    {
        var absencejeudi = document.getElementById("absencejeudi").value;
        visibilityAbsenceTime(absencejeudi, "jeudi");
    })

    $("#absencevendredi").change(function()
    {
        var absencevendredi = document.getElementById("absencevendredi").value;
        visibilityAbsenceTime(absencevendredi, "vendredi");
    })

    $("#absencesamedi").change(function()
    {
        var absencesamedi = document.getElementById("absencesamedi").value;
        visibilityAbsenceTime(absencesamedi, "samedi");
    })

    $("#absencedimanche").change(function()
    {
        var absencedimanche = document.getElementById("absencedimanche").value;
        visibilityAbsenceTime(absencedimanche, "dimanche");
    })

    $("#absencetimelundi").change(function()
    {
        var absencetimelundi = document.getElementById("absencetimelundi").value;
        absencetimelundi = splitformatTime(absencetimelundi);
        absencetimelundi = formatTime(absencetimelundi);
        document.getElementById("absencetimelundi").value = absencetimelundi;
        visibilityAbsenceTime(absencetimelundi, "lundi");
    })

    $("#absencetimemardi").change(function()
    {
        var absencetimemardi = document.getElementById("absencetimemardi").value;
        absencetimemardi = splitformatTime(absencetimemardi);
        absencetimemardi = formatTime(absencetimemardi);
        visibilityAbsenceTime(absencetimemardi, "mardi");
    })

    $("#absencetimemercredi").change(function()
    {
        var absencetimemercredi = document.getElementById("absencetimemercredi").value;
        absencetimemercredi = splitformatTime(absencetimemercredi);
        absencetimemercredi = formatTime(absencetimemercredi);
        visibilityAbsenceTime(absencetimemercredi, "mercredi");
    })

    $("#absencetimejeudi").change(function()
    {
        var absencetimejeudi = document.getElementById("absencetimejeudi").value;
        absencetimejeudi = splitformatTime(absencetimejeudi);
        absencetimejeudi = formatTime(absencetimejeudi);
        visibilityAbsenceTime(absencetimejeudi, "jeudi");
    })

    $("#absencetimevendredi").change(function()
    {
        var absencetimevendredi = document.getElementById("absencetimevendredi").value;
        absencetimevendredi = splitformatTime(absencetimevendredi);
        absencetimevendredi = formatTime(absencetimevendredi);
        visibilityAbsenceTime(absencetimevendredi, "vendredi");
    })

    $("#absencetimesamedi").change(function()
    {
        var absencetimesamedi = document.getElementById("absencetimesamedi").value;
        absencetimesamedi = splitformatTime(absencetimesamedi);
        absencetimesamedi = formatTime(absencetimesamedi);
        visibilityAbsenceTime(absencetimesamedi, "samedi");
    })

    $("#absencetimedimanche").change(function()
    {
        var absencetimedimanche = document.getElementById("absencetimedimanche").value;
        absencetimedimanche = splitformatTime(absencetimedimanche);
        absencetimedimanche = formatTime(absencetimedimanche);
        visibilityAbsenceTime(absencetimedimanche, "dimanche");
    })

    $("#debutlundi").change(function()
    {
        var startlundi = document.getElementById("debutlundi").value;
        startlundi = splitformatTime(startlundi);
        startlundi = formatTime(startlundi);
        document.getElementById("debutlundi").value = startlundi;
        var endlundi = document.getElementById("finlundi").value;
        var breaklundi = document.getElementById("pauselundi").value;

        var timelundi = calculWorkingTime(startlundi, endlundi, breaklundi);
        var daylundi = calculWorkingDay(timelundi);
        if(timelundi != null)
            document.getElementById("tpslundi").value = timelundi;
        if(daylundi != null)
            document.getElementById("jourlundi").value = daylundi;
    })

    $("#pauselundi").change(function()
    {
        var startlundi = document.getElementById("debutlundi").value;
        var endlundi = document.getElementById("finlundi").value;
        var breaklundi = document.getElementById("pauselundi").value;
        breaklundi = splitformatTime(breaklundi);
        breaklundi = formatTime(breaklundi);
        document.getElementById("pauselundi").value = breaklundi;

        var timelundi = calculWorkingTime(startlundi, endlundi, breaklundi);
        var daylundi = calculWorkingDay(timelundi);
        if(timelundi != null)
            document.getElementById("tpslundi").value = timelundi;
        if(daylundi != null)
            document.getElementById("jourlundi").value = daylundi;
    })

    $("#finlundi").change(function()
    {
        var startlundi = document.getElementById("debutlundi").value;
        var endlundi = document.getElementById("finlundi").value;
        endlundi = splitformatTime(endlundi);
        endlundi = formatTime(endlundi);
        document.getElementById("finlundi").value = endlundi;
        var breaklundi = document.getElementById("pauselundi").value;

        var timelundi = calculWorkingTime(startlundi, endlundi, breaklundi);
        var daylundi = calculWorkingDay(timelundi);
        if(timelundi != null)
            document.getElementById("tpslundi").value = timelundi;
        if(daylundi != null)
            document.getElementById("jourlundi").value = daylundi;
    })


    $("#debutmardi").change(function()
    {
        var startmardi = document.getElementById("debutmardi").value;
        startmardi = splitformatTime(startmardi);
        startmardi = formatTime(startmardi);
        document.getElementById("debutmardi").value = startmardi;
        var endmardi = document.getElementById("finmardi").value;
        var breakmardi = document.getElementById("pausemardi").value;

        var timemardi = calculWorkingTime(startmardi, endmardi, breakmardi);
        var daymardi = calculWorkingDay(timemardi);
        if(timemardi != null)
            document.getElementById("tpsmardi").value = timemardi;
    })

    $("#pausemardi").change(function()
    {
        var startmardi = document.getElementById("debutmardi").value;
        var endmardi = document.getElementById("finmardi").value;
        var breakmardi = document.getElementById("pausemardi").value;
        breakmardi = splitformatTime(breakmardi);
        breakmardi = formatTime(breakmardi);
        document.getElementById("pausemardi").value = breakmardi;

        var timemardi = calculWorkingTime(startmardi, endmardi, breakmardi);
        var daymardi = calculWorkingDay(timemardi);
        if(timemardi != null)
            document.getElementById("tpsmardi").value = timemardi;
    })

    $("#finmardi").change(function()
    {
        var startmardi = document.getElementById("debutmardi").value;
        var endmardi = document.getElementById("finmardi").value;
        endmardi = splitformatTime(endmardi);
        endmardi = formatTime(endmardi);
        document.getElementById("finmardi").value = endmardi;
        var breakmardi = document.getElementById("pausemardi").value;

        var timemardi = calculWorkingTime(startmardi, endmardi, breakmardi);
        var daymardi = calculWorkingDay(timemardi);
        if(timemardi != null)
            document.getElementById("tpsmardi").value = timemardi;
    })


    $("#debutmercredi").change(function()
    {
        var startmercredi = document.getElementById("debutmercredi").value;
        startmercredi = splitformatTime(startmercredi);
        startmercredi = formatTime(startmercredi);
        document.getElementById("debutmercredi").value = startmercredi;
        var endmercredi = document.getElementById("finmercredi").value;
        var breakmercredi = document.getElementById("pausemercredi").value;

        var timemercredi = calculWorkingTime(startmercredi, endmercredi, breakmercredi);
        var daymercredi = calculWorkingDay(timemercredi);
        if(timemercredi != null)
            document.getElementById("tpsmercredi").value = timemercredi;
    })

    $("#pausemercredi").change(function()
    {
        var startmercredi = document.getElementById("debutmercredi").value;
        var endmercredi = document.getElementById("finmercredi").value;
        var breakmercredi = document.getElementById("pausemercredi").value;
        breakmercredi = splitformatTime(breakmercredi);
        breakmercredi = formatTime(breakmercredi);
        document.getElementById("pausemercredi").value = breakmercredi;

        var timemercredi = calculWorkingTime(startmercredi, endmercredi, breakmercredi);
        var daymercredi = calculWorkingDay(timemercredi);
        if(timemercredi != null)
            document.getElementById("tpsmercredi").value = timemercredi;
    })

    $("#finmercredi").change(function()
    {
        var startmercredi = document.getElementById("debutmercredi").value;
        var endmercredi = document.getElementById("finmercredi").value;
        endmercredi = splitformatTime(endmercredi);
        endmercredi = formatTime(endmercredi);
        document.getElementById("finmercredi").value = endmercredi;
        var breakmercredi = document.getElementById("pausemercredi").value;

        var timemercredi = calculWorkingTime(startmercredi, endmercredi, breakmercredi);
        var daymercredi = calculWorkingDay(timemercredi);
        if(timemercredi != null)
            document.getElementById("tpsmercredi").value = timemercredi;
    })


    $("#debutjeudi").change(function()
    {
        var startjeudi = document.getElementById("debutjeudi").value;
        startjeudi = splitformatTime(startjeudi);
        startjeudi = formatTime(startjeudi);
        document.getElementById("debutjeudi").value = startjeudi;
        var endjeudi = document.getElementById("finjeudi").value;
        var breakjeudi = document.getElementById("pausejeudi").value;

        var timejeudi = calculWorkingTime(startjeudi, endjeudi, breakjeudi);
        var dayjeudi = calculWorkingDay(timejeudi);
        if(timejeudi != null)
            document.getElementById("tpsjeudi").value = timejeudi;
    })

    $("#pausejeudi").change(function()
    {
        var startjeudi = document.getElementById("debutjeudi").value;
        var endjeudi = document.getElementById("finjeudi").value;
        var breakjeudi = document.getElementById("pausejeudi").value;
        breakjeudi = splitformatTime(breakjeudi);
        breakjeudi = formatTime(breakjeudi);
        document.getElementById("pausejeudi").value = breakjeudi;

        var timejeudi = calculWorkingTime(startjeudi, endjeudi, breakjeudi);
        var dayjeudi = calculWorkingDay(timejeudi);
        if(timejeudi != null)
            document.getElementById("tpsjeudi").value = timejeudi;
    })

    $("#finjeudi").change(function()
    {
        var startjeudi = document.getElementById("debutjeudi").value;
        var endjeudi = document.getElementById("finjeudi").value;
        endjeudi = splitformatTime(endjeudi);
        endjeudi = formatTime(endjeudi);
        document.getElementById("finjeudi").value = endjeudi;
        var breakjeudi = document.getElementById("pausejeudi").value;

        var timejeudi = calculWorkingTime(startjeudi, endjeudi, breakjeudi);
        var dayjeudi = calculWorkingDay(timejeudi);
        if(timejeudi != null)
            document.getElementById("tpsjeudi").value = timejeudi;
    })


    $("#debutvendredi").change(function()
    {
        var startvendredi = document.getElementById("debutvendredi").value;
        startvendredi = splitformatTime(startvendredi);
        startvendredi = formatTime(startvendredi);
        document.getElementById("debutvendredi").value = startvendredi;
        var endvendredi = document.getElementById("finvendredi").value;
        var breakvendredi = document.getElementById("pausevendredi").value;

        var timevendredi = calculWorkingTime(startvendredi, endvendredi, breakvendredi);
        var dayvendredi = calculWorkingDay(timevendredi);
        if(timevendredi != null)
            document.getElementById("tpsvendredi").value = timevendredi;
    })

    $("#pausevendredi").change(function()
    {
        var startvendredi = document.getElementById("debutvendredi").value;
        var endvendredi = document.getElementById("finvendredi").value;
        var breakvendredi = document.getElementById("pausevendredi").value;
        breakvendredi = splitformatTime(breakvendredi);
        breakvendredi = formatTime(breakvendredi);
        document.getElementById("pausevendredi").value = breakvendredi;

        var timevendredi = calculWorkingTime(startvendredi, endvendredi, breakvendredi);
        var dayvendredi = calculWorkingDay(timevendredi);
        if(timevendredi != null)
            document.getElementById("tpsvendredi").value = timevendredi;
    })

    $("#finvendredi").change(function()
    {
        var startvendredi = document.getElementById("debutvendredi").value;
        var endvendredi = document.getElementById("finvendredi").value;
        endvendredi = splitformatTime(endvendredi);
        endvendredi = formatTime(endvendredi);
        document.getElementById("finvendredi").value = endvendredi;
        var breakvendredi = document.getElementById("pausevendredi").value;

        var timevendredi = calculWorkingTime(startvendredi, endvendredi, breakvendredi);
        var dayvendredi = calculWorkingDay(timevendredi);
        if(timevendredi != null)
            document.getElementById("tpsvendredi").value = timevendredi;
    })


    $("#debutsamedi").change(function()
    {
        var startsamedi = document.getElementById("debutsamedi").value;
        startsamedi = splitformatTime(startsamedi);
        startsamedi = formatTime(startsamedi);
        document.getElementById("debutsamedi").value = startsamedi;
        var endsamedi = document.getElementById("finsamedi").value;
        var breaksamedi = document.getElementById("pausesamedi").value;

        var timesamedi = calculWorkingTime(startsamedi, endsamedi, breaksamedi);
        var daysamedi = calculWorkingDay(timesamedi);
        if(timesamedi != null)
            document.getElementById("tpssamedi").value = timesamedi;
    })

    $("#pausesamedi").change(function()
    {
        var startsamedi = document.getElementById("debutsamedi").value;
        var endsamedi = document.getElementById("finsamedi").value;
        var breaksamedi = document.getElementById("pausesamedi").value;
        breaksamedi = splitformatTime(breaksamedi);
        breaksamedi = formatTime(breaksamedi);
        document.getElementById("pausesamedi").value = breaksamedi;

        var timesamedi = calculWorkingTime(startsamedi, endsamedi, breaksamedi);
        var daysamedi = calculWorkingDay(timesamedi);
        if(timesamedi != null)
            document.getElementById("tpssamedi").value = timesamedi;
    })

    $("#finsamedi").change(function()
    {
        var startsamedi = document.getElementById("debutsamedi").value;
        var endsamedi = document.getElementById("finsamedi").value;
        endsamedi = splitformatTime(endsamedi);
        endsamedi = formatTime(endsamedi);
        document.getElementById("finsamedi").value = endsamedi;
        var breaksamedi = document.getElementById("pausesamedi").value;

        var timesamedi = calculWorkingTime(startsamedi, endsamedi, breaksamedi);
        var daysamedi = calculWorkingDay(timesamedi);
        if(timesamedi != null)
            document.getElementById("tpssamedi").value = timesamedi;
    })


    $("#debutdimanche").change(function()
    {
        var startdimanche = document.getElementById("debutdimanche").value;
        startdimanche = splitformatTime(startdimanche);
        startdimanche = formatTime(startdimanche);
        document.getElementById("debutdimanche").value = startdimanche;
        var enddimanche = document.getElementById("findimanche").value;
        var breakdimanche = document.getElementById("pausedimanche").value;

        var timedimanche = calculWorkingTime(startdimanche, enddimanche, breakdimanche);
        var daydimanche = calculWorkingDay(timedimanche);
        if(timedimanche != null)
            document.getElementById("tpsdimanche").value = timedimanche;
    })

    $("#pausedimanche").change(function()
    {
        var startdimanche = document.getElementById("debutdimanche").value;
        var enddimanche = document.getElementById("findimanche").value;
        var breakdimanche = document.getElementById("pausedimanche").value;
        breakdimanche = splitformatTime(breakdimanche);
        breakdimanche = formatTime(breakdimanche);
        document.getElementById("pausedimanche").value = breakdimanche;

        var timedimanche = calculWorkingTime(startdimanche, enddimanche, breakdimanche);
        var daydimanche = calculWorkingDay(timedimanche);
        if(timedimanche != null)
            document.getElementById("tpsdimanche").value = timedimanche;
    })

    $("#findimanche").change(function()
    {
        var startdimanche = document.getElementById("debutdimanche").value;
        var enddimanche = document.getElementById("findimanche").value;
        enddimanche = splitformatTime(enddimanche);
        enddimanche = formatTime(enddimanche);
        document.getElementById("findimanche").value = enddimanche;
        var breakdimanche = document.getElementById("pausedimanche").value;

        var timedimanche = calculWorkingTime(startdimanche, enddimanche, breakdimanche);
        var daydimanche = calculWorkingDay(timedimanche);
        if(timedimanche != null)
            document.getElementById("tpsdimanche").value = timedimanche;
    })

    $("#debutauto").change(function()
    {
        var startauto = document.getElementById("debutauto").value;
        startauto = splitformatTime(startauto);
        startauto = formatTime(startauto);
        document.getElementById("debutauto").value = startauto;
    })

    $("#pauseauto").change(function()
    {
        var breakauto = document.getElementById("pauseauto").value;
        breakauto = splitformatTime(breakauto);
        breakauto = formatTime(breakauto);
        document.getElementById("pauseauto").value = breakauto;
    })

    $("#finauto").change(function()
    {
        var endauto = document.getElementById("finauto").value;
        endauto = splitformatTime(endauto);
        endauto = formatTime(endauto);
        document.getElementById("finauto").value = endauto;
    })


    $("#saisie_auto").click(function()
    {
    	var check = 'check_lundi;check_mardi;check_mercredi;check_jeudi;check_vendredi;check_samedi;check_dimanche';
    	var jour = 'lundi;mardi;mercredi;jeudi;vendredi;samedi;dimanche';
    	check = check.split(';');
    	jour = jour.split(';');
    	var boucle = 0;
    	while(boucle < 7)
    	{
    		if(document.getElementById(check[boucle]).checked == true)
    		{
    			document.getElementById('debut'+jour[boucle]).value = document.getElementById('debutauto').value;
    			document.getElementById('fin'+jour[boucle]).value = document.getElementById('finauto').value;
    			document.getElementById('pause'+jour[boucle]).value = document.getElementById('pauseauto').value;
    		}
    		boucle++;
    	}
    })

});

function saisie_auto()
{
	var check = 'check_lundi;check_mardi;check_mercredi;check_jeudi;check_vendredi;check_samedi;check_dimanche';
	var jour = 'lundi;mardi;mercredi;jeudi;vendredi;samedi;dimanche';
	check = check.split(';');
	jour = jour.split(';');
	var boucle = 0;
	while(boucle < 7)
	{
		if(document.getElementById(check[boucle]).checked == true)
		{
			document.getElementById('debut'+jour[boucle]).value = document.getElementById('debutauto').value;
			document.getElementById('fin'+jour[boucle]).value = document.getElementById('finauto').value;
			document.getElementById('pause'+jour[boucle]).value = document.getElementById('pauseauto').value;
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
	if(absence == "Maladie")
	{
    	document.getElementById("absence"+jour).selectedIndex = 5;
    	document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
    }
    if(absence == "AT")
	{
    	document.getElementById("absence"+jour).selectedIndex = 6;
    	document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
	}
	if(absence == "MP")
	{
    	document.getElementById("absence"+jour).selectedIndex = 7;
    	document.getElementById("absenceday"+jour).style.visibility = "visible";
		document.getElementById("absencetime"+jour).style.visibility = "hidden";
	}
	if(absence == "Recup")
	{
    	document.getElementById("absence"+jour).selectedIndex = 8;
    	document.getElementById("absenceday"+jour).style.visibility = "hidden";
		document.getElementById("absencetime"+jour).style.visibility = "visible";
		//document.getElementById("absencetime"+jour).value = "";
    }
}