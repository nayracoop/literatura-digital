$(document).ready(function() {


    $('#texto-nodo').summernote({
        tabsize: 2,
        height: 430,
        toolbar: [
	        ['style', ['bold', 'italic', 'clear']],
	    	['font', ['strikethrough']],
			['insert', ['picture', 'link']]
		],
		popover: {
		  image: [
		    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
		    ['float', ['floatLeft', 'floatRight', 'floatNone']],
		    ['remove', ['removeMedia']]
		]},
        //toolbar: false,
        disableDragAndDrop: true,
        shortcuts: false,
        callbacks: {
          onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
            updateCount();
        	},
		      onKeyup: function(e) {
				     updateCount();
				     $('textarea[name="text"]').html($('.note-editable').html());

		      },
          onInit: function(e){
          //  console.log('summernote iniciado');
        //    updateCount();
          //  $('textarea[name="text"]').html($('.note-editable').html());
          }
  		}
    });


	function updateCount() {
	  var palabras = $('.note-editable').text().split(' ');
    var wordCount = palabras.length - 1;
	  $('.contador-palabras').text(wordCount);
    $('input[name="wordCount"]').val(wordCount);
	  //-1 para que cuente cdo aprieta espaciadora
	  var caracteres = $('.note-editable').text().length;
	  $('.contador-caracteres').text(caracteres);
    $('input[name="charCount"]').val(caracteres);
	}

});
