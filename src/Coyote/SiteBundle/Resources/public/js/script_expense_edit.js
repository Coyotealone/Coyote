$(document).ready(function()
{
    $("#coyote_sitebundle_expense_date").change(function()
    {
        var date = document.getElementById("coyote_sitebundle_expense_date").value;
        if(date.length < 6 || date.length > 6)
        {
            document.getElementById('coyote_sitebundle_expense_date').style.backgroundColor = 'red';
            document.getElementById('coyote_sitebundle_expense_date').style.color = 'white';
        }
        if(/\d{6}/.test(date))
        {
            document.getElementById('coyote_sitebundle_expense_date').style.backgroundColor = 'green';
            document.getElementById('coyote_sitebundle_expense_date').style.color = 'white';
        }
        else
        {
            document.getElementById('coyote_sitebundle_expense_date').style.backgroundColor = 'red';
            document.getElementById('coyote_sitebundle_expense_date').style.color = 'white';
        }
    })

    $("#coyote_sitebundle_expense_actual_amount").change(function()
    {
        var reel = document.getElementById("coyote_sitebundle_expense_actual_amount").value;
        //var rate = $("#coyote_sitebundle_expense_fee option:selected").data("value");
        document.getElementById("coyote_sitebundle_expense_amount_TTC").value = reel;
        /*if(rate != null)
        {
            var montant = calculTVA(reel, rate);
            document.getElementById('coyote_sitebundle_expense_amount_TVA').value = montant;
        }*/
    })


    /*$("#coyote_sitebundle_expense_fee").change(function()
    {
        var rate = $("#coyote_sitebundle_expense_fee option:selected").data("value");
        var ttc = document.getElementById("coyote_sitebundle_expense_amount_TTC").value;
        if(ttc != null || ttc != "")
        {
            var montant = calculTVA(ttc, rate);
            document.getElementById('coyote_sitebundle_expense_amount_TVA').value = montant;
        }
    })*/

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
