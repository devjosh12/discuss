jQuery(document).ready(function($) {
    var joinPopupTxt = (typeof gdn != 'undefined' ? gdn.definition('joinPopup') : joinPopup).replace(/\{redirect_to\}/g, window.location.href);
    var joinPopupElement = $(joinPopupTxt);
    var startIn = parseInt(joinPopupElement.data('start-in') ? joinPopupElement.data('start-in') : 10);
    
    if (startIn > 0) {
        var popTimer = setInterval(function () {
            $.featherlight(
                joinPopupTxt,
                {
                   'closeOnEsc' : false,
                   'closeOnClick' : false,
                   'closeIcon' : '',
                   'openSpeed' : 1000
                }
            );
            clearInterval(popTimer);
        }, startIn * 1000);
    }
});
