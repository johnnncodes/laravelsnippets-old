<?php

class Tag extends Eloquent {
        
    public function snippets()
    {
      return $this->has_many_and_belongs_to('Snippet', 'snippet_tag');
    }

}