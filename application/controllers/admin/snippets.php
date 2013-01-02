<?php

class Admin_Snippets_Controller extends Base_Controller {

	public function __construct()
	{
	    parent::__construct();
	    $this->filter('before', 'auth');

	    $this->layout = View::make('layouts.cpanel');
	    $this->layout->pageTitle = 'Laravelsnippets.tk is a repository of snippets for Laravel framework | laravelsnippets.tk';

		if (Auth::check()) { // auth check to avoid trying to get property of non object error. dirty fix.
			// validate if the user is an admin
		    $userGroup = UserGroup::find(Auth::user()->user_groups_id);

		    if ($userGroup->group_name != 'admin') {
		    	die('cheating????! You are not allowed here.');
		    }
		}
	}

	public function get_index($id = null)
	{
		if ( ! is_null($id)) {

			if ($count = Snippet::where_id($id)->count() < 1) {
				return Response::error('404');
			}

			$this->layout->content = View::make('admin.snippets.single')
											->with('snippet', Snippet::where_id($id)->first());

		} else {
			$this->layout->content = View::make('admin.snippets.index')
										->with('snippets', Snippet::order_by('created_at', 'desc')->paginate(10));
		}

		
	}

	public function get_submit()
	{
		return View::make('admin.snippets.submit')
			->with('tagsArray', Tag::lists('name', 'id'));
	}

	public function post_submit()
	{		
		$snippet = New Snippet;
		$snippet->title = Input::get('title');
		$snippet->description = Input::get('description');
		$snippet->code = Input::get('snippet');
		$snippet->user_id = Auth::user()->id;
		$snippet->published = Input::get('publish');
		$snippet->ip = Request::ip();

		// validate if the number of tags exceeds the allowed to be chosen
		if (count(Input::get('tags')) > 3) {
			return Redirect::back()->with_errors(array('Sorry, you can only pick 3 maximum tags'));
		}

		// check if the submitted tag id's exists
		if (Input::get('tags')) {
			foreach (Input::get('tags') as $tagId) {
			
				$count = Tag::where_id($tagId)->count();

				if ($count != 1) {
					return Redirect::back()->with_errors(array('are you cheating? one of the tags you chose doesn\'t exist!'));
				}

			}
		}
		
		if ($snippet->save()) {

			// relate the snippet and the tags if the user has chosen some tags
			if (Input::get('tags')) {

				$snippet->tags()->sync(Input::get('tags'));
			}

			return Redirect::back()->with('success', 'Snippet successfuly added!');
				
		} else {
			return Redirect::back()->with_errors($snippet->errors->all());
		}
	}

	public function get_publish($id)
	{
		$snippet = Snippet::where_id($id)->first();
		$snippet->published = 1;

		if ($snippet->save()) {
			return Redirect::back()->with('success', 'Snippet successfuly published!');	
		} else {
			return Redirect::back()->with_errors($snippet->errors->all());
		}
	}

	public function get_delete($id)
	{
		$snippet = Snippet::find($id);

		// delete relationships between the snippets to be deleted and the tags
		$snippet->tags()->delete();

	 	$fromSingleView = Input::get('fromSingleView');

		if ($snippet->delete()) {

			if ($fromSingleView == 1) {
				return Redirect::to_action('admin.snippets@index')->with('success', 'Snippet successfuly deleted!');
			}

			return Redirect::back()->with('success', 'Snippet successfuly deleted!');	

		} else {

			if ($fromSingleView == 1) {
				return Redirect::to_action('admin.snippets@index')->with_errors(array('Deleting failed!'));
			}
			
			return Redirect::back()->with_errors(array('Deleting failed!'));

		}
	}

	public function get_edit($id)
	{
		if ($count = Snippet::where_id($id)->count() < 1) {
			return Response::error('404');
		}

		$snippet = Snippet::find($id);

		$selectedTagIdsArray = array();
		$selectedTagIdsArray = $snippet->tags()->lists('id');

		$this->layout->content = View::make('admin.snippets.edit')
									->with('snippet', $snippet)
									->with('tagsArray', Tag::lists('name', 'id'))
									->with('selectedTagIdsArray', $selectedTagIdsArray);
	}

	public function post_edit()
	{
		$snippet = Snippet::find(Input::get('id'));

		// $snippet->user_id = Auth::user()->id; // not required, because this will update link the snippet to the current logged in admin
		$snippet->title = Input::get('title');
		$snippet->description = Input::get('description');
		$snippet->code = Input::get('snippet');
		$snippet->published = Input::get('publish');

		// validate if the number of tags exceeds the allowed to be chosen
		if (count(Input::get('tags')) > 3) {
			return Redirect::back()->with_errors(array('Sorry, you can only pick 3 maximum tags'));
		}

		// check if the submitted tag id's exists
		if (Input::get('tags')) {
			foreach (Input::get('tags') as $tagId) {
			
				$count = Tag::where_id($tagId)->count();

				if ($count != 1) {
					return Redirect::back()->with_errors(array('are you cheating? one of the tags you chose doesn\'t exist!'));
				}
			}
		}

		if ($snippet->save()) {

			// relate the snippet and the tags if the user has chosen some tags
			if (Input::get('tags')) {

				$snippet->tags()->sync(Input::get('tags'));
			}

			return Redirect::back()->with('success', 'Snippet successfully updated!');
		}

		return Redirect::back()->with_errors( $snippet->errors->all() );
	}


}