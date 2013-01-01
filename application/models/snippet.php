<?php

class Snippet extends Eloquent {
	
    public function tags()
    {
      	return $this->has_many_and_belongs_to('Tag', 'snippet_tag');
    }

    public function user()
    {
        return $this->belongs_to('User');
    }

}