;(function($){
    $(document).ready(function(){ 
        let easygr_iframe = $(".easygr-iframe-box");
        if(easygr_iframe.length > 0){
            easygr_iframe.each(function(){
                let data = $(this).data("data");               
              wizardIFrame(easygr_iframe,data);            
            });
        }

    });

    /* Iframe creation function */
    const wizardIFrame = function (iframeContainerId, iframe_atts) {
        const iframe = $('<iframe>', {
            name: 'easygr',
            class: 'easygr-iframe',
            src: `https://phplaravel-1196969-4821714.cloudwaysapps.com/review/show/${iframe_atts.id}`,
            allowtransparency: 'true',
            allowfullscreen: true,
            css: {
                width: iframe_atts.width,
                maxWidth: '100%',
                height: iframe_atts.height,
                border: 'none'
            }
        });
        iframeContainerId.each(function() {
            $(this).append(iframe);
        });
    };


})(jQuery);




