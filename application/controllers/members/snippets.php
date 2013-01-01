<?php

class Members_Snippets_Controller extends Base_Controller {

	public $restful = true;

	public function __construct()
	{
	    parent::__construct();
	    $this->filter('before', 'auth');
	    $this->layout = View::make('layouts.memberscpanel');
	    $this->layout->page_title = 'Laravelsnippets.tk is a repository of snippets for Laravel framework | laravelsnippets.tk';

	}

	public function get_index($id = null)
	{
		if ( ! is_null($id) ) {

			if ($count = Snippet::where_id_and_user_id($id, Auth::user()->id)->count() < 1) {
				return Response::error('404');
			}

			$this->layout->content = View::make('members.snippets.single')
										->with('currentPage', 'snippets')
										->with('snippet', Snippet::where_id($id)->first());

		} else {
			$this->layout->content = View::make('members.snippets.index')
										->with('currentPage', 'snippets')
										->with('snippets', Snippet::where_user_id(Auth::user()->id)->paginate(10)); 
		}


	}

	public function get_submit()
	{
		$this->layout->content = View::make('members.snippets.submit')
									->with('currentPage', 'submit-snippets')
									->with('tagsArray', Tag::lists('name', 'id'));
	}

	public function post_submit()
	{

		// SELECT * FROM `snippets` WHERE `ip` = '::1' and 
		// DATE_SUB(DATE_ADD(NOW(),INTERVAL 5 HOUR),INTERVAL 0.25 HOUR) < `created_at`

		// current time less than 15 mins
		//return $deadline = with(new \DateTime)->sub(new \DateInterval('PT15M'))->format('Y-m-d H:i:s'); 
		
		// current time
		//return $deadline = with(new \DateTime)->format('Y-m-d H:i:s'); 

		// check if user havent posted within the last 15 mins
		//$notAllowed = DB::query("SELECT COUNT(*) AS count FROM `snippets` WHERE `ip` = '::1' and DATE_SUB(DATE_ADD(NOW(),INTERVAL 6 HOUR),INTERVAL 0.25 HOUR) < `created_at");

		//return $notAllowed[0]->count;


		// current time less than 15 mins
		//return $deadline = with(new \DateTime)->sub(new \DateInterval('PT15M'))->format('Y-m-d H:i:s'); 






		$lastPostedDateTime = Snippet::where_ip(Request::ip())
									->order_by('created_at', 'desc')
									->first();

		//return print_r($lastPostedDateTime);

		// return $lastPostedDateTime->created_at;

		// current time less than 15 mins
		//$currentDateTimeMinus15mins = with(new \DateTime)->sub(new \DateInterval('PT15M'))->format('Y-m-d H:i:s'); 

		if (is_null($lastPostedDateTime)) {
			$lastPosted = 0;
		} else {
			$lastPosted = $lastPostedDateTime->created_at;
		}
		
		$interval =	with(new \DateInterval('PT15M'));

		$currentDateTimeMinus15mins = with(new \DateTime)->sub($interval)->format('Y-m-d H:i:s'); 	


		if ($currentDateTimeMinus15mins < $lastPosted ) { // check if user has posted for the last 15 mins
			return Redirect::back()->with_errors(array('Sorry you are only allowed to post once every 15 minutes. Please try again later.'));
		}

		// if we reach here, it means we are good to save! So lets commence saving! ;)
		$snippet = New Snippet;
		$snippet->title = Input::get('title');
		$snippet->description = Input::get('description');
		$snippet->code = Input::get('snippet');
		$snippet->user_id = Auth::user()->id;
		$snippet->published = 0;
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
			
			return Redirect::back()->with('success', 'Snippet successfuly submitted to be reviewed by the admin.');	
		} else {
			return Redirect::back()->with_errors($snippet->errors->all());
		}
	}

	// public function get_view_snippet($id)
	// {
	// 	// validate
	// 	// if ($count = Snippet::where_id($id)->count() < 1) {
	// 	// 	return Response::error('404');
	// 	// }

	// 	// validate if the user is the owner of the snippet
	// 	if ($count = Snippet::where_id_and_user_id($id, Auth::user()->id)->count() < 1) {
	// 		return Response::error('404');
	// 	}

	// 	return View::make('members.snippets.single')
	// 		->with('currentPage', 'snippets')
	// 		->with('snippet', Snippet::where_id($id)->first());
	// }

	public function get_edit($id)
	{
		// validate if the user is the owner of the snippet
		if ($count = Snippet::where_id_and_user_id($id, Auth::user()->id)->count() < 1) {
			return Response::error('404');
		}

		$snippet = Snippet::find($id);

		$selectedTagIdsArray = array();
		$selectedTagIdsArray = $snippet->tags()->lists('id');

		$this->layout->content = View::make('members.snippets.edit')
			->with('snippet', $snippet)
			->with('tagsArray', Tag::lists('name', 'id'))
			->with('selectedTagIdsArray', $selectedTagIdsArray);
	}

	public function post_edit()
	{
		// validate if the user is the owner of the snippet
		if ($count = Snippet::where_id_and_user_id(Input::get('id'), Auth::user()->id)->count() < 1) {
			return Response::error('404');
		}

		$snippet = Snippet::find(Input::get('id'));

		$snippet->user_id = Auth::user()->id;
		$snippet->title = Input::get('title');
		$snippet->description = Input::get('description');
		$snippet->code = Input::get('snippet');
		$snippet->published = 0;

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


	public function get_delete($id)
	{
		// validate if the user is the owner of the snippet
		if ($count = Snippet::where_id_and_user_id($id, Auth::user()->id)->count() < 1) {
			return Response::error('404');
		}

		// return $id;
		$snippet = Snippet::where_id_and_user_id($id, Auth::user()->id);

		// remove relationships
		$snippet->tags()->delete();

		// return $snippet->title;

	 	$fromSingleView = Input::get('fromSingleView');

	 	// return $fromSingleView;

		if ($snippet->delete()) {

			if ($fromSingleView == 1) {
				return Redirect::to_action('members.snippets@index')->with('success', 'Snippet successfuly deleted!');
			}

			return Redirect::back()->with('success', 'Snippet successfuly deleted!');	

		} else {

			if ($fromSingleView == 1) {
				return Redirect::to_action('members.snippets@index')->with_errors(array('Deleting failed!'));
			}
			
			return Redirect::back()->with_errors(array('Deleting failed!'));


		}
	}

}