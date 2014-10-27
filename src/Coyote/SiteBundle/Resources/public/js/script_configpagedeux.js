$(document).ready(function()
{
    //$("input:checkbox").change(function()
    $('input[name=essieux]').change(function()
    {
        /*var cuve = document.getElementById("essieux");
        var datacuve = cuve.dataset.value;
        alert(datacuve);*/
        //alert($('input:radio[name=essieux]:checked').val());
        var essieu = $('input[type=radio][name=essieux]:checked').attr('data-value');
        essieu = essieu.split(':');
        //alert($('input[type=radio][name=roues]'));
        
        var tab = document.getElementsByName('roues');
        for (i=0;i<tab.length;i++)
        {
            document.pagedeux.roues[i].disabled = true;
        }
        for(j=1;j<essieu.length;j++)
        {
            for (i=0;i<tab.length;i++)
            {
            	if(tab[i].id == essieu[j])
            	{
            		document.pagedeux.roues[i].disabled = false;
            	}
            }
        }
    })
});