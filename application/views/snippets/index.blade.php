<h3>Available snippets:</h3>

<table id="properties-table" class="table table-striped table-hover">

    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Actions</th>                                           
        </tr>
    </thead>   

    <tbody>

        @foreach($snippets->results as $snippet)

            <tr>
                <td class="center">{{ $snippet->id }}</td>
                <td class="center"><a class="title-link" href="{{ action('snippets@index', array($snippet->id)) }}">{{ e(ucfirst(Str::lower($snippet->title))) }}</a></td>
                <td class="center"><a class="title-link" href="{{ action('snippets@index', array($snippet->id)) }}">{{ e($snippet->user->first_name . ' ' . $snippet->user->last_name) }}</a></td>
                <td class="center"><a href="{{ action('snippets@index', array($snippet->id)) }}" class="btn btn-info">View</a></td>                                                     
            </tr>
    
        @endforeach

    </tbody>

</table>

{{ $snippets->links() }}

