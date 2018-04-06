<script>
    $(document).ready(function(){
        $('#typology').on('change', (event) => {
            getVisualizations(event.currentTarget);
        });
    });

    function getVisualizations(el) {
        $el = $(el);

        $.get (
            $el.data('url'),
            { typology_id: $el.val() },
            function(data) {
                var vis_select = $('#visualization');
                vis_select.empty();

                $.each(data.visualizations, function(index, element) {
                    vis_select.append("<option value='" + element._id + "'>" + element.name.charAt(0).toUpperCase() + element.name.slice(1) + "</option>");                    
                });
            }
        );
    }
</script>
