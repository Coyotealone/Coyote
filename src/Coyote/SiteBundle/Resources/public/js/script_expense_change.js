$(document).ready(function()
{
    $("#date0").change(function()
    {
        var date = document.getElementById("date0").value;
        if(date.length < 6)
        {
            document.getElementById('date0').style.backgroundColor = 'red';
            document.getElementById('date0').style.color = 'white';
        }
        if(/\d{6}/.test(date))
        {
            document.getElementById('date0').style.backgroundColor = 'green';
            document.getElementById('date0').style.color = 'white';
        }
        else
        {
            document.getElementById('date0').style.backgroundColor = 'red';
            document.getElementById('date0').style.color = 'white';
        }
    })

    $("#date1").change(function()
    {
        var date = document.getElementById("date1").value;
        if(date.length < 6)
        {
            document.getElementById('date1').style.backgroundColor = 'red';
            document.getElementById('date1').style.color = 'white';
        }
        if(/\d{6}/.test(date))
        {
            document.getElementById('date1').style.backgroundColor = 'green';
            document.getElementById('date1').style.color = 'white';
        }
        else
        {
            document.getElementById('date1').style.backgroundColor = 'red';
            document.getElementById('date1').style.color = 'white';
        }
    })

    $("#date2").change(function()
    {
        var date = document.getElementById("date2").value;
        if(date.length < 6)
        {
            document.getElementById('date2').style.backgroundColor = 'red';
            document.getElementById('date2').style.color = 'white';
        }
        if(/\d{6}/.test(date))
        {
            document.getElementById('date2').style.backgroundColor = 'green';
            document.getElementById('date2').style.color = 'white';
        }
        else
        {
            document.getElementById('date2').style.backgroundColor = 'red';
            document.getElementById('date2').style.color = 'white';
        }
    })

    $("#date3").change(function()
    {
        var date = document.getElementById("date3").value;
        if(date.length < 6)
        {
            document.getElementById('date3').style.backgroundColor = 'red';
            document.getElementById('date3').style.color = 'white';
        }
        if(/\d{6}/.test(date))
        {
            document.getElementById('date3').style.backgroundColor = 'green';
            document.getElementById('date3').style.color = 'white';
        }
        else
        {
            document.getElementById('date3').style.backgroundColor = 'red';
            document.getElementById('date3').style.color = 'white';
        }
    })

    $("#date4").change(function()
    {
        var date = document.getElementById("date4").value;
        if(date.length < 6)
        {
            document.getElementById('date4').style.backgroundColor = 'red';
            document.getElementById('date4').style.color = 'white';
        }
        if(/\d{6}/.test(date))
        {
            document.getElementById('date4').style.backgroundColor = 'green';
            document.getElementById('date4').style.color = 'white';
        }
        else
        {
            document.getElementById('date4').style.backgroundColor = 'red';
            document.getElementById('date4').style.color = 'white';
        }
    })

    $("#date5").change(function()
    {
        var date = document.getElementById("date5").value;
        if(/^([0-2][0-9]|[3][0-1])([0][1-9]|[1][0-2])([0-9]{2}){1}$/.test(date))
        if(date.length < 6)
        {
            document.getElementById('date5').style.backgroundColor = 'red';
            document.getElementById('date5').style.color = 'white';
        }
        if(/\d{6}/.test(date))
        {
            document.getElementById('date5').style.backgroundColor = 'green';
            document.getElementById('date5').style.color = 'white';
        }
        else
        {
            document.getElementById('date5').style.backgroundColor = 'red';
            document.getElementById('date5').style.color = 'white';
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
