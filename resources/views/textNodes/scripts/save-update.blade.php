<script>
    /* Guardar Borrador */
    $('.btn.btn-guardar').on('click', function (e) {
        e.preventDefault();
        $('.alert').remove();
        if ( $("#node-form").valid() ) {
          console.log('paso!!!');
          save();
        } else {
          console.log('NO paso!!!');
        }

    });

    $('.btn-cancelar').on('click', function (e) {
        e.preventDefault();
        window.location.replace("{{ route('nodes.index', $story->_id) }}");
    });

    function save()
    {
      var formElement = document.getElementById("node-form");
      var xhr = new XMLHttpRequest();
      var formData = new FormData(formElement);
      //formData.append('status', 'draft');
      formData.append('_token', '{{ csrf_token() }}');
      xhr.open("POST", '{{ route("node.saveXhr") }}');
      xhr.send(formData);

      xhr.addEventListener("readystatechange", function (e) {
          var xhr = e.target;
          if (xhr.readyState == 4) {
              if (xhr.status == 200) {
                  console.log('200');
                  newResponse = JSON.parse(xhr.response);
                  var id = newResponse.id;
                  // var alert = "include('snippets.flash.saved_changes')";
                  // var  alert = '<div class="alert alert-success">@lang("Tus cambios han sido guardados")</div>';

                  var redirect = newResponse.redirect;

                  if (redirect != null) {
                      window.location.replace(redirect);
                  }
                  //   $('.container.formulario').prepend(alert);
                  @if(!isset($node))
                      $("#node-form").append('<input name="id" type="hidden"  value="' + id + '" />');
                  @endif
              } else console.log(xhr.statusText);
          }
      });
    }
</script>
