<?php

class Pages_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_index($page = null)
	{
		if ( ! is_null($page)) {
			$this->layout->content = View::make('pages.' . $page);	
							
		} else {

			$this->layout->content = View::make('pages.index')
				->with('snippets', Snippet::all());
		}
	}

}