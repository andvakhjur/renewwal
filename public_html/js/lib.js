// реализация перехода по истории браузера
    window.onload=function(){ 
        window.setTimeout(function(){ 
            window.addEventListener("popstate", function(e){ 
                var returnLocation = history.location || document.location; 
                    $.ajax({
                        url: e.state.href,             
                        data: e.state.params,
                        success: function (data, textStatus) { 
                                //console.log(data);
                                var responce = $.parseJSON(data)    
                                for (var key in responce) {
                                    $(key).html(responce[key]);
                                }
                                history.pushState(state, 'null', state.href);
                        }               
                    });
                },false
            )},1
        ); 
}
// подгрузка страниц аяксом
function change_page(elem,params){

    state = {
        href: $(elem).attr('href').substr(path_root.length),
        params: params
    }
    
    $.ajax({
        url: state.href,             
        data: params,
        success: function (data, textStatus) { 
                //console.log(data);
                var responce = $.parseJSON(data)    
                for (var key in responce) {
                    $(key).html(responce[key]);
                }
                history.pushState(state, 'null', state.href);
        }               
    });     
}
function send_data(elem){
    // куда отправдляем запрос
    var action = $(elem).parents('form').attr('action');
    if(action){
        var url = action;
    }else{
        var url = location.href.substr(path_root.length);
    } 
    
    $('input').each(function(){
        params[$(this).attr('name')] = $(this).val();
    })
    
    $.getJSON(url,
              JSON.stringify(params),
              function(responce){
                for (var key in responce) {
                    console.log(responce);
                    $(key).html(responce[key]);
                }
              }
    );
}
// центрируем элемент относительно родителя
function centured(elem,wr){ 
    mT = (wr.outerHeight() - elem.outerHeight())/2;
    mL = (wr.outerWidth() - elem.outerWidth())/2;
    m = {
        'marginTop' : mT,
        'marginLeft': mL
    }
    return m;
}
// меняем футер для главной страницы и остальных
function change_footer(id){
    $('#content').removeClass('main');
    $('.footer_container').removeClass('main');
    main_class = '';
    if(id == 1){
        $('.info').hide();
        main_class = ' main ';

    }else{
        $('.info').show();
    }
    $('#content').addClass(main_class);
    $('.footer_container').addClass(main_class);
}