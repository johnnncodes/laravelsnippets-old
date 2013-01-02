<div class="breadcrumb" style="margin-top:20px;">
    <a href="{{ action('members.snippets@index') }}">Manage snippets</a> / <span style="color: #999;">{{ ucfirst($snippet->title) }}</span>
</div>

<div class="row">
    <div class="span12">
        <h3>Edit a snippet</h3>
    
        @if(Session::has('errors'))
           @foreach($errors as $error)         
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

        <form method="Post" action="{{ action('members.snippets@edit'); }}" accept-charset="UTF-8">
           
            {{ Form::token() }}

            <input type="hidden" name="id" value="{{ e($snippet->id) }}">
            
            <label for="title" class="control-label">Title</label> 
            <input type="text" class="span4" name="title" placeholder="title" value="{{ e($snippet->title) }}">

            <label for="description" class="control-label">Description</label> 
            <textarea name="description" rows="3" id="description-txtarea" placeholder="description">{{ e($snippet->description) }}</textarea>

            <label for="snippet" class="control-label">Code Snippet</label> 

            <textarea name="snippet" id="markdown" rows="20" cols="60">{{ e($snippet->code) }}</textarea>

            <label for="tags" class="control-label">Tags</label> 
            {{ Form::select('tags[]', $tagsArray, $selectedTagIdsArray, array('class' => 'chzn-select', 'data-placeholder' => 'Choose tags', 'tabindex' => '4', 'multiple')) }}

            <br>

            <button type="submit" name="submit" class="btn btn-info margin-top-10">Submit</button>

        </form>    
        
    </div>
</div>


    
