jQuery(document.body).ready(function($) {
    var verfifiedTip = $('<span class="VerifiedTip"></span>')
        .hide()
        .append(
            $('<span class="VerifiedTipText"></span>').text(gdn.definition('VerifiedTip', 'Verified'))
        )
        .append(
            $('<span class="VerifiedTipCover"></span>')
        );
    $(document.body).append(verfifiedTip);
    $('a.Verified').livequery(function(){
        $(this).removeAttr("title");
        $(this).hover(
            function(e){
                $(verfifiedTip).css({
                    'position': 'absolute', 
                    'left': ($(this).offset().left - $(verfifiedTip).width() / 2) + 'px',
                    'top': ($(this).offset().top) + 'px'
                });
                $(verfifiedTip).fadeIn("slow");
            },
            function(e){
                e.pageX
                e.pageY
                var o = $(verfifiedTip).offset();
                var x = e.pageX - o.left;
                var y = e.pageY - o.top;
                
                if ((x < 0 || x > $(verfifiedTip).outerWidth(true)) || (y < 0 || y > $(verfifiedTip).outerHeight(true))) {
                    $(verfifiedTip).fadeOut();
                }
            }
        );
    });
});
