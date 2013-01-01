@layout('layouts.admin')

@section('content')
	
	<div class="container content-container">

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

		<h3>Avalable tags</h3>

		<table id="properties-table" class="table table-striped table-hover">
			<thead>
		      	<tr>
		          	<th width="5%">ID</th>
		          	<th width="40%">Name</th>
		          	<th width="40%">Slug</th>   
		          	<th width="12%">Actions</th>                                          
		      </tr>
		  	</thead>   
		<tbody>

		@foreach($tags->results as $tag)

		    <tr>
		        <td class="center">{{ $tag->id }}</td>
		        <td class="center">{{ e($tag->name) }}</td>
		        <td class="center">{{ e($tag->slug) }}</td>
		        <td class="center">        	

		        	<a href="{{ action('admin.tags@edit', array($tag->id)) }}" class="btn btn-info">
		        		Edit
		        	</a>

		        	<a href="#myModal-delete-{{ $tag->id }}" role="button" class="btn btn-danger" data-toggle="modal">Delete</a>

		            <div class="modal hide" id="myModal-delete-{{ $tag->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						 
						<div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						    <h3 id="myModalLabel">Are you sure you want to delete this tag id: {{ $tag->id }} ?</h3>
						</div>
						
						<div class="modal-footer">
						   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
						   <a href="{{ action('admin.tags@delete', array($tag->id)) }}" class="btn btn-danger">Confirm Delete</a> 
						</div>

					</div>

		        </td>                             
	    	</tr>
	    
		@endforeach

	
                                 
  </tbody>
</table>

	{{ $tags->links() }}
    
    </div>

@endsection