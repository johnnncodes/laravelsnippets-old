<?php

class Tags_Controller extends Base_Controller {

    public function get_index()
    {
        $this->layout->content = View::make('tags.index')
                                    ->with('tags', Tag::order_by('created_at', 'desc')->get());

        $this->layout->pageTitle = 'Listing all tags | laravelsnippets.tk';   
        $this->layout->currentPage = 'tags';                            
    }

    public function get_snippets($tagSlug)
    {
        $tag = Tag::with(array('snippets' => function($query)
                                {
                                    $query->where('published', '=', '1');

                                }))->where_slug($tagSlug)->first();

        $this->layout->content = View::make('tags.snippets')
                ->with('tag', $tag);
        $this->layout->currentPage = 'tags';
        $this->layout->pageTitle = 'Viewing tag | ' . $tag->name . ' | laravelsnippets.tk';
    }
        
}