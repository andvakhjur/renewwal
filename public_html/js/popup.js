(function($){
    $.fn.popup = function(options) {  
        var opt = {
            //опции
            'push_teg': 'popup_wr',   //тег, на который нужно наводить, нажимать
            'event': 'hover',   // событие при котором всплывает окно:
                                // click - клик, hover - при наведении
            'position': 'left',  // возможные варианты:
                                // top - cверху, bottom - снизу, left - слева, right - справа
                                // another - имя класса, свои личные настройки в css
            'maxWidth': 230,   // максимальная длина попапа
            'maxHeight': 230,
            'fadeSpeed': 400
	};

        return this.each(function(){
            if (options) {
                    $.extend(opt, options);
            }
            
            var popup = $(this);
            
            popup.addClass(opt.position);
            popup.find('.popup_arrow').addClass(opt.position);
            
            if(opt.position == 'top' || opt.position == 'bottom'){
                var w = popup.width();
                if(w < opt.maxWidth){
                    popup.css('width', w);
                }else{
                    popup.css('width', opt.maxWidth);
                }
                offset_left(popup)
                height =  + popup.children('.popup_arrow').outerHeight() + popup.parent().outerHeight();
            }else if(opt.position == 'left' || opt.position == 'right'){
                var h = $(this).height();
                if(h < opt.maxHeight){
                    popup.css('height', h);
                }else{
                    popup.css('height', opt.maxHeight);
                }
                offset_top(popup);
                width =  + popup.children('.popup_arrow').outerWidth() + popup.parent().outerWidth();
            }
            
            if(opt.position == 'top'){
                $(this).css('bottom',height-3)
            }else if(opt.position == 'bottom'){
                $(this).css('top',height-3)
            }else if(opt.position == 'left'){
                $(this).css('right',width-3)
            }else if(opt.position == 'right'){
                $(this).css('left',width-3)
            }
            
            if(opt.event == 'hover'){ // если событие "при наведении"
                $('.' + opt.push_teg).hover(function(e) {
                    el = $(this).find(popup);
                    el.show();
                }, function(e) {
                    popup.hide();
                });
            }else if(opt.event == 'click'){ // если событие "клик"
                $('.' + opt.push_teg).click(function(){
                    el = $(this).parent().find(popup);
                    if(el.is(':hidden')){
                        el.fadeIn(opt.fadeSpeed);
                    }else{
                        el.fadeOut(opt.fadeSpeed);
                    }
                });
            }
            
        })
        function offset_top(el){ //центрируем элемент по высоте
            var h = el.outerHeight();
            var w = el.outerWidth();
            el.css('margin-top', -h/2);
            //return w;
        }
        function offset_left(el){ //центрируем элемент по длине
            var w = el.outerWidth();
            var h = el.outerHeight();
            el.css('margin-left', -w/2);
            //return h;
        }
    };
})(jQuery);            


