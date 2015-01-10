$(document).ready(function()
{
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

});

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
    }
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