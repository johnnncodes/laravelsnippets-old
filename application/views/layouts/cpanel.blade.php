<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{ $page_title }}</title>
    <meta name="description" content="Repository of useful code snippets for the awesome Laravel framework">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta name="author" content="John Kevin M. Basco">
    <meta name="keywords" content="laravelsnippets, laravelsnippets.tk, laravel snippets, laravel snippets website, http://laravelsnippets.tk/, www.laravelsnippets.tk, https://laravelsnippets.tk/, laravel, snippets for laravel">

    <style>
        body {
            /*padding-top: 60px;*/
            padding-bottom: 40px;
        }

         /* Main marketing message and sign up button */
        .jumbotron {
          margin: 60px 0;
          text-align: center;
        }
        .jumbotron h1 {
          font-size: 72px;
          line-height: 1;
        }
        .jumbotron .btn {
          font-size: 21px;
          padding: 14px 24px;
        }

        /*custom by kebs*/
        a.title-link{
          color: #4C4C4C!important;
        }
          .container-narrow {
    
          max-width: 1024px;
        

        }
    </style>

    {{ Asset::container('bootstrapper')->styles() }}
    {{ HTML::style('css/main.css') }}
    {{ HTML::script('js/modernizr-2.6.1-respond-1.1.0.min.js') }}
    
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('img/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('img/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('img/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('img/apple-touch-icon-57-precomposed.png') }}">

    <!-- google prettify -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to_asset('highlighter/prettify-bootsnipptheme.css') }}">
    <!-- google prettify ENDS -->


    <!-- google analytics -->
    <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35644921-1']);
    _gaq.push(['_trackPageview']);

    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    </script>

    <!-- chosen plugin -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to_asset('chosen/chosen.css') }}">
    <!-- chosen plugin ends -->
    
</head>
<body>

    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
    <![endif]-->
    

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="{{ URL::base() }}">Laravel Snippets</a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Snippets <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="nav-header">Actions</li>
                                <li><a href="{{ action('admin.snippets@submit') }}">Add</a></li>
                                <li><a href="{{ action('admin.snippets@index') }}">Manage</a></li>
                            </ul>
                            
                        </li>

                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Tags <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="nav-header">Actions</li>
                                <li><a href="{{ action('admin.tags@add') }}">Add</a></li>
                                <li><a href="{{ action('admin.tags@manage') }}">Manage</a></li>
                            </ul>
                        </li>

                    </ul>
                   
                </div><!--/.nav-collapse -->

                <div class="pull-right">
                    <ul class="nav pull-right">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, User <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-cog"></i> Preferences(Soon)</a></li>
                                <li><a href="#"><i class="icon-envelope"></i> Contact Support(Soon)</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ action('auth@logout') }}"><i class="icon-off"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div> <!-- /navbar -->



   <div class="container">
      <div class="row">
        <div class="span12">
          <div class="masthead">
            <ul class="nav nav-pills pull-right">
              <li class="active"><a href="{{ action('pages@index') }}">Home</a></li>
              <li><a href="{{ action('snippets@index') }}">Snippets</a></li>
              <li><a href="{{ action('tags@index') }}">Tags</a></li>
              <li><a href="{{ action('pages@index') }}pages/index/about">About</a></li>
              <li><a href="{{ action('auth@login') }}">Submit</a></li>
            </ul>
            <h3 class="muted">Laravel Snippets</h3>
          </div>
       </div>
     </div>
            {{ $content }}

                 <div class="footer">
        <p>&copy; John Kevin M. Basco | Mayon Volcano Software Ltd.</p>
      </div>

   </div> <!-- /container-narrow -->

    <!-- SCRIPTS -->

        {{ Asset::container('bootstrapper')->scripts() }}
        
        <!-- jquery src -->
        <script>window.jQuery || document.write('<script src="../../../public/js/jquery-1.8.1.min.js"><\/script>')</script>
        <!-- jquery src ENDS -->

        {{ HTML::script('js/plugins.js') }}
        {{ HTML::script('js/main.js') }}

        <!-- google prettify scripts -->
        <script src="{{ URL::to_asset('highlighter/prettify.js') }}" type="text/javascript"></script>
        <!-- google prettify scripts ENDS -->

        <!-- add pretty print class and run prettyprint to snippets -->
        <script type="text/javascript">
            $('#snippet').find('code').addClass('prettyprint linenums'); prettyPrint();
        </script>
        <!-- add pretty print class and run prettyprint to snippets ENDS -->

        <!-- jquery tag cloud -->
        <script src="{{ URL::to_asset('jquery-tagcloud/jquery.tagcloud.js') }}" type="text/javascript"></script>

        <script type="text/javascript">

        $.fn.tagcloud.defaults = {
          size: {start: 14, end: 18, unit: 'pt'},
          color: {start: '#cde', end: '#f52'}
        };

        $('#tagcloud a').tagcloud();

        </script>
        <!-- jquery tag cloud ENDS -->

        <!-- facebook like -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=442613049110428";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <!-- facebook like ENDS -->

        <!-- chosen-->
        <script src="{{ URL::to_asset('chosen/chosen.jquery.min.js') }}"></script>

        <script type="text/javascript">

            $(".chzn-select").chosen();
            
        </script>

    <!-- SCRIPTS ENDS -->
</body>
</html>