<?php
 
class Feed_Controller extends Controller
{
        public $restful = true;

        /**
         * Catch-all method for requests that can't be matched.
         *
         * @param  string    $method
         * @param  array     $parameters
         * @return Response
         */
        public function __call($method, $parameters)
        {
                return Response::error('404');
        }

        public function get_index()
        {
                $feed = Feed::make();
                 
                $feed->webmaster('John Kevin M. Basco')
                ->author('John Kevin M. Basco')
                ->rating('SFW')
                ->pubdate(time())
                ->ttl(60)
                ->title('A repository of code snippets for Laravel framework | laravelsnippets.tk')
                ->description('Newest snippets on laravelsnippets.tk')
                ->copyright('(c) '.date('Y').' laravelsnippets.tk')
                ->permalink(URL::home().'/feed')
                ->category('PHP')
                ->language('en_EN')
                ->baseurl(URL::home());
                 
                // get latest 20 posts
                $snippets = Snippet::order_by('created_at','desc')->where_published(1)->take(20)->get();
                 
                foreach ($snippets as $snippet) {
                        $feed->entry()->published($snippet->created_at)
                        //->content()->add('text', $snippet->text)->up()
                        //->content()->add('html', HTML::decode($snippet->code).'<br><a href="'.action('snippets@view_snippet', array($snippet->id)).'">')->up()
                        ->title()->add('text',$snippet->title)->up()
                        ->permalink(action('snippets@view_snippet', array($snippet->id)))
                        ->author()->name('By '.$snippet->user_id)->up()
                        ->updated($snippet->updated_at);
                }
                 
                $feed->Rss20();
                // this is a shortcut for calling $feed->feed()->send(...);
                // you can also just $feed->Rss20(), Rss092() or Atom();
        }

        public function get_indexbackup()
        {
                $feed = Feed::make();
                 
                $feed->logo(asset('img/logo.jpg'))
                ->icon(URL::home().'favicon.ico')
                ->webmaster('John Kevin M. Basco')
                // ->author&nbsp;&nbsp; ('John Kevin M. Basco')
                ->author('John Kevin M. Basco')
                ->rating('SFW')
                ->pubdate(time())
                ->ttl(60)
                ->title('Laravel Snippets')
                ->description('Newest snippets on laravelsnippets.tk')
                ->copyright('(c) '.date('Y').' laravelsnippets.tk')
                ->permalink(URL::home().'/feed')
                ->category('PHP')
                ->language('en_EN')
                ->baseurl(URL::home());
                 
                // get latest 20 posts
                $snippets = Snippet::order_by('created_at','desc')->take(20)->get();
                 
                foreach ($snippets as $snippet) {
                        $feed->entry()->published($snippet->created_at)
                        ->content()->add('text', $snippet->text)->up()
                        ->content()->add('html', HTML::decode($snippet->code).'<br><a href="'.action('snippets@view_snippet', array($snippet->id)).'">')->up()
                        ->title()->add('text',$snippet->title)->up()
                        ->permalink(action('snippets@view_snippet', array($snippet->id)))
                        ->author()->name('By '.$snippet->user_id)->up()
                        ->updated($snippet->updated_at);
                }
                 
                $feed->Rss20();
                // this is a shortcut for calling $feed->feed()->send(...);
                // you can also just $feed->Rss20(), Rss092() or Atom();
        }
 
}