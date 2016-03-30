$(function() {
    var pickerOpts = { dateFormat:"dd/mm/y" };
    $( "#coyote_sitebundle_expense_date" ).datepicker(pickerOpts);
});

$(document).ready(function()
{
    $("#coyote_sitebundle_expense_actual_amount").change(function()
    {
        var reel = document.getElementById("coyote_sitebundle_expense_actual_amount").value;
        document.getElementById("coyote_sitebundle_expense_amount_TTC").value = reel;
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
