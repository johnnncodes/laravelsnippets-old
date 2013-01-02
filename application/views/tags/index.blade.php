<div class="row">

	<div class="span12">

		<h3 style="font-family: helvetica; color:#333;; text-align:center; font-size: 3.8em;">snippets.tag.cloud</h3>

		<div id="tagcloud" style="max-width: 600px;text-align: center;word-wrap: break-word;padding-top:20px;margin:0 auto;">
			
	        @foreach($tags as $tag)
	        
	       		<a href="{{ action('tags@snippets', array(urlencode($tag->slug))) }}" rel="{{ rand(0.1, 10) }}">{{ Str::lower($tag->name) }}</a>
	            
	        @endforeach

		</div>

	</div>

</div>