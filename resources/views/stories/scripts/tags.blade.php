<script>
    //funcionalidades tags
    $('#add_tag').on('click', function (e) {
        e.preventDefault();
        addTag();
        //console.log($select);
    });

    $('.tag-item').on('click', function (e) {
        $(this).remove();
    });

    function addTag() {
        var tag = $('#tag').val();
        //no agrega tags vacios
        if (tag.trim() != '') {
            $(".tag-group").append('<div class="tag-item"><p>' + tag +
              '<p><input type="hidden" name="tags[]" value="' + tag + '" /><button>@lang('Eliminar etiqueta ')</button></div>');
            $('#tag').val('');
        }
    }
    // permite agregar etiquetas con enter sin afectar al resto del form
    $('html').bind('keypress', function (e) {
        if (e.keyCode == 13) {
            if ($("#tag").is(':focus')) {
                addTag();
                return false;
            }
        }
    });
</script>
