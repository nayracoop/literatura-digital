$(document).ready(function(){

	$('.navbar-toggle').click(function() {
	  if($('.navbar-toggle').hasClass('on')){
	  	$('.navbar-toggle').removeClass('on');
	  }else{
	  	$('.navbar-toggle').addClass('on');
	  }
	});

	/* BOTONES MODAL */
	$('.leer, .cerrar-nodo').click(function() {	
	  if($('.nodo-backdrop').hasClass('esconder')){
	  	$('.nodo-backdrop').removeClass('esconder');
	  }else{
	  	$('.nodo-backdrop').addClass('esconder');
	  }
	  return false;
	});

	/* TABS */	
	$('.tabs a').click(function(e){
		e.preventDefault();
		var tab_id = $(this).attr('href');

		$('.tabs li').removeClass('active');
		$('.tabpanel').removeClass('active');

		$(this).parent().addClass('active');
		$(tab_id).addClass('active');
	})

});