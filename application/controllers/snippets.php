<?php

class Snippets_Controller extends Base_Controller {

    public function get_index($id = null)
    {
        $this->layout->currentPage = 'snippets';

        if ( ! is_null($id) ) {
            if ($count = Snippet::where_id_and_published($id, 1)->count() < 1) {
                return Response::error('404');
            }

            $snippet = Snippet::with(array('user'))->where_id($id)->first();

            $this->layout->content = View::make('snippets.single')->with('snippet', $snippet);
                        
            $this->layout->pageTitle = 'Viewing snippet | ' . $snippet->title . ' | laravelsnippets.tk';                            

        } else {
            // get all snippets that are already published
            $this->layout->content = View::make('snippets.index')->with('snippets', Snippet::where_published(1)->order_by('created_at', 'desc')->paginate(10));

            $this->layout->pageTitle = 'Listing all snippets | laravelsnippets.tk';   
        }
    }

}