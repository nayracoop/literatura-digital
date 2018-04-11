@php
$likeActive = '';
if ( \Auth::check() && $story->likes->where('status', 'liked')->where('user_id', \Auth::user()->_id)->first() !== null ) {
    $likeActive = 'active';
}
@endphp
<!--<a href="#" class="btn-social share">Compartir</a>-->
<a href="#" class="btn-social like  {{$likeActive}}">Me gusta</a>
@push('javascript')
<script type="text/javascript">
  $('.btn-social.like').click(function(e){
      e.preventDefault();
      var xhttp = new XMLHttpRequest();
      xhttp.open("POST", "{{route('like',$story->id)}}", true);
      xhttp.setRequestHeader("X-CSRF-Token", "{{csrf_token()}}");
      xhttp.send();
      xhttp.addEventListener("readystatechange", function (e) {
          var el = e.target;

          if (xhttp.readyState == 4) {
              console.log('status: ' + xhttp.status);
              if (xhttp.status === 200) {
                  var jsonResponse = JSON.parse(xhttp.response);
                  console.log(jsonResponse.status);
                  if (jsonResponse.status === 'liked') {
                      $('.btn-social.like').addClass('active');
                  } else {
                      $('.btn-social.like').removeClass('active');
                  }

              } else {
                  console.log(xhttp.status + ' ' + xhttp.statusText);
              }
          }
      });

  });
</script>
@endpush
