@layout('layouts.admin')

@section('content')
	
<div class="container content-container">
    <div class="row">
        <div class="span12">
            <h3>Add a tag</h3>
        
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

            <form method="Post" action="{{ action('admin.tags@add'); }}" accept-charset="UTF-8">
               
                {{ Form::token() }}

                <label for="name" class="control-label">Tag Name</label> 
                <input type="text" class="span4" name="name" placeholder="Put the tag name here">
                <br>
                <button type="submit" name="submit" class="btn btn-info margin-top-10">Submit</button>

            </form>    



        </div>
    </div>
</div>


@endsection 