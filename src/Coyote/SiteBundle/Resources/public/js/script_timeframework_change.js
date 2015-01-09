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