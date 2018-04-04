$(document).ready(function() {

    var alturaEditor = 430;
    if($(".nuevo-nodo-ergodico").length){
        alturaEditor = 300;
    }

    $('.texto-nodo').summernote({
        tabsize: 2,
        height: alturaEditor,
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
  		placeholder: 'Había una vez...',
        disableDragAndDrop: true,
        shortcuts: false,
        callbacks: {
            onPaste: function (e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            },
            onImageUpload: function(files) {
                sendFile(files[0]);
            },
            onChange: function(e) {
                updateCount();
                updateHiddenText();
            }
  		}
    });

	function updateCount() {
        var palabras = $('.note-editable').text().replace(/\s*$/,"");
        var palabrasArray = palabras.split(' ');
        var caracteres = $('.note-editable').text().length;

        $('.contador-palabras').text(palabrasArray.length);        
        $('.contador-caracteres').text(caracteres);

        $('input[name="wordCount"]').val(palabrasArray.length);
        $('input[name="charCount"]').val(caracteres);
    }
    
    function updateHiddenText() {
        $('textarea[name="text"]').html(unescape($('.note-editable').html()));
    }

});
