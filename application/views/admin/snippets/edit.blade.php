@layout('layouts.admin')

@section('content')
	
<div class="container content-container">
    <div class="row">
        <div class="span12">
            <h3>Edit a snippets:</h3>

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

            <form method="Post" action="{{ action('admin.snippets@edit'); }}" accept-charset="UTF-8">
               
                {{ Form::token() }}

                <input type="hidden" name="id" value="{{ e($snippet->id) }}">

               <!--  <label for="name" class="control-label">Your name</label> 
                <input type="text" class="span4" name="name" placeholder="name" value="{{ e($snippet->author) }}"> -->
                
                <label for="title" class="control-label">Title</label> 
                <input type="text" class="span4" name="title" placeholder="title" value="{{ e($snippet->title) }}">

                <label for="description" class="control-label">Description</label> 
                <textarea name="description" rows="3" id="description-txtarea" placeholder="description">{{ e($snippet->description) }}</textarea>

                <label for="snippet" class="control-label">Code Snippet</label> 
               <!--  <textarea name="snippet" id="snippet-txtarea" rows="3" placeholder="type or paste you snippet here" ></textarea> -->

               <textarea name="snippet" id="markdown" rows="20" cols="60">{{ e($snippet->code) }}</textarea>
               
               <label for="tags" class="control-label">Tags</label> 
               {{ Form::select('tags[]', $tagsArray, $selectedTagIdsArray, array('class' => 'chzn-select', 'data-placeholder' => 'Choose tags', 'tabindex' => '4', 'multiple')) }}

              
                <label for="publish" class="control-label">Publish</label> 
                {{ Form::select('publish', array('0' => 'No', '1' => 'Yes')) }}
                <br>

                <button type="submit" name="submit" class="btn btn-info margin-top-10">Submit</button>

            </form>    
            
        </div>
    </div>
</div>


<script type="text/javascript">

 var editor = CodeMirror.fromTextArea(document.getElementById("snippet-txtarea"), {
    lineNumbers: true,
    mode: 'application/x-httpd-php',
    theme: 'ambiance',
    matchBrackets: true,
    indentUnit: 4,
    indentWithTabs: true,
    enterMode: "keep",
    tabMode: "shift",
    onChange: function() {
      // updatePreview();
      //clearTimeout(delay);
      //delay = setTimeout(updatePreview, 300);
    }
  });
 
</script>


    
@endsection 