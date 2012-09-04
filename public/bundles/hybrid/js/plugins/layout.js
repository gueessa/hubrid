!function ($) {
    $(function() {
        var $window      = $(window),
            $body        = $('body'),
            $document    = $(document),
            resizeLayout = function() {
                var leftPanel       = $('[data-role="left-panel"]'),
                    centerPanel     = $('[data-role="center-panel"]'),
                    rightPanel      = $('[data-role="right-panel"]'),
                    bottomPanel     = $('[data-role="bottom-panel"]');
                
                // Const
                var leftPanelWidth      = leftPanel.width(),
                    bottomPanelHeight   = bottomPanel.height(); 
                
                leftPanel.css({
                    'height' : $document.height() 
                });
                centerPanel.css({
                    'height' : $document.height() - bottomPanelHeight,
                    'left'   : leftPanelWidth,
                    'width'  : $document.width() - 260    
                });
                rightPanel.css({
                    'height' : $document.height() - bottomPanelHeight,
                    'left'   : $document.width() / 2, 
                    'width'  : 630 
                });
                
                if ($body.hasClass('right-panel-visible')) {
                    centerPanel.css({
                        'width'  : $document.width() - 260 - 630
                    });
                    rightPanel.css({
                        'left'   : $document.width() - 644,
                    });    
                }
            };
    
        $(window).resize(function(){
            resizeLayout();
        });

        resizeLayout();
    })
}(window.jQuery);    