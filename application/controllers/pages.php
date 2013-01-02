<?php

class Pages_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_index()
	{
		$this->layout->content = View::make('pages.index')->with('snippets', Snippet::order_by('created_at', 'desc')->take(5)->get());
		$this->layout->currentPage = 'home';
	}

	public function get_about()
	{
		$this->layout->content = View::make('pages.about');
		$this->layout->pageTitle = 'About laravelsnippets.tk | laravelsnippets.tk'; 
		$this->layout->currentPage = 'about';
	}

}