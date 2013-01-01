
	
	<div class="container content-container">

		<div class="breadcrumb" style="margin-top:20px;">
	  		<a href="{{ action('members.snippets@index') }}">Manage snippets</a> / <span style="color: #999;">{{ ucfirst($snippet->title) }}</span>
	  	</div>

		@if(Session::has('errors'))
           @foreach(Session::get('errors') as $error)         
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert" href="#">×</a>{{ $error }}
                </div>
           @endforeach
        @endif
     
        @if(Session::has('success'))  
            <div class="alert alert-success">
                <a class="close" data-dismiss="alert" href="#">×</a>{{ Session::get('success') }}
            </div>
        @endif

	    <div class="row" style="margin-top: 20px;">
		    <div class="span12">

		     	<legend id="snippet-details" style="font-weight:bold; font-size:14px;">
		    		<p>Snippet title: <span class="details">{{ e($snippet->title) }}</span></p>
		    		<p>Author: <span class="details">{{ e($snippet->user->first_name . ' ' . $snippet->user->last_name) }}</span></p>
		    		<p>Date Submitted: <span class="details">{{ e($snippet->created_at) }}</span></p>
		    		<p>Last Updated: <span class="details">{{ e($snippet->updated_at) }}</span></p>
		    		<p>Description: <!-- <span class="details">{{ e($snippet->description) }}</span> --></p>
		    		<p class="details">{{ e($snippet->description) }}</p>
		    	</legend>

	
				<pre id="snippet" style="padding: 0px 30px 0px 30px;">

	        			
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

				<a href="{{ action('members.snippets@edit', array($snippet->id)) }}" class="btn btn-info">
		        	Edit
		        </a>

				<a href="#myModal-delete-{{ $snippet->id }}" role="button" class="btn btn-danger" data-toggle="modal">Delete</a>

	            <div class="modal hide" id="myModal-delete-{{ $snippet->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					 
					<div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					    <h3 id="myModalLabel">Are you sure you want to delete this snippet id: {{ $snippet->id }} ?</h3>
					</div>
					
					<div class="modal-footer">
					   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					   <a href="{{ action('members.snippets@delete', array($snippet->id)) }}?fromSingleView=1" class="btn btn-danger">Confirm Delete</a> 
					</div>

				</div>
			

			</div>
	    </div>
    
    </div>

    <script type="text/javascript">
		prettyPrint();
	</script>
    
