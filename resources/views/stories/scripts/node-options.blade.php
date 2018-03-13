<script>
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
$('.edit').click(function(e) {
  e.preventDefault();
  var nodeId = $(this).data('edit-node');
  //var node = $('#ventana-nodo-'+id);

  //console.log( 'id '+ id);
  //console.log( 'modadl id '+ node.attr('id'));
  console.log( 'NODO-- '+ nodeId);
  //var formData = new FormData();
  //formData.append('nodeId', nodeId);

  var xhttp = new XMLHttpRequest();
  xhttp.open('GET','{{route('node.json',$story->_id)}}?id='+nodeId);
  xhttp.setRequestHeader('X-XSRF-TOKEN', '{{csrf_token()}}');
  xhttp.send();

  xhttp.addEventListener("readystatechange", function (e) {
    var xhr = e.target;
    if (xhr.readyState == 4) {
      //  console.log('h');
        if (xhr.status == 200) {

            console.log('200');
            var response = JSON.parse(xhr.response);
            //var results = newResponse.results;
            var node = response.node;
            //  console.log(node);
            $('input[name="id"]').val(nodeId);
            $('input[name="title"]').val(node.title);
            $('input[name="text"]').val(node.text);
            $('#texto-nodo').html(node.text);
            $('.note-editable').html(node.text);

            $('input[name="charCount"]').val(node.charCount);
            $('.contador-caracteres').text(node.charCount);
            $('input[name="wordCount"]').val(node.wordCount);
            $('.contador-palabras').text(node.wordCount);

            $('#edit-node-modal').removeClass('esconder');
            $('#edit-node-modal .nodo-backdrop').removeClass('esconder');
            $('#edit-node-modal').addClass('nodo-backdrop-fondo');

          //  $('.items-listado').empty();
          //  $('.items-listado').append(results);
        } else console.log(xhr.statusText);
    }
  });

});
/*actualizar etiqueta palabra*/
$('.btn-guardar').click(function(e){
    //console.log('actualizar etiqueta title');
    var val = $('input[name="title"]').val();
    $('li[data-node="'+val+'"]').text(val);
});
</script>
