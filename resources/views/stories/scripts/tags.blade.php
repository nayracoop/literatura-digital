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
        var tag = camelize($('#tag').val());
        //no agrega tags vacios
        if (tag.trim()) {
            var tagi = $('<div class="tag-item" onclick="javascript:update"><p>' + tag + '</p>' + 
                '<input type="hidden" name="tags[]" value="' + tag + '" />' +
                '<button type="button">@lang('Eliminar etiqueta')</button>' +
                '</div>').on('click', function (e) {
                    $(this).remove();
                });
            $(".tag-group").append(tagi);
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

    camelize = function camelize(str) {
        return str.replace(/\W+(.)/g, function (match, chr) {
            return chr.toUpperCase();
        });
    }
</script>
