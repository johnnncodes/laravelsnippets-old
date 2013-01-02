

  

      <hr>

      <div class="jumbotron">
        <h1>Welcome to Laravel Snippets!</h1>
        <p class="lead">Feel free to grab or submit useful code snippets for Laravel.</p>
        <a class="btn btn-large btn-success" href="{{ action('snippets@index') }}">Grab a snippet now!</a>
      </div>

      <hr>

      <div class="row-fluid marketing">
        <div class="span6" id="latest-snippets">
          <h4>Latest Snippets:</h4>
          <ul>
            @foreach($snippets as $snippet)
              <li><a class="title-link" href="{{ action('snippets@index', array($snippet->id)) }}">{{ $snippet->title }}</a></li>
            @endforeach
          </ul>
        </div>

        <div class="span6">
          <h4>Latest Tweet</h4>
          <p id="twitter"></p>
      </div>

      <hr>


<script>

$(document).ready(function() {
  $.getJSON("https://api.twitter.com/1/statuses/user_timeline/laravelsnippets.json?count=1&include_rts=1&callback=?", function(data) {
       $("#twitter").html(data[0].text);
  });
});

</script>
 

 