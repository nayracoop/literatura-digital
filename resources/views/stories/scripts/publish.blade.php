@push('javascript')
<script>
    hashChangedUpdate();
    function hashChangedUpdate() {
        $(".status_switch:checkbox").on("click", changeStatus);

        function changeStatus(event) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(xhttp.response);
                    //console.log(response.results);
                } else {
                    //console.log(xhttp.statusText);
                }
            };
            xhttp.open("POST", "{{ route('story.change-status') }}", true);
            xhttp.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id=" + event.target.id);
        }
    }
</script>
@endpush
