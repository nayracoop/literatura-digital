<script>
/* Guardar Borrador */
$('.bot.sig').on('click', function (e) {
    e.preventDefault();
    $('.alert').remove();
    if ( $("#story-form").valid() ) {
      console.log('paso!!!');
      save();
    } else {
      console.log('NO paso!!!');
    }
});
//on submit
$("#story-form").on("submit", function (e) {
    console.log('Submitting');
    e.preventDefault();
});

function save()
{
  var formElement = document.getElementById("story-form");
  var xhr = new XMLHttpRequest();
  var formData = new FormData(formElement);
  //formData.append('status', 'draft');
  formData.append('_token', '{{ csrf_token() }}');
  xhr.open("POST", '{{ route("story.saveXhr") }}');
  xhr.send(formData);

  xhr.addEventListener("readystatechange", function (e) {
      var xhr = e.target;
      if (xhr.readyState == 4) {
          if (xhr.status == 200) {
              console.log('200');
              newResponse = JSON.parse(xhr.response);
              var id = newResponse.id;
              var redirect = newResponse.redirect;
              // var alert = "include('snippets.flash.saved_changes')";
              // var  alert = '<div class="alert alert-success">@lang("Tus cambios han sido guardados")</div>';
              if (redirect !== null) {
                  window.location.replace(redirect);
              }
              // $('.container.formulario').prepend(alert);

          } else console.log(xhr.statusText);
      }
  });


}

</script>
