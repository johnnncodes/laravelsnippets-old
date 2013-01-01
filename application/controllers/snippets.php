<?php

class Snippets_Controller extends Base_Controller {

    public function get_index($id = null)
    {
        if ( ! is_null($id) ) {
            if ($count = Snippet::where_id_and_published($id, 1)->count() < 1) {
                return Response::error('404');
            }

            $snippet = Snippet::with(array('user'))->where_id($id)->first();

            $this->layout->content = View::make('snippets.single')
                    ->with('currentPage', 'snippets')
                    ->with('snippet', $snippet)
                    ->with('pageTitle', 'Viewing snippet | ' . $snippet->title . ' | laravelsnippets.tk');
        } else {
            // get all snippets that are already published
            $this->layout->content = View::make('snippets.index')
                    ->with('currentPage', 'snippets')
                    ->with('snippets', Snippet::where_published(1)->order_by('created_at', 'desc')->paginate(10))
                    ->with('pageTitle', 'Listing all snippets | laravelsnippets.tk'); 
        }
    }

    public function get_submit()
    {
            return View::make('snippets.submit')
                    ->with('currentPage', 'submit-snippets')
                    ->with('pageTitle', 'Submit a useful Laravel code snippet to laravelsnippets.tk | laravelsnippets.tk');
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
            
            $interval =     with(new \DateInterval('PT15M'));

            $currentDateTimeMinus15mins = with(new \DateTime)->sub($interval)->format('Y-m-d H:i:s');       


            if ($currentDateTimeMinus15mins < $lastPosted ) { // check if user has posted for the last 15 mins
                    return Redirect::back()->with_errors(array('Sorry you are only allowed to post once every 15 minutes. Please try again later.'));
            }

            // if we reach here, it means we are good to save! So lets commence saving! ;)
            $snippet = New Snippet;
            $snippet->title = Input::get('title');
            $snippet->description = Input::get('description');
            $snippet->code = Input::get('snippet');
            $snippet->author = Input::get('name');
            $snippet->published = 0;
            $snippet->ip = Request::ip();


            if ($snippet->save()) {
                    return Redirect::back()->with('success', 'Snippet successfuly submitted to be reviewed by the admin.'); 
            } else {
                    return Redirect::back()->with_errors($snippet->errors->all());
            }
    }


}