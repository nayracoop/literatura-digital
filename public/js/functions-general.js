$(document).ready(function(){

	$('.navbar-toggle').click(function() {
	  if($('.navbar-toggle').hasClass('on')){
	  	$('.navbar-toggle').removeClass('on');
	  }else{
	  	$('.navbar-toggle').addClass('on');
	  }
	});

	/* BOTONES MODAL */
	$('.leer').click(function() {
		  var id = $(this).attr('id');
			var node = $('#ventana-nodo-'+id);
		  if(node.hasClass('esconder')){
		      node.removeClass('esconder');
	    }else{
		      node.addClass('esconder');
	    }
		/*
	  if($('.nodo-backdrop').hasClass('esconder')){
	  	$('.nodo-backdrop').removeClass('esconder');
	  }else{
	  	$('.nodo-backdrop').addClass('esconder');
	  }
		*/
	  return false;
	});

	$('.cerrar-nodo').click(function() {
		      $('.nodo-backdrop').addClass('esconder');

		/*
	  if($('.nodo-backdrop').hasClass('esconder')){
	  	$('.nodo-backdrop').removeClass('esconder');
	  }else{
	  	$('.nodo-backdrop').addClass('esconder');
	  }
		*/
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
