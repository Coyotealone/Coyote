$(document).ready(function()
{
    $("#debutlundi").change(function()
    {
        var startlundi = document.getElementById("debutlundi").value;
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
        var endmardi = document.getElementById("finmardi").value;
        var breakmardi = document.getElementById("pausemardi").value;
        
        var timemardi = calculWorkingTime(startmardi, endmardi, breakmardi);
        var daymardi = calculWorkingDay(timemardi);
        if(timemardi != null)
            document.getElementById("tpsmardi").value = timemardi;
        if(daymardi != null)
            document.getElementById("jourmardi").value = daymardi;
    })
    
    $("#pausemardi").change(function()
    {
        var startmardi = document.getElementById("debutmardi").value;
        var endmardi = document.getElementById("finmardi").value;
        var breakmardi = document.getElementById("pausemardi").value;
        
        var timemardi = calculWorkingTime(startmardi, endmardi, breakmardi);
        var daymardi = calculWorkingDay(timemardi);
        if(timemardi != null)
            document.getElementById("tpsmardi").value = timemardi;
        if(daymardi != null)
            document.getElementById("jourmardi").value = daymardi;
    })
    
    $("#finmardi").change(function()
    {
        var startmardi = document.getElementById("debutmardi").value;
        var endmardi = document.getElementById("finmardi").value;
        var breakmardi = document.getElementById("pausemardi").value;
        
        var timemardi = calculWorkingTime(startmardi, endmardi, breakmardi);
        var daymardi = calculWorkingDay(timemardi);
        if(timemardi != null)
            document.getElementById("tpsmardi").value = timemardi;
        if(daymardi != null)
            document.getElementById("jourmardi").value = daymardi;
    })
    
    
    $("#debutmercredi").change(function()
    {
        var startmercredi = document.getElementById("debutmercredi").value;
        var endmercredi = document.getElementById("finmercredi").value;
        var breakmercredi = document.getElementById("pausemercredi").value;
        
        var timemercredi = calculWorkingTime(startmercredi, endmercredi, breakmercredi);
        var daymercredi = calculWorkingDay(timemercredi);
        if(timemercredi != null)
            document.getElementById("tpsmercredi").value = timemercredi;
        if(daymercredi != null)
            document.getElementById("jourmercredi").value = daymercredi;
    })
    
    $("#pausemercredi").change(function()
    {
        var startmercredi = document.getElementById("debutmercredi").value;
        var endmercredi = document.getElementById("finmercredi").value;
        var breakmercredi = document.getElementById("pausemercredi").value;
        
        var timemercredi = calculWorkingTime(startmercredi, endmercredi, breakmercredi);
        var daymercredi = calculWorkingDay(timemercredi);
        if(timemercredi != null)
            document.getElementById("tpsmercredi").value = timemercredi;
        if(daymercredi != null)
            document.getElementById("jourmercredi").value = daymercredi;
    })
    
    $("#finmercredi").change(function()
    {
        var startmercredi = document.getElementById("debutmercredi").value;
        var endmercredi = document.getElementById("finmercredi").value;
        var breakmercredi = document.getElementById("pausemercredi").value;
        
        var timemercredi = calculWorkingTime(startmercredi, endmercredi, breakmercredi);
        var daymercredi = calculWorkingDay(timemercredi);
        if(timemercredi != null)
            document.getElementById("tpsmercredi").value = timemercredi;
        if(daymercredi != null)
            document.getElementById("jourmercredi").value = daymercredi;
    })
    
    
    $("#debutjeudi").change(function()
    {
        var startjeudi = document.getElementById("debutjeudi").value;
        var endjeudi = document.getElementById("finjeudi").value;
        var breakjeudi = document.getElementById("pausejeudi").value;
        
        var timejeudi = calculWorkingTime(startjeudi, endjeudi, breakjeudi);
        var dayjeudi = calculWorkingDay(timejeudi);
        if(timejeudi != null)
            document.getElementById("tpsjeudi").value = timejeudi;
        if(dayjeudi != null)
            document.getElementById("jourjeudi").value = dayjeudi;
    })
    
    $("#pausejeudi").change(function()
    {
        var startjeudi = document.getElementById("debutjeudi").value;
        var endjeudi = document.getElementById("finjeudi").value;
        var breakjeudi = document.getElementById("pausejeudi").value;
        
        var timejeudi = calculWorkingTime(startjeudi, endjeudi, breakjeudi);
        var dayjeudi = calculWorkingDay(timejeudi);
        if(timejeudi != null)
            document.getElementById("tpsjeudi").value = timejeudi;
        if(dayjeudi != null)
            document.getElementById("jourjeudi").value = dayjeudi;
    })
    
    $("#finjeudi").change(function()
    {
        var startjeudi = document.getElementById("debutjeudi").value;
        var endjeudi = document.getElementById("finjeudi").value;
        var breakjeudi = document.getElementById("pausejeudi").value;
        
        var timejeudi = calculWorkingTime(startjeudi, endjeudi, breakjeudi);
        var dayjeudi = calculWorkingDay(timejeudi);
        if(timejeudi != null)
            document.getElementById("tpsjeudi").value = timejeudi;
        if(dayjeudi != null)
            document.getElementById("jourjeudi").value = dayjeudi;
    })
    
    
    $("#debutvendredi").change(function()
    {
        var startvendredi = document.getElementById("debutvendredi").value;
        var endvendredi = document.getElementById("finvendredi").value;
        var breakvendredi = document.getElementById("pausevendredi").value;
        
        var timevendredi = calculWorkingTime(startvendredi, endvendredi, breakvendredi);
        var dayvendredi = calculWorkingDay(timevendredi);
        if(timevendredi != null)
            document.getElementById("tpsvendredi").value = timevendredi;
        if(dayvendredi != null)
            document.getElementById("jourvendredi").value = dayvendredi;
    })
    
    $("#pausevendredi").change(function()
    {
        var startvendredi = document.getElementById("debutvendredi").value;
        var endvendredi = document.getElementById("finvendredi").value;
        var breakvendredi = document.getElementById("pausevendredi").value;
        
        var timevendredi = calculWorkingTime(startvendredi, endvendredi, breakvendredi);
        var dayvendredi = calculWorkingDay(timevendredi);
        if(timevendredi != null)
            document.getElementById("tpsvendredi").value = timevendredi;
        if(dayvendredi != null)
            document.getElementById("jourvendredi").value = dayvendredi;
    })
    
    $("#finvendredi").change(function()
    {
        var startvendredi = document.getElementById("debutvendredi").value;
        var endvendredi = document.getElementById("finvendredi").value;
        var breakvendredi = document.getElementById("pausevendredi").value;
        
        var timevendredi = calculWorkingTime(startvendredi, endvendredi, breakvendredi);
        var dayvendredi = calculWorkingDay(timevendredi);
        if(timevendredi != null)
            document.getElementById("tpsvendredi").value = timevendredi;
        if(dayvendredi != null)
            document.getElementById("jourvendredi").value = dayvendredi;
    })
    
    
    $("#debutsamedi").change(function()
    {
        var startsamedi = document.getElementById("debutsamedi").value;
        var endsamedi = document.getElementById("finsamedi").value;
        var breaksamedi = document.getElementById("pausesamedi").value;
        
        var timesamedi = calculWorkingTime(startsamedi, endsamedi, breaksamedi);
        var daysamedi = calculWorkingDay(timesamedi);
        if(timesamedi != null)
            document.getElementById("tpssamedi").value = timesamedi;
        if(daysamedi != null)
            document.getElementById("joursamedi").value = daysamedi;
    })
    
    $("#pausesamedi").change(function()
    {
        var startsamedi = document.getElementById("debutsamedi").value;
        var endsamedi = document.getElementById("finsamedi").value;
        var breaksamedi = document.getElementById("pausesamedi").value;
        
        var timesamedi = calculWorkingTime(startsamedi, endsamedi, breaksamedi);
        var daysamedi = calculWorkingDay(timesamedi);
        if(timesamedi != null)
            document.getElementById("tpssamedi").value = timesamedi;
        if(daysamedi != null)
            document.getElementById("joursamedi").value = daysamedi;
    })
    
    $("#finsamedi").change(function()
    {
        var startsamedi = document.getElementById("debutsamedi").value;
        var endsamedi = document.getElementById("finsamedi").value;
        var breaksamedi = document.getElementById("pausesamedi").value;
        
        var timesamedi = calculWorkingTime(startsamedi, endsamedi, breaksamedi);
        var daysamedi = calculWorkingDay(timesamedi);
        if(timesamedi != null)
            document.getElementById("tpssamedi").value = timesamedi;
        if(daysamedi != null)
            document.getElementById("joursamedi").value = daysamedi;
    })
    
    
    $("#debutdimanche").change(function()
    {
        var startdimanche = document.getElementById("debutdimanche").value;
        var enddimanche = document.getElementById("findimanche").value;
        var breakdimanche = document.getElementById("pausedimanche").value;
        
        var timedimanche = calculWorkingTime(startdimanche, enddimanche, breakdimanche);
        var daydimanche = calculWorkingDay(timedimanche);
        if(timedimanche != null)
            document.getElementById("tpsdimanche").value = timedimanche;
        if(daydimanche != null)
            document.getElementById("jourdimanche").value = daydimanche;
    })
    
    $("#pausedimanche").change(function()
    {
        var startdimanche = document.getElementById("debutdimanche").value;
        var enddimanche = document.getElementById("findimanche").value;
        var breakdimanche = document.getElementById("pausedimanche").value;
        
        var timedimanche = calculWorkingTime(startdimanche, enddimanche, breakdimanche);
        var daydimanche = calculWorkingDay(timedimanche);
        if(timedimanche != null)
            document.getElementById("tpsdimanche").value = timedimanche;
        if(daydimanche != null)
            document.getElementById("jourdimanche").value = daydimanche;
    })
    
    $("#findimanche").change(function()
    {
        var startdimanche = document.getElementById("debutdimanche").value;
        var enddimanche = document.getElementById("findimanche").value;
        var breakdimanche = document.getElementById("pausedimanche").value;
        
        var timedimanche = calculWorkingTime(startdimanche, enddimanche, breakdimanche);
        var daydimanche = calculWorkingDay(timedimanche);
        if(timedimanche != null)
            document.getElementById("tpsdimanche").value = timedimanche;
        if(daydimanche != null)
            document.getElementById("jourdimanche").value = daydimanche;
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
