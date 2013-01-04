//jQuery.noConflict();
jQuery(document).ready(function(){
//    $("#cat_id-1").addClass("ch1");
//    $(".ch1").addClass("niceRadio");
//    $(".ch1").addClass("radioChecked");
//    $("#cat_id-1").txt($("#cat_id-1").txt()+'<span class="ico ico1">&nbsp;</span>');

$('#cat_id-1').attr('id', 'ch1');
$('#cat_id-2').attr('id', 'ch2');
$('#cat_id-3').attr('id', 'ch3');

$('#ch1').addClass("niceRadio");
$('#ch2').addClass("niceRadio");
$('#ch3').addClass("niceRadio");

//$('#ch1').parent("niceRadio");
$('#ch1').parent().append('<span class="ico ico1">&nbsp;</span><label for="ch1">Вера</label>');
$('#ch2').parent().append('<span class="ico ico2">&nbsp;</span><label for="ch2">Надежда</label>');
$('#ch3').parent().append('<span class="ico ico3">&nbsp;</span><label for="ch3">Любовь</label>');

$("#captcha-input").wrapAll('<span class="inputbox"></span>');
$("#captcha-input").parent().css('margin-top', '20px');
$("#captcha-input").parent().css('margin-left', '55px');




//<input id="captcha-input" class="required inputbox" type="text" value="" name="captcha[input]" style="margin-top: 20px; margin-left: 55px;">
//<input id="cat_id-1" type="radio" value="1" name="cat_id">
//<input id="ch1" type="radio" value="on" tabindex="0" name="story" checked="checked">
    
//    $("#cat_id-2").attr("class", "niceRadio radioChecked ch2");
//    $("#cat_id-2").txt($("#cat_id-2").txt()+'<span class="ico ico2">&nbsp;</span>');
    
//    $("#cat_id-3").attr("class", "niceRadio radioChecked ch3");
//    $("#cat_id-3").txt($("#cat_id-3").txt()+'<span class="ico ico3">&nbsp;</span>');
	jQuery(".niceRadio").each(function() {
	     changeRadioStart(jQuery(this)); 
	}); 

	jQuery(".niceRadio").click(function() {
	     changeRadio(jQuery(this));  
	});
	
	jQuery("span.item").textShadow();
});

function trigger(jcarousel){
	jQuery("#slider .num a").text(jcarousel.first);
	jQuery(".slider h3 .whom").html(jQuery("#slider li").eq(jcarousel.first-1).find('.whom').html());
	Cufon.refresh('.slider h3');
}
function fade(jcarousel){
	jQuery('.jcarousel-next').not('#default .jcarousel-next').click(function(){
		jQuery("#slider li .name").fadeOut('fast');
		jQuery("#slider li").eq(jcarousel.first).find('.name').fadeIn();
	});
	jQuery('.jcarousel-prev').not('#default .jcarousel-prev').click(function(){
		var index = jcarousel.first-2;
		if(index<0)
		index=0;
		else
		jQuery("#slider li .name").fadeOut('fast');
		
		
		jQuery("#slider li").eq(index).find('.name').fadeIn('slow');
	});
}