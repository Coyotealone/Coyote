$(document).ready(function()
{	
    if(document.getElementById("livraison").checked == false)
    {
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_corporate_name").disabled = true;
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_name").disabled = true;
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_adress1").disabled = true;
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_adress2").disabled = true;
        /*document.getElementById("coyote_sitebundle_formorder_deliveryaddress_zip_code").disabled = true;*/
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_postal_box").disabled = true;
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_city").disabled = true;
        /*document.getElementById("coyote_sitebundle_formorder_deliveryaddress_country").disabled = true;*/
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_phone").disabled = true;
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_cell").disabled = true;
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_fax").disabled = true;
        document.getElementById("coyote_sitebundle_formorder_deliveryaddress_email").disabled = true;
    }

    $("#livraison").change(function()
    {
        if(document.getElementById("livraison").checked == false)
        {
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_corporate_name").disabled = true;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_name").disabled = true;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_adress1").disabled = true;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_adress2").disabled = true;
            /*document.getElementById("coyote_sitebundle_formorder_deliveryaddress_zip_code").disabled = true;*/
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_postal_box").disabled = true;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_city").disabled = true;
            /*document.getElementById("coyote_sitebundle_formorder_deliveryaddress_country").disabled = true;*/
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_phone").disabled = true;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_cell").disabled = true;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_fax").disabled = true;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_email").disabled = true;
        }
        if(document.getElementById("livraison").checked == true)
        { 
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_corporate_name").disabled = false;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_name").disabled = false;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_adress1").disabled = false;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_adress2").disabled = false;
            /*document.getElementById("coyote_sitebundle_formorder_deliveryaddress_zip_code").disabled = false;*/
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_postal_box").disabled = false;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_city").disabled = false;
            /*document.getElementById("coyote_sitebundle_formorder_deliveryaddress_country").disabled = false;*/
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_phone").disabled = false;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_cell").disabled = false;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_fax").disabled = false;
            document.getElementById("coyote_sitebundle_formorder_deliveryaddress_email").disabled = false;
        }
    })
});
