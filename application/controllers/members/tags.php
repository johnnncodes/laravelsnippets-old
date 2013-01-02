<?php

class Members_Tags_Controller extends Base_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->layout = View::make('layouts.memberscpanel');
	    $this->layout->pageTitle = 'Laravelsnippets.tk is a repository of snippets for Laravel framework | laravelsnippets.tk';
	    $this->filter('before', 'auth');
	}

	public function get_add()
	{
		$this->layout->content = View::make('members.tags.add');
	}

	public function post_add()
	{
		$input = Input::all();
	    $rules = array(
            'name' => 'required|max:25|unique:tags',
        );
		$validation = Validator::make($input, $rules);
		if ($validation->fails())
		{
		    return Redirect::back()->with_errors($validation);
		}

		// save
		$tag = New Tag;
		$tag->name = Input::get('name');
		$tag->slug = Str::slug(Input::get('name'));
		$tag->user_id = Auth::user()->id;
		$tag->ip = Request::ip();

		if ($tag->save()) {
			return Redirect::back()->with('success', 'Tag successfuly added!');	
		} else {
			return Redirect::back()->with_errors($tag->errors->all());
		}
	}

}