<legend>Please sign in to submit a snippet</legend>
            
            @if (Session::has('login_errors'))
                <div class="alert alert-error">
                    <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
                </div>
            @endif

            @if(Session::has('success'))  
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert" href="#">×</a>{{ Session::get('success') }}
                </div>
            @endif

            <form method="Post" action="{{ action('auth@login') }}" accept-charset="UTF-8">
                {{ Form::token() }}
                <label for="username" class="control-label">Username</label> 
                <input type="text" id="username" class="span4" name="username" placeholder="Input your username">
                <label for="password" class="control-label">Password</label> 
                <input type="password" id="password" class="span4" name="password" placeholder="Input your password">
                <button type="submit" name="submit" class="btn btn-info btn-block">Sign in</button>
            </form>  

                    <a href="{{ action('auth@register') }}">Register</a>
                    |
                    <a href="{{ action('home@index') }}">Go back to home page</a>