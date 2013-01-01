<?php

class Snippets_Controller extends Base_Controller {

	public function get_index()
	{
		$this->layout->content = View::make('snippets.index')->with('snippets', Snippet::all());
	}

}