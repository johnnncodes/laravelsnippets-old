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

<h3>Available snippets</h3>

<table id="properties-table" class="table table-striped table-hover">
	<thead>
      	<tr>
          	<th width="5%">ID</th>
          	<th width="77%">Title</th>
          	<th width="18%">Actions</span></th>                                           
      </tr>
  	</thead>   
	
	<tbody>

		@foreach($snippets->results as $snippet)

		    <tr>
		        <td class="center">{{ $snippet->id }}</td>
		        <td class="center" ><a class="title-link" href="{{ action('members.snippets@index', array($snippet->id)) }}">{{ e($snippet->title) }}</a></td>
		        <td class="center">
			        	
					<a href="{{ action('members.snippets@index', array($snippet->id)) }}" class="btn btn-info">
		        		View
		        	</a>
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
						   <a href="{{ action('members.snippets@delete', array($snippet->id)) }}" class="btn btn-danger">Confirm Delete</a> 
						</div>

					</div>

		        </td>                             
	    	</tr>
	    
		@endforeach
                               
	</tbody>
</table>

{{ $snippets->links() }}
    
