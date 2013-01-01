<div class="row">
    <div class="span4 offset4 well">
        <legend>Please fill up the form to register</legend>
                    
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

        <form method="Post" action="{{ action('auth@register') }}" accept-charset="UTF-8">

            {{ Form::token() }}

            <label for="username" class="control-label">Username</label> 
            <input type="text" id="username" class="span4" name="username" placeholder="Enter your username">

            <label for="password" class="control-label">Password</label> 
            <input type="password" id="password" class="span4" name="password" placeholder="Enter your password">

            <label for="password" class="control-label">Re-type Password</label> 
            <input type="password" id="password-confirmation" class="span4" name="passwordConfirmation" placeholder="Re-type your password here">

            <label for="first_name" class="control-label">First Name</label> 
            <input type="text" id="firstiname" class="span4" name="firstName" placeholder="Enter your first name">

            <label for="last_name" class="control-label">Last Name</label> 
            <input type="text" id="last-name" class="span4" name="lastName" placeholder="Enter your last name">

            <label for="email_address" class="control-label">Email Address</label> 
            <input type="text" id="email-address" class="span4" name="emailAddress" placeholder="Enter your email address">
            
            <button type="submit" name="submit" class="btn btn-info btn-block">Register</button>

        </form>    

        <a href="{{ action('auth@login') }}">Sign In</a>
        |
        <a href="{{ action('pages@index') }}">Go back to home page</a>
    </div>
</div>