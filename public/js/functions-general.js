$(document).ready(function(){

	$('.navbar-toggle').click(function() {
	  if($('.navbar-toggle').hasClass('on')){
	  	$('.navbar-toggle').removeClass('on');
	  }else{
	  	$('.navbar-toggle').addClass('on');
	  }
	});

	/* BOTONES MODAL */
	$('.leer').click(function(e) {
		  e.preventDefault();
		  var id = $(this).attr('id');
			 id = $(this).data('node');
			var node = $('#ventana-nodo-'+id);

      console.log( 'id '+ id);
			console.log( 'modadl id '+ node.data('node'));
			console.log( 'NODO-- '+ node);

			if($('.nodo-backdrop-fondo').hasClass('esconder')){
				 $('.nodo-backdrop-fondo').removeClass('esconder');
			}
      //node.removeClass('esconder');
		  if(node.hasClass('esconder')){
			//	  console.log( node.removeClass('esconder'));
					node.removeClass('esconder');
					//node.attr('class','ssss');
				//	$('body').addClass('overflow');
	    }else{
		      node.addClass('esconder');
			//		$('body').removeClass('overflow');
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
//--
/* BOTONES MODAL */

//--
	$('.cerrar-nodo').click(function() {
		      $('.nodo-backdrop').addClass('esconder');
					$('.nodo-backdrop-fondo').addClass('esconder');
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
