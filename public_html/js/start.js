$(document).ready(function(){
    // присваиваем событие всем элементам, кроме:
    // 1. Если ссылка имеет внешний url - согласимся, задавать атрибут 'name' 
    // таким ссылкам - 'external_link'.
    // 2. Если ссылка имеет # в атрибуте 'href', следовательно это ссылка
    // на якорь внутри текста.
    $('a').live('click',function(e){
        if($(this).attr('name') != 'external_link'){
            if($(this).attr('href').toString().indexOf('#') == -1){
                change_page(this);
                return false;
            }
        }
    });
    // функциональность анимации для кнопки "Узнать об Иисусе"
    $('.about_jesus_wr').hover(function(e) {
        $(this).hoverFlow(e.type, { right: -5 }, 400);
    }, function(e) {
        $(this).hoverFlow(e.type, { right: -240 }, 400);
    });
});
    