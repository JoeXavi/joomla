jQuery(function() {
    
    loadFields(jQuery("#jform_id").val())
    jQuery("#jform_type_id").change(function(e){
        loadFields()
    })
});

function loadFields(id){
    console.log(id);
    if(id)
        data = { "data":jQuery("#jform_type_id option:selected").val(), "with":id };
    else
        data = { "data":jQuery("#jform_type_id option:selected").val() };

    jQuery.ajax({
        url: 'index.php?option=com_datasheet&task=ajax.work',
        type: 'POST',
        data: data,
        async: true,
        beforeSend: function () {
        },
        success: function (response) {
            let json = JSON.parse(response);
            console.log(json)
            jQuery("#contdatasheet").html(json.data);   
        }})
}