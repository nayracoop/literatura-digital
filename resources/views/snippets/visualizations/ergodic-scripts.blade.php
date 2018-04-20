<script type="text/javascript">
getNodeErgodic("{{route('node.ergodic',[$story->_id, $story->firstNode()->_id])}}");
clickErgodicNode();
function clickErgodicNode()
{
  $('.condicionales-ergodico a').click(function(e){
      e.preventDefault();
      getNodeErgodic($(this).data('nextnode'));
  });
}

function getNodeErgodic(url)
{
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    xhr.send();

    xhr.addEventListener("readystatechange", function (e) {
        var xhr = e.target;
        if (xhr.readyState == 4) {
            //  console.log('h');
            if (xhr.status == 200) {
                console.log('200');
                newResponse = JSON.parse(xhr.response);
                var node = newResponse.node;
                $('.ergodic-node').empty();
                $('.ergodic-node').html(node);
                clickErgodicNode();
            } else console.log(xhr.statusText);
        }
    });
}
</script>
