<script type="text/javascript">
   /* Upload de imagen */
   $('input[type="file"]').change(function () {

       var files = this.files;
       for (var i = 0; i < files.length; i++) {
           var formData = new FormData();
           var xhr = new XMLHttpRequest();
           formData.append('cover', files[i]);
           formData.append('_token', '{{ csrf_token() }}');
           xhr.open("POST", "{{ route('picture.storeXhr') }}");
           xhr.send(formData);
       }

       xhr.addEventListener("readystatechange", function (e) {
           var xhr = e.target;
           if (xhr.readyState == 4) {

               if (xhr.status == 200) {
                   // Acá actualizo la imagen
                   console.log(xhr.response);

                   newResponse = JSON.parse(xhr.response);
                   // console.log(JSON.parse( xhr.response).fileName  );
                   newImg = newResponse.picUrl;
                   picName = newResponse.picName;
                   // console.log(hash+'  -  '+ newImg ); //
                   $('.portada-border').find('img').remove();
                   $('.portada-border').append('<img src="' + newImg + '" />');
                   $('form').append('<input type="hidden" name="cover" value="' + picName + '" />');
                   //$('#cover-'+hash).value(  newId);

               } else console.log(xhr.statusText);
           }
       });
   });
</script>
