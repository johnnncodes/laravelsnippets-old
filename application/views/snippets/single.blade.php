<div class="row">    
    <div class="span12">
        <div class="breadcrumb">
            <a href="{{ action('pages@index') }}">Home</a> / <a href="{{ action('snippets@index') }}">Snippets</a> / <span style="color: #999;">{{ e(ucfirst(Str::lower($snippet->title))) }}</span>
        </div>
    </div>
</div>

<div class="row snippet-meta">
    <div class="span6">
        <p>Snippet title: <span class="details">{{ e(ucfirst(Str::lower($snippet->title))) }}</span></p>
        <p>Author: <span class="details">{{ e($snippet->user->first_name . ' ' . $snippet->user->last_name) }}</span></p>
        <p>Date Submitted: <span class="details">{{ e($snippet->created_at) }}</span></p>
        <p>Last Updated: <span class="details">{{ e($snippet->updated_at) }}</span></p>                    
    </div>

    <div class="span6 snippet-meta">
        <p>Description:</p>
        <span class="details">{{ e($snippet->description) }}</span>
    </div>
</div>

<div class="row">
    <div class="span12">

        <!-- twitter tweet -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-via="laravelsnippets">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        <!-- twitter tweet ENDS -->

        <pre id="snippet">

            <?php
            Bundle::start('sparkdown');
            //echo Sparkdown\Markdown(e($snippet->code));
            ?>

            <?php
            $text = Sparkdown\Markdown(e($snippet->code));
            echo $text = preg_replace_callback('$(<code>)([\s\S]+)(</code>)$i', function($matches)
            {
              return $matches[1] . preg_replace('/&amp;/i', '&', $matches[2]) . $matches[3];
            }, $text);
            ?>

        </pre>

        <!-- twitter tweet -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-via="laravelsnippets">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        <!-- twitter tweet ENDS -->

        <!-- disqus comment system -->
        <div id="disqus_thread"></div>
        
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'laravelsnippets'; // required: replace example with your forum shortname
            var disqus_identifier = '<?php echo $snippet->id; ?>';
            var disqus_title = '<?php echo $snippet->title; ?>';

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        <!-- disqus comment system ENDS -->

    </div>
</div>