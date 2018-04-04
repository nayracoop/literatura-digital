<script>
    /* Guardar Borrador */
    $('.bot.sig, .btn.btn-guardar').on('click', function (e) {
        e.preventDefault();
        if ($('#story-form').valid()) {
            console.log('formulario valido, procediendo a grabar');
            save();
        } else {
            console.log('formulario inválido, corrija, haga el favor');
        }
    });

    //on submit
    $('#story-form').on('submit', function (e) {
        console.log('form submit detenido');
        e.preventDefault();
    });

    function save() {
        var formElement = document.getElementById("story-form");
        var xhr = new XMLHttpRequest();
        var formData = new FormData(formElement);
        formData.append('_token', '{{ csrf_token() }}');
        xhr.open('POST', '{{ route("story.saveXhr") }}');
        xhr.send(formData);

        xhr.addEventListener("readystatechange", function (e) {
            var el = e.target;

            if (xhr.readyState == 4) {
                console.log('status: ' + xhr.status);
                if (xhr.status === 200) {
                    var jsonResponse = JSON.parse(xhr.response);                    
                    if (jsonResponse.redirect) {
                        window.location.replace(jsonResponse.redirect);
                    } else {
                        //este temporaryclass está en functions-general
                        $('.guardado.exito').addTemporaryClass('active', 1500);
                    }
                } else {
                    $('.guardado.error').addTemporaryClass('active', 1500);
                    console.log(xhr.status + ' ' + xhr.statusText);
                }
            }
        });
    }
</script>
