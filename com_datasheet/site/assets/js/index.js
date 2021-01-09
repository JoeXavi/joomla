jQuery(document).ready(function(){
    jQuery("#ver-mas-datasheet").click(function(){
        console.log("Alto: ",jQuery("#table-datasheet").css(["max-height"]))
        
        if(jQuery("#table-datasheet").css("max-height") == "200px" )
            jQuery("#table-datasheet").css({"max-height":"none"})
        else
            jQuery("#table-datasheet").css({"max-height":"200px"})
    })
})