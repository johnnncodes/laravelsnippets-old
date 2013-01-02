<div class="breadcrumb">
    <a href="{{ action('home@index') }}">Home</a> / <a href="{{ action('tags@index') }}">Tags</a> / <span style="color: #999;">{{ e(ucfirst(Str::lower($tag->name))) }}</span>
</div>

<h3>Snippets tagged with "{{ $tag->name }}"</h3>

<table id="properties-table" class="table table-striped table-hover">
        
    <thead>
        <tr>
            <th width="5%">ID</th>
            <th width="90%">Title</th>
            <th width="5%">Actions</th>                                           
        </tr>
    </thead>   

    <tbody>

        <?php $snipps = $tag->snippets()->where_published(1)->paginate(10); ?>

        @foreach($snipps->results as $snippet)

            <tr>
                <td class="center">{{ $snippet->id }}</td>
                <td class="center" ><a class="title-link" href="{{ action('snippets@index', array($snippet->id)) }}">{{ e($snippet->title) }}</a></td>
                <td class="center">
                        <a href="{{ action('snippets@index', array($snippet->id)) }}" class="btn btn-info">
                                View
                        </a>
                </td>                                                     
        </tr>
    
        @endforeach

    </tbody>
</table>

{{ $snipps->links() }}