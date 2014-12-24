$(document).ready(function()
{
    $("#article0").change(function()
    {
        var rate = $("#article0 option:selected").data("value");
        var ttc = document.getElementById("ttc0").value;
        if(ttc != null || ttc != "")
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva0').value = montant;
        }
    })

    $("#ttc0").change(function()
    {
        var ttc = document.getElementById("ttc0").value;
        var rate = $("#article0 option:selected").data("value");
        document.getElementById("ttc0").value = ttc;
        if(rate != null)
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva0').value = montant;
        }
    })

    $("#article1").change(function()
    {
        var rate = $("#article1 option:selected").data("value");
        var ttc = document.getElementById("ttc1").value;
        if(ttc != null || ttc != "")
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva1').value = montant;
        }
    })

    $("#ttc1").change(function()
    {
        var ttc = document.getElementById("ttc1").value;
        var rate = $("#article1 option:selected").data("value");
        document.getElementById("ttc1").value = ttc;
        if(rate != null)
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva1').value = montant;
        }
    })

    $("#article2").change(function()
    {
        var rate = $("#article2 option:selected").data("value");
        var ttc = document.getElementById("ttc2").value;
        if(ttc != null || ttc != "")
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva2').value = montant;
        }
    })

    $("#ttc2").change(function()
    {
        var ttc = document.getElementById("ttc2").value;
        var rate = $("#article2 option:selected").data("value");
        document.getElementById("ttc2").value = ttc;
        if(rate != null)
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva2').value = montant;
        }
    })

    $("#article3").change(function()
    {
        var rate = $("#article3 option:selected").data("value");
        var ttc = document.getElementById("ttc3").value;
        if(ttc != null || ttc != "")
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva3').value = montant;
        }
    })

    $("#ttc3").change(function()
    {
        var ttc = document.getElementById("ttc3").value;
        var rate = $("#article3 option:selected").data("value");
        document.getElementById("ttc3").value = ttc;
        if(rate != null)
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva3').value = montant;
        }
    })

    $("#article4").change(function()
    {
        var rate = $("#article4 option:selected").data("value");
        var ttc = document.getElementById("ttc4").value;
        if(ttc != null || ttc != "")
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva4').value = montant;
        }
    })

    $("#ttc4").change(function()
    {
        var ttc = document.getElementById("ttc4").value;
        var rate = $("#article4 option:selected").data("value");
        document.getElementById("ttc4").value = ttc;
        if(rate != null)
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva4').value = montant;
        }
    })

    $("#article5").change(function()
    {
        var rate = $("#article5 option:selected").data("value");
        var ttc = document.getElementById("ttc5").value;
        if(ttc != null || ttc != "")
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('tva5').value = montant;
        }
    })

    $("#ttc5").change(function()
    {
        var ttc = document.getElementById("ttc5").value;
        var rate = $("#article5 option:selected").data("value");
        document.getElementById("ttc5").value = ttc;
        if(rate != null)
        {
            var montant = calculTVA(ttc, rate);
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
    	montantsansTVA = montant * 100 / taux;
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
