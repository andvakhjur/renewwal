(function($){
    $.fn.accordion = function(options) {  
        var opt = {
            //�����
            'push_teg': 'a', //���, ��� ������� �� ������� ��������� ��������������
            'dropdown_teg': 'ul', // ���������������� ���
            'closest_parent': 'li', 
            'mouseenter': true,
            'animation': 'advanced'
            //�������� ��� ������� ��������:
            //'handle' - ��������� �������������� � ������������ �������
            //'advanced' - ��������� �������������� � ������������ �������������
            //'standart' - ��������� �������������� � ������������ �������������,
            //�������� ������ �������� ���� �������
	};

        return this.each(function() {
            if (options) {
                    $.extend(opt, options);
            }

            $(this).addClass('accordion')
                   .addClass('dropdown_teg')
                   .find(opt.push_teg)
                   .css('cursor','pointer');
            $('.accordion').find(opt.dropdown_teg).addClass('dropdown_teg');
            $('.accordion .dropdown_teg').css('display', 'none');
            $('.accordion').children().addClass('bg_arrow_down');

            //�������������� ����������� ���������� ��� �������� �� ������

            $(this).find('.active')
                   .addClass('on')
                   .parents('.dropdown_teg')
                   .css('display', 'block');
            $(this).find('.active')
                   .parents(opt.closest_parent)
                   .addClass('on');
            $(this).find('.active')
                   .children('.dropdown_teg')
                   .css('display', 'block');

            $('.dropdown_teg > ' + opt.closest_parent + ' > ' + opt.push_teg).click(function(){

                var main_parent = $(this).parent(opt.closest_parent).parent('.dropdown_teg');
                $('.accordion').find(opt.closest_parent).removeClass('active');
                $(this).parent(opt.closest_parent).addClass('active');
                main_parent.children(opt.closest_parent).children('.dropdown_teg').find(opt.closest_parent).removeClass('active');

                if(opt.animation == 'advanced' || opt.animation == 'handle'){
                    $(this).parent(opt.closest_parent).children('.dropdown_teg').slideToggle('normal');
                }
                else if(opt.animation == 'standart'){
                    $(this).parent(opt.closest_parent).children('.dropdown_teg').slideDown('normal');
                }

                if(opt.animation == 'handle'){
                    main_parent.children(opt.closest_parent).removeClass('on');
                    $(this).parent(opt.closest_parent).toggleClass('on');
                    main_parent.children(opt.closest_parent).children('.dropdown_teg').find(opt.closest_parent).removeClass('on');
                }

                if(opt.animation == 'advanced' || opt.animation == 'standart'){
                    main_parent.children(opt.closest_parent).removeClass('on');
                    main_parent.children(opt.closest_parent).children('.dropdown_teg').find(opt.closest_parent).removeClass('on');
                    $(this).parent(opt.closest_parent).addClass('on');
                    main_parent.children(opt.closest_parent).not('.active').find('.dropdown_teg').slideUp('normal');    
                }

            });

            if(opt.mouseenter == true){
                $('.dropdown_teg > ' + opt.closest_parent + ' > ' + opt.push_teg).hover(function(e) {
                    $(this).hoverFlow(e.type, { marginLeft: 10 }, 250);
                }, function(e) {
                    $(this).hoverFlow(e.type, { marginLeft: 0 }, 250);
                });
            }                        
        });
        };
})(jQuery);