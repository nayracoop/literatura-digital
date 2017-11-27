$(document).ready(function(){

	$('.navbar-toggle').click(function() {
	  if($('.navbar-toggle').hasClass('on')){
	  	$('.navbar-toggle').removeClass('on');
	  }else{
	  	$('.navbar-toggle').addClass('on');
	  }
	});

// abrimos cerramos el nodo basado en su id
	$('.leer, .cerrar-nodo').click(function() {	
		var id = $(this).data('node');
		//console.log(id);
		var node = $('#ventana-nodo-'+id);

	  if(node.hasClass('esconder')){
	  	node.removeClass('esconder');
	  }else{
	  	node.addClass('esconder');
	  }
	  return false;
	});

});