<script>
    /* Guardar Borrador */
    $('.btn.btn-guardar').on('click', function (e) {
        e.preventDefault();
        if ($('#node-form').valid()) {
            console.log('formulario valido, procediendo a grabar');
            save();
        } else {
            console.log('formulario inválido, corrija, haga el favor');
        }
    });

    $('.btn-cancelar').on('click', function (e) {
        e.preventDefault();
        window.location.replace("{{ route('nodes.index', $story->slug) }}");
    });

    function save() {
        var formElement = document.getElementById("node-form");
        var xhr = new XMLHttpRequest();
        var formData = new FormData(formElement);

        formData.append('_token', '{{ csrf_token() }}');
        xhr.open("POST", '{{ route("node.saveXhr") }}');
        xhr.send(formData);

        xhr.addEventListener('readystatechange', function (e) {
            var xhr = e.target;
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    newResponse = JSON.parse(xhr.response);
                    var id = newResponse.id;
                    var node = newResponse.node;

                    var redirect = newResponse.redirect;
                    if (redirect != null) {
                        window.location.replace(redirect);
                    } else {
                        //este temporaryclass está en functions-general
                        $('.guardado.cambios.exito').addTemporaryClass('active', 1500);
                        let nodeUpdated = $('#ventana-nodo-'+id);
                        nodeUpdated.find('.container-nodo').html(node.text);
                        nodeUpdated.find('.tit-nodo').html(node.title);

                    }

                    @if (!isset($node))
                        if (!$('#nodeId').length) {
                            $("#node-form").append('<input name="id" id="nodeId" type="hidden" value="' + id + '" />');
                        }
                    @endif
                } else {
                    $('.guardado.error').addTemporaryClass('active', 1500);
                    console.log(xhr.statusText);
                }
            }
        });
    }

    function nodeToggleStatus(el) {
        // si el nodo existe, le cambio el estado.
        // sino, cambio el valor de status y voy a save
        if ($('#nodeId').length) {

            $el = $(el);
            let method = 'PATCH';
            let uri = $el.data('uri');

            let xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(xhttp.response);
                    if(response.status === 'ok') {

                        $('.guardado.estado.exito').addTemporaryClass('active', 1500);

                        // nombre al botón y al campo hidden
                        $nodeStatus = $('#nodeStatus');
                        if($nodeStatus.val() === '{{ \App\Models\Enums\Status::DRAFT }}') {
                            $nodeStatus.val('{{ \App\Models\Enums\Status::PUBLISHED }}')
                            //nombre al botón = 'MOVER A BORRADOR'
                        } else {
                            $nodeStatus.val('{{ \App\Models\Enums\Status::DRAFT }}')
                            //nombre al botón = 'PUBLICAR'
                        }
                    }
                } else {
                    console.log('error');
                }
            };

            //esto necesita una barra al final para pasar el id
            xhttp.open(method, uri + "/", true);
            xhttp.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //necesito este encabezado para que Symfony lo agarre con el Request::ajax()
            xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhttp.send(null);

        } else {

            $nodeStatus = $('#nodeStatus');
            if($nodeStatus.val() === '{{ \App\Models\Enums\Status::DRAFT }}') {
                $nodeStatus.val('{{ \App\Models\Enums\Status::PUBLISHED }}')
            } else {
                $nodeStatus.val('{{ \App\Models\Enums\Status::DRAFT }}')
            }
            save();
            // cambiar nombre al botón
        }
    }
   @if($story->getVisualization()->slug === 'words' )
    /*actualizar etiqueta palabra*/
    $('.btn-guardar').click(function(e){
        let nodeId = $('#nodeId').val();
        let val = $('input[name="title"]').val();
        console.log('actualizar etiqueta title '+ val + ' node '+ nodeId);
        $('li[data-node="'+nodeId+'"] a').text(val);
        $('.modal-opciones-nodo h2').text(val);
    });
    @endif
</script>
@include('textNodes.scripts.upload-picture')
