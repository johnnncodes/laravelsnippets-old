<?php

class Base_Controller extends Controller {

	public $restful = true;

	public $layout = 'layouts.default';

	public function __construct()
	{
		parent::__construct();
		$this->filter('before', 'csrf')->on('post');
		$this->layout->pageTitle = 'Laravelsnippets.tk is a repository of snippets for Laravel framework | laravelsnippets.tk';

	}

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



}