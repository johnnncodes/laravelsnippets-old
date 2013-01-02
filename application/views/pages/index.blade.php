

  

      <hr>

      <div class="jumbotron">
        <h1>Welcome to Laravel Snippets!</h1>
        <p class="lead">Feel free to grab or submit useful code snippets for Laravel.</p>
        <a class="btn btn-jumbo btn-large btn-success" href="{{ action('snippets@index') }}">Grab a snippet now!</a>
 <br><br><br>
              <!-- twitter tweet -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-via="laravelsnippets">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        <!-- twitter tweet ENDS -->

        <!-- facebook like -->
        <div class="fb-like" data-href="http://www.facebook.com/LaravelSnippets" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
        <!-- facebook like ENDS -->

        <br>

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
 

 