$(document).ready(function() {
	$('.cerrar-nodo').click(function() {
		      $('.nodo-backdrop').addClass('esconder');
					$('.nodo-backdrop-fondo').addClass('esconder');
	  return false;
	});

	$('.navbar-toggle').click(function() {
	  if($('.navbar-toggle').hasClass('on')){
	  	$('.navbar-toggle').removeClass('on');
	  }else{
	  	$('.navbar-toggle').addClass('on');
	  }
	});

	/* Botones para cambiar de modal en LOGIN/REGISTRAR */
	$('#ingresar .login-help a').click(function(e) {
	  e.preventDefault();
	  $("#ingresar").modal('hide');
	  setTimeout(function() {
	    $("#registrarse").modal('show');
	  }, 300);
	});
	$('#registrarse .login-help a').click(function(e) {
	  e.preventDefault();
	  $("#registrarse").modal('hide');
	  setTimeout(function() {
	    $("#ingresar").modal('show');
	  }, 300);
	});

	/* Botones para recuperar password */
	$('.recovery').click(function(e) {
		$('.recovery-field').toggle();
	});

	/* ON CHANGE PARA MESES de 31 */
	$('.meses').on('change', function() {
	  var a = this.value;

	  switch(a){
        case "Enero":
        case "Marzo":
        case "Mayo":
        case "Julio":
        case "Agosto":
        case "Octubre":
        case "Diciembre":
          $('select option').show();
          break;
        case "Abril":
        case "Junio":
        case "Septiembre":
        case "Noviembre":
          $('select option').show();
          $('.d31').hide();
          break;
        case "Febrero":
          $('select option').show();
          if($(".anio option:selected").text() === '2016' || $(".anio option:selected" ).text() === '2020' || $(".anio option:selected" ).text() === '2024'){
          	$('.d30, .d31').hide();
          }else{
			$('.d29, .d30, .d31').hide();
          }
          break;
      }


	});

	/* BOTONES MODAL */
	/*
	$('.leer, .cerrar-nodo').click(function(e) {
	  e.preventDefault();
/*
		if($(this).parent().parent().hasClass('esconder')){
	  	$(this).parent().parent().removeClass('esconder');
	  	$('body').addClass('overflow');
	  }else{
	  	$(this).parent().parent().addClass('esconder');
	  	$('body').removeClass('overflow');
	  }
		/////////
		$('.nodo-backdrop').addClass('esconder');
		$('.nodo-backdrop-fondo').addClass('esconder');
    return false;
	});
*/
	/* TABS VISUALIZACION / LISTADO DE NODOS*/
	$('.tabs a').click(function(e){
		e.preventDefault();
		var tab_id = $(this).attr('href');

		$('.tabs li').removeClass('active');
		$('.tabpanel').removeClass('active');

		$(this).parent().addClass('active');
		$(tab_id).addClass('active');
	});

	$.fn.extend({
		addTemporaryClass: function(className, duration) {
			var elements = this;
			setTimeout(function() {
					elements.removeClass(className);
			}, duration);

			return this.each(function() {
					$(this).addClass(className);
			});
		}
	});
});

(function($){
	
})(jQuery);
