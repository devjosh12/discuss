jQuery(document).ready(function(){
    var cats = $.parseJSON(gdn.definition('DiscussionsExcludeCategories'));
    $.each(cats,function(i,v){
        var hc = $("<input />").attr({
            "type":"checkbox",
            "class":"DiscussionsExcludeCategory",
            "name":"DiscussionsExcludeCategory_"+i,
            "style":"vertical-align:middle;"
        });
        if(v.exclude==1)
            hc.attr("checked","checked")
        var catops = $("<span class=\"DiscussionsExcludeCategoriesOps\" />");
        catops.append(hc)
            .append($("<label style=\"vertical-align:middle;\">" + gdn.definition("DiscussionsExcludeLabel") + " </label>"));
        $("#list_"+i+" .Buttons:first").prepend(catops);
    });
    $('.DiscussionsExcludeCategory').live('click',function(){
        var c = $(this).attr('name').split('_');
        var id = c[1];
        var on = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            type: "POST",
            url: gdn.url('/settings/discussionsexcludecategory/' + id + '/' + on),
            data: 'DeliveryType=BOOL&DeliveryMethod=JSON',
            dataType: 'json',         
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $.popup({}, XMLHttpRequest.responseText);
            },
            success: function(json) {
                
            }
        });
    });
});
