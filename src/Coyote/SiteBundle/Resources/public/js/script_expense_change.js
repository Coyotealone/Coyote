$(document).ready(function()
{
    $("#date0").change(function()
    {
        var date = document.getElementById("date0").value;
        if(/^([0-2][0-9]|[3][0-1])([0][1-9]|[1][0-2])([0-9]{2}){1}$/.test(date))
        {
    		var formatdate = '';
    		var tempdate = '';
    		document.getElementById('date0').style.backgroundColor = 'white';
    		tempdate = date.substr(0, 2);
    		formatdate = tempdate+'/';
    		tempdate = date.substr(2, 2);
    		formatdate = formatdate+tempdate+'/';
    		tempdate = date.substr(4, 2);
    		formatdate = formatdate+tempdate;
    		document.getElementById('date0').value = formatdate;
    	}   
    })
    
    $("#date1").change(function()
    {
        var date = document.getElementById("date1").value;
        if(/^([0-2][0-9]|[3][0-1])([0][1-9]|[1][0-2])([0-9]{2}){1}$/.test(date))
        {
    		var formatdate = '';
    		var tempdate = '';
    		document.getElementById('date1').style.backgroundColor = 'white';
    		tempdate = date.substr(0, 2);
    		formatdate = tempdate+'/';
    		tempdate = date.substr(2, 2);
    		formatdate = formatdate+tempdate+'/';
    		tempdate = date.substr(4, 2);
    		formatdate = formatdate+tempdate;
    		document.getElementById('date1').value = formatdate;
    	}   
    })
    
    $("#date2").change(function()
    {
        var date = document.getElementById("date2").value;
        if(/^([0-2][0-9]|[3][0-1])([0][1-9]|[1][0-2])([0-9]{2}){1}$/.test(date))
        {
    		var formatdate = '';
    		var tempdate = '';
    		document.getElementById('date2').style.backgroundColor = 'white';
    		tempdate = date.substr(0, 2);
    		formatdate = tempdate+'/';
    		tempdate = date.substr(2, 2);
    		formatdate = formatdate+tempdate+'/';
    		tempdate = date.substr(4, 2);
    		formatdate = formatdate+tempdate;
    		document.getElementById('date2').value = formatdate;
    	}   
    })
    
    $("#date3").change(function()
    {
        var date = document.getElementById("date3").value;
        if(/^([0-2][0-9]|[3][0-1])([0][1-9]|[1][0-2])([0-9]{2}){1}$/.test(date))
        {
    		var formatdate = '';
    		var tempdate = '';
    		document.getElementById('date3').style.backgroundColor = 'white';
    		tempdate = date.substr(0, 2);
    		formatdate = tempdate+'/';
    		tempdate = date.substr(2, 2);
    		formatdate = formatdate+tempdate+'/';
    		tempdate = date.substr(4, 2);
    		formatdate = formatdate+tempdate;
    		document.getElementById('date3').value = formatdate;
    	}   
    })
    
    $("#date4").change(function()
    {
        var date = document.getElementById("date4").value;
        if(/^([0-2][0-9]|[3][0-1])([0][1-9]|[1][0-2])([0-9]{2}){1}$/.test(date))
        {
    		var formatdate = '';
    		var tempdate = '';
    		document.getElementById('date4').style.backgroundColor = 'white';
    		tempdate = date.substr(0, 2);
    		formatdate = tempdate+'/';
    		tempdate = date.substr(2, 2);
    		formatdate = formatdate+tempdate+'/';
    		tempdate = date.substr(4, 2);
    		formatdate = formatdate+tempdate;
    		document.getElementById('date4').value = formatdate;
    	}   
    })
    
    $("#date5").change(function()
    {
        var date = document.getElementById("date5").value;
        if(/^([0-2][0-9]|[3][0-1])([0][1-9]|[1][0-2])([0-9]{2}){1}$/.test(date))
        {
    		var formatdate = '';
    		var tempdate = '';
    		document.getElementById('date5').style.backgroundColor = 'white';
    		tempdate = date.substr(0, 2);
    		formatdate = tempdate+'/';
    		tempdate = date.substr(2, 2);
    		formatdate = formatdate+tempdate+'/';
    		tempdate = date.substr(4, 2);
    		formatdate = formatdate+tempdate;
    		document.getElementById('date5').value = formatdate;
    	}   
    })

    
    $("#article0").change(function()
    {
        var rate = $("#article0 option:selected").data("value");
        var reel = document.getElementById("reel0").value;
        if(reel != null || reel != "")
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva0').value = montant;
        }
    })
    
    $("#reel0").change(function()
    {
        var reel = document.getElementById("reel0").value;
        var rate = $("#article0 option:selected").data("value");
        document.getElementById("ttc0").value = reel;
        if(rate != null)
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva0').value = montant;
        }
    })
    
    $("#article1").change(function()
    {
        var rate = $("#article1 option:selected").data("value");
        var reel = document.getElementById("reel1").value;
        if(reel != null || reel != "")
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva1').value = montant;
        }
    })
    
    $("#reel1").change(function()
    {
        var reel = document.getElementById("reel1").value;
        var rate = $("#article1 option:selected").data("value");
        document.getElementById("ttc1").value = reel;
        if(rate != null)
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva1').value = montant;
        }
    })
    
    $("#article2").change(function()
    {
        var rate = $("#article2 option:selected").data("value");
        var reel = document.getElementById("reel2").value;
        if(reel != null || reel != "")
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva2').value = montant;
        }
    })
    
    $("#reel2").change(function()
    {
        var reel = document.getElementById("reel2").value;
        var rate = $("#article2 option:selected").data("value");
        document.getElementById("ttc2").value = reel;
        if(rate != null)
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva2').value = montant;
        }
    })
    
    $("#article3").change(function()
    {
        var rate = $("#article3 option:selected").data("value");
        var reel = document.getElementById("reel3").value;
        if(reel != null || reel != "")
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva3').value = montant;
        }
    })
    
    $("#reel3").change(function()
    {
        var reel = document.getElementById("reel3").value;
        var rate = $("#article3 option:selected").data("value");
        document.getElementById("ttc3").value = reel;
        if(rate != null)
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva3').value = montant;
        }
    })
    
    $("#article4").change(function()
    {
        var rate = $("#article4 option:selected").data("value");
        var reel = document.getElementById("reel4").value;
        if(reel != null || reel != "")
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva4').value = montant;
        }
    })
    
    $("#reel4").change(function()
    {
        var reel = document.getElementById("reel4").value;
        var rate = $("#article4 option:selected").data("value");
        document.getElementById("ttc4").value = reel;
        if(rate != null)
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva4').value = montant;
        }
    })
    
    $("#article5").change(function()
    {
        var rate = $("#article5 option:selected").data("value");
        var reel = document.getElementById("reel5").value;
        if(reel != null || reel != "")
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva5').value = montant;
        }
    })
    
    $("#reel5").change(function()
    {
        var reel = document.getElementById("reel5").value;
        var rate = $("#article5 option:selected").data("value");
        document.getElementById("ttc5").value = reel;
        if(rate != null)
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('tva5').value = montant;
        }
    })
    
});

function calculTVA(montant, taux)
{
    var montantsansTVA = null;
    var montantTVA = null;
    
    if(taux  == '0')
    	return 0;
    	
    if(taux == '5.5')
    {	
    	taux = taux + 100;
    	montantsansTVA = montant * 100 / taux;
    	montantTVA = montant - montantsansTVA;
    	return montantTVA.toFixed(2);
    }
    if(taux == '10')
    {	
    	taux = taux + 100;
    	montantsansTVA = $montant * 100 / taux;
    	montantTVA = montant - montantsansTVA;
    	return montantTVA.toFixed(2);
    }
    if(taux == '20')
    {	
    	taux = taux + 100;
    	montantsansTVA = montant * 100 / taux;
    	montantTVA = montant - montantsansTVA;
    	return montantTVA.toFixed(2);
    }
}
