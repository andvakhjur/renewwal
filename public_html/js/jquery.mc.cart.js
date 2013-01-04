/**
* jQuery McCart Plugin 0.1
*/
(function($) {
    var defaults = {
        countSelector : '.cart-count',
        summSelector : '.cart-summ',
        buyButtonSelector : '.cart-buy-button',
        buyMessageSelector : '.cart-buy-message',
        productCountSelector : '.product-count',
        addProductUrl : '/cart/add/product/ajax',
        removeProductUrl : '/cart/remove/product/ajax',
        clearUrl : '/cart/clear/product/ajax',
        reloadOnUpdate : true
    };
    $.McCart = {
        init : function(settings){
            // инициализация плагина
            $.extend(defaults, settings);
            this.settings = defaults;
            return this;
        },
        addProduct : function(prodValues){
            $.getJSON($.McCart.settings.addProductUrl, prodValues,
            function(response){
                if(true == response.ok) {
                    $($.McCart.settings.countSelector).text(response.cartCount);
                    $($.McCart.settings.summSelector).text(response.cartSumm);

                    $.McCart.showMessage(prodValues);
                }
            });
        },
        removeProduct : function(prodValues){
            $.getJSON($.McCart.settings.removeProductUrl, prodValues,
            function(response){
                if(true == response.ok) {
                    $($.McCart.settings.countSelector).text(response.cartCount);
                    $($.McCart.settings.summSelector).text(response.cartSumm);

                    if($.McCart.settings.reloadOnUpdate) {
                        window.location.reload();
                    }
                }
            });
        },
        plusProduct : function(prodValues){
            $.getJSON($.McCart.settings.addProductUrl, prodValues,
            function(response){
                if(true == response.ok) {
                    $($.McCart.settings.countSelector).text(response.cartCount);
                    $($.McCart.settings.summSelector).text(response.cartSumm);
                    
                    $($.McCart.settings.productCountSelector + response.product.key).text(response.product.count);
                }
            });
        },
        minusProduct : function(prodValues){
            prodValues.count = -1;
            $.McCart.plusProduct(prodValues);
        },
        showMessage : function(prodValues){
            $($.McCart.settings.buyButtonSelector + prodValues.key).fadeOut(200, function(){
                $($.McCart.settings.buyMessageSelector + prodValues.key).fadeIn(1000).delay(2000).fadeOut(2000, function() {
                    $($.McCart.settings.buyButtonSelector + prodValues.key).fadeIn(500);
                });   
            });
            
            /**
            * Если указан только id, актуально для showAction товара
            */
            $($.McCart.settings.buyButtonSelector + prodValues.id).fadeOut(200, function(){
                $($.McCart.settings.buyMessageSelector + prodValues.id).fadeIn(1000).delay(2000).fadeOut(2000, function() {
                    $($.McCart.settings.buyButtonSelector + prodValues.id).fadeIn(500);
                });   
            });
        }
    }
})(jQuery);
