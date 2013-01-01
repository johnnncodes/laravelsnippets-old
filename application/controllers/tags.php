<?php

class Tags_Controller extends Base_Controller {

    public function get_index()
    {
        $this->layout->content = View::make('tags.index')
                                    ->with('tags', Tag::order_by('created_at', 'desc')->get())
                                    ->with('currentPage', 'tags')
                                    ->with('pageTitle', 'Listing all tags | laravelsnippets.tk');
    }

    public function get_snippets($tagSlug)
    {
        $tag = Tag::with(array('snippets' => function($query)
                                {
                                    $query->where('published', '=', '1');

                                }))->where_slug($tagSlug)->first();

        $this->layout->content = View::make('tags.snippets')
                ->with('tag', $tag)
                // ->with('tags', Tag::all())
                ->with('currentPage', 'tags')
                ->with('pageTitle', 'Viewing tag | ' . $tag->name . ' | laravelsnippets.tk');
    }
        
}