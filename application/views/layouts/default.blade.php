<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="Repository of useful code snippets for the awesome Laravel framework">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta name="author" content="John Kevin M. Basco">
    <meta name="keywords" content="laravelsnippets, laravelsnippets.tk, laravel snippets, laravel snippets website, http://laravelsnippets.tk/, www.laravelsnippets.tk, https://laravelsnippets.tk/, laravel, snippets for laravel">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>


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
    
</head>
<body>

    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
    <![endif]-->
    
   <div class="container">
      <div class="row">
        <div class="span12">
          <div class="masthead">
            <ul class="nav nav-pills pull-right">
              <li class="{{ ($currentPage === 'home') ? 'active' : '' }}"><a href="{{ action('pages@index') }}">Home</a></li>
              <li class="{{ ($currentPage === 'snippets') ? 'active' : '' }}"><a href="{{ action('snippets@index') }}">Snippets</a></li>
              <li class="{{ ($currentPage === 'tags') ? 'active' : '' }}"><a href="{{ action('tags@index') }}">Tags</a></li>
              <li class="{{ ($currentPage === 'about') ? 'active' : '' }}"><a href="{{ action('pages@index') }}pages/about">About</a></li>
              <li class="{{ ($currentPage === 'submit') ? 'active' : '' }}"><a href="{{ action('auth@login') }}">Submit</a></li>
            </ul>
            <a href="{{ action('pages/index') }}"><h3 class="muted">Laravel Snippets</h3></a>
          </div>
       </div>
     </div>
            {{ $content }}

             <div class="push"><!-- / / --></div> <!-- /push -->
        


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

    <!-- SCRIPTS ENDS -->
</body>
</html>