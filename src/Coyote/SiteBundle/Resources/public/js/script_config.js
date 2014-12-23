function myFunction(designation, prix)
{
    //alert(document.getElementById("cuve").value);
    var data = document.forms[0].cuve;
    var txt = "";
    var i;
    for(i=0;i<data.length;i++)
    {
        if(data[i].checked)
        {
            txt = txt + data[i].value + " ";
        }
    }
    var datapanier = document.getElementById("panier").value;
     
    document.getElementById("panier").value = txt + " " + designation + " " + prix + "€\n";
    
}

$(document).ready(function()
{
    $("#cuve").change(function()
    {
        //var data = document.getElementById("cuve").value;
        /*var data = document.forms[0].cuve;
        var txt = "";
        var i;
        for(i=0;i<data.length;i++)
        {
            if(data[i].checked)
            {
                txt = txt + data[i].value + " ";
            }
        }*/
        //alert(txt);
        /*var startlundi = document.getElementById("debutlundi").value;
        var endlundi = document.getElementById("finlundi").value;
        var breaklundi = document.getElementById("pauselundi").value;
        
        var timelundi = calculWorkingTime(startlundi, endlundi, breaklundi);
        var daylundi = calculWorkingDay(timelundi);
        if(timelundi != null)
            document.getElementById("tpslundi").value = timelundi;
        if(daylundi != null)
            document.getElementById("jourlundi").value = daylundi;*/
    })
    
        
    /*$("#cuve").checked(function()
    {
        var data = document.getElementById("cuve").value;
        alert(data);
        
    })*/
    /*$("#saisie_auto").click(function()
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
    })*/

});