<script>
/* BOTONES MODAL */

readNode();

function readNode() {
  $('.leer').click(function(e) {
  e.preventDefault();
  var id = $(this).attr('data-node');
   //id = $(this).data('node');
  var node = $('#ventana-nodo-'+id);
  saveNodeHistory(node,id);
  console.log( 'id '+ id);
  console.log( 'modadl id '+ node.data('node'));
  console.log( 'leer NODO-- '+ node);

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

  return false;
  });
}


//--
$('.edit').click(function(e) {
  e.preventDefault();
  var nodeId = $(this).data('node');
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
              console.log(node.text);
            $('input[name="id"]').val(nodeId);
            $('input[name="title"]').val(node.title);
            $('textarea[name="text"]').html(node.text);

            $('.note-editable').html(node.text);
            $('.texto-nodo').html(node.text);
            //ocultamos place holder si ya hay texto cargado
            if (node.text.length > 0) {
              $('.note-placeholder').hide();
            }

            //$('textarea[name="text"]').html($('.note-editable').html());

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


$('.grindex a').click( function(e) {
     e.preventDefault();

  //  var top = parseInt($(this).css('top')) - 29;
  //  var left = parseInt($(this).css('left')) - 21;
     var top = parseInt(e.clientY) ;
     var left = parseInt(e.clientX);
     var offset = $(this).offset();
     var height = $(this).height();
     var width = $('.variant-0').width();
     var dataNode = $(this).data('node');
     var title = $(this).parent().attr('title');
     //console.log('grindex a '+top+' - '+left+ ' nodo:'+dataNode);
     //console.log(title);
    $(".modal-opciones-nodo").css({ 'top':offset.top - height - 100 , 'left': offset.left - width  });
    $(".leer").attr('data-node', dataNode);
    $(".edit").attr('data-node', dataNode);
    $(".modal-opciones-nodo h2").text(title);
    $(".modal-opciones-nodo").show();

      //console.log('+++NODO : '+$(this).data('edit-node'));
  //  console.log('li id '+$(this).attr('id'));
  //  saveWordPosition($(this).data('node'), left, top);

});


function saveNodeHistory(node, nodeId)
{
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "{{route('history.save-node',$story->id)}}", true);
  xhttp.setRequestHeader("X-CSRF-Token", "{{csrf_token()}}");
  xhttp.send('node='+nodeId);
  xhttp.addEventListener("readystatechange", function (e) {
      var el = e.target;
      if (xhttp.readyState == 4) {
          console.log('status: ' + xhttp.status);
          if (xhttp.status === 200) {
              var jsonResponse = JSON.parse(xhttp.response);
              console.log(jsonResponse.status);
              /*
              if (jsonResponse.status === 'liked') {
                  $('.btn-social.like').addClass('active');
              } else {
                  $('.btn-social.like').removeClass('active');
              }*/

          } else {
              console.log(xhttp.status + ' ' + xhttp.statusText);
          }
      }
  });
}
</script>
