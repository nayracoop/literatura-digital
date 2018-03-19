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
            updateCount();
        	},
		  onKeyup: function(e) {
			updateCount();    
		    },
          onImageUpload: function(files) {
            sendFile(files[0]);
            }
  		}
    });

    function sendFile(files) {
        data = new FormData();
        data.append("file", files);
        $.ajax({
            data: data,
            type: "POST",
            url: "Your URL POST (php)",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                // upload image to server and create imgNode...
                //tipo var node = document.createElement('div');
                $('.texto-nodo').summernote('insertNode', imgNode);
            }
        });
    }
/*
    if ($_FILES['file']['name']) {
        if (!$_FILES['file']['error']) {
            $name = md5(rand(100, 200));
            $ext = explode('.', $_FILES['file']['name']);
            $filename = $name . '.' . $ext[1];
            $destination = '/assets/images/' . $filename; //change this directory
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination);
            echo 'http://test.yourdomain.al/images/' . $filename;//change this URL
        }
        else
        {
        echo  $message = ':( Hubo un problema con tu imagen:  '.$_FILES['file']['error'];
        }
    }*/


	function updateCount() {
	  var palabras = $('.note-editable').text().replace(/\s*$/,""); 
      var palabrasArray = palabras.split(' ');
	  $('.contador-palabras').text(palabrasArray.length); 
	  var caracteres = $('.note-editable').text().length;
	  $('.contador-caracteres').text(caracteres);
	}

});