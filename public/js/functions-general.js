$(document).ready(function(){

	$('.navbar-toggle').click(function() {
	  if($('.navbar-toggle').hasClass('on')){
	  	$('.navbar-toggle').removeClass('on');
	  }else{
	  	$('.navbar-toggle').addClass('on');
	  }
	});


	$('.leer, .cerrar-nodo').click(function() {	
	  if($('.nodo-backdrop').hasClass('esconder')){
	  	$('.nodo-backdrop').removeClass('esconder');
	  }else{
	  	$('.nodo-backdrop').addClass('esconder');
	  }
	  return false;
	});

});