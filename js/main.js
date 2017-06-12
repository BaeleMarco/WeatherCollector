/*-------------*/
/*CONSTANT LOOP*/
/*-------------*/
window.setInterval(function(){
	//If there's a scrollbar remove fixed-footer and vise versa
	if ($(document).height() > $(window).height()){
		if($('footer').eq(0).is('.fixed-footer')){
			$('footer').removeClass("fixed-footer");
		}
	}else{
		$('footer').addClass('fixed-footer');
	}

	if ($(window).width() < 993){
		$('.mobile-nav').show();
	}
	else {
		$('.mobile-nav').hide();
	}
}, 1);

/*---*/
/*NAV*/
/*---*/
$('.button-collapse').on('click',function(e){
	e.preventDefault();
	$('.mobile-nav').animate({right: "0px"}, 200);
});
$('.close-collapse').on('click',function(e){
	e.preventDefault();
	$('.mobile-nav').animate({right: "-5000px"}, 200);
});
// $('.fixed-action-btn').openFAB();
// $('.fixed-action-btn').closeFAB();
// $('.fixed-action-btn.toolbar').openToolbar();
// $('.fixed-action-btn.toolbar').closeToolbar();