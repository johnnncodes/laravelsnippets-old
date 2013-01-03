<?php

class Auth_Controller extends Base_Controller {

    public function get_login()
    {
        if (Auth::check())
        {
            $userGroup = UserGroup::find(Auth::user()->user_groups_id);

            if ($userGroup->group_name != 'admin') {
                return Redirect::to_action('members.snippets@index');
            }

            return Redirect::to_action('admin.snippets@index');
        }

        $this->layout->content = View::make('auth.login');
        $this->layout->currentPage = 'submit';
    }

    public function post_login() 
    {
        // to hash a password
        // return $pass = Hash::make('admin');

        $username = Input::get('username');
        $password = Input::get('password');

        $credentials = array(
            'username' => $username, 
            'password' => $password,
        );

        if (Auth::attempt($credentials)) {

            $userGroup = UserGroup::find(Auth::user()->user_groups_id);

            if ($userGroup->group_name == 'admin') {
                return Redirect::to_action('admin.snippets@index');
            } 

            return Redirect::to_action('members.snippets@index');

        } else {
            return Redirect::to_action('auth@login')->with('login_errors', true);
        }
    }

    public function get_register()
    {
        $this->layout->content = View::make('auth.register');
        $this->layout->currentPage = 'submit';
        $this->layout->pageTitle = 'registration | laravelsnippets.tk';
    }

    public function post_register()
    {
        $input = array(
            'username' => Input::get('username'),
            'password'=> Input::get('password'),
            'passwordConfirmation'=> Input::get('passwordConfirmation'),
            'first_name' => Input::get('firstName'),
            'last_name' => Input::get('lastName'),
            'email_address' => Input::get('emailAddress'),
        );

        $rules = array(
            'username' => 'required|min:6|max:16|unique:users',
            'password' => 'required|min:6|max:16',
            'passwordConfirmation' => 'required|min:6|max:16|same:password',
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email_address' => 'required|email|unique:users|max:100',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Redirect::back()->with('errors', $validation->errors->all());
        }

        $user = New User;

        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        $user->first_name = Input::get('firstName');
        $user->last_name = Input::get('lastName');
        $user->email_address = Input::get('emailAddress');
        $user->user_groups_id = 2;
        $user->ip = Request::ip();

        if ($user->save()) {
            return Redirect::back()->with('success', 'Successfully Registered! You may now sign in.');
        } else {
                return Redirect::back()->with_errors($user->errors->all());
        }
    }

    public function get_logout()
    {
        Auth::logout();
        return Redirect::to_action('pages@index');
    }

}