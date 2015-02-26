$(document).ready(function()
{
    $("#absence1").change(function()
    {
        var absencelundi = document.getElementById("absence1").value;
        visibilityAbsenceTime(absencelundi, "1");
    })

    $("#absence2").change(function()
    {
        var absencemardi = document.getElementById("absence2").value;
        visibilityAbsenceTime(absencemardi, "2");
    })

    $("#absence3").change(function()
    {
        var absencemercredi = document.getElementById("absence3").value;
        visibilityAbsenceTime(absencemercredi, "3");
    })

    $("#absence4").change(function()
    {
        var absencejeudi = document.getElementById("absence4").value;
        visibilityAbsenceTime(absencejeudi, "4");
    })

    $("#absence5").change(function()
    {
        var absencevendredi = document.getElementById("absence5").value;
        visibilityAbsenceTime(absencevendredi, "5");
    })

    $("#absence6").change(function()
    {
        var absencesamedi = document.getElementById("absence6").value;
        visibilityAbsenceTime(absencesamedi, "6");
    })

    $("#absence7").change(function()
    {
        var absencedimanche = document.getElementById("absence7").value;
        visibilityAbsenceTime(absencedimanche, "7");
    })

    $("#absencetime1").change(function()
    {
        var absencetimelundi = document.getElementById("absencetime1").value;
        absencetimelundi = splitformatTime(absencetimelundi);
        absencetimelundi = formatTime(absencetimelundi);
        document.getElementById("absencetime1").value = absencetimelundi;
        visibilityAbsenceTime(absencetimelundi, "1");
    })

    $("#absencetime2").change(function()
    {
        var absencetimemardi = document.getElementById("absencetime2").value;
        absencetimemardi = splitformatTime(absencetimemardi);
        absencetimemardi = formatTime(absencetimemardi);
        document.getElementById("absencetime2").value = absencetimemardi;
        visibilityAbsenceTime(absencetimemardi, "2");
    })

    $("#absencetime3").change(function()
    {
        var absencetimemercredi = document.getElementById("absencetime3").value;
        absencetimemercredi = splitformatTime(absencetimemercredi);
        absencetimemercredi = formatTime(absencetimemercredi);
        document.getElementById("absencetime3").value = absencetimemercredi;
        visibilityAbsenceTime(absencetimemercredi, "3");
    })

    $("#absencetime4").change(function()
    {
        var absencetimejeudi = document.getElementById("absencetime4").value;
        absencetimejeudi = splitformatTime(absencetimejeudi);
        absencetimejeudi = formatTime(absencetimejeudi);
        document.getElementById("absencetime4").value = absencetimejeudi;
        visibilityAbsenceTime(absencetimejeudi, "4");
    })

    $("#absencetime5").change(function()
    {
        var absencetimevendredi = document.getElementById("absencetime5").value;
        absencetimevendredi = splitformatTime(absencetimevendredi);
        absencetimevendredi = formatTime(absencetimevendredi);
        document.getElementById("absencetime5").value = absencetimevendredi;
        visibilityAbsenceTime(absencetimevendredi, "5");
    })

    $("#absencetime6").change(function()
    {
        var absencetimesamedi = document.getElementById("absencetime6").value;
        absencetimesamedi = splitformatTime(absencetimesamedi);
        absencetimesamedi = formatTime(absencetimesamedi);
        document.getElementById("absencetime6").value = absencetimesamedi;
        visibilityAbsenceTime(absencetimesamedi, "6");
    })

    $("#absencetime7").change(function()
    {
        var absencetimedimanche = document.getElementById("absencetime7").value;
        absencetimedimanche = splitformatTime(absencetimedimanche);
        absencetimedimanche = formatTime(absencetimedimanche);
        document.getElementById("absencetime7").value = absencetimedimanche;
        visibilityAbsenceTime(absencetimedimanche, "7");
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
		document.getElementById("absencetime"+jour).value = "";
		document.getElementById("absencetime"+jour).style.visibility = "visible";
    }
    if(absence == "Autre")
	{
    	document.getElementById("absence"+jour).selectedIndex = 8;
    	document.getElementById("absenceday"+jour).style.visibility = "hidden";
		document.getElementById("absencetime"+jour).value = "";
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