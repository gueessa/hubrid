<?php

use Hybrid\Messages, Hybrid\Javascript;

class Hybrid_Auth_Controller extends Base_Controller {
    
    /**
     * Auth Layout
     * 
     * @var string
     */    
    public $layout = 'hybrid::layouts.auth';
    
    /**
     * Constructor
     * 
     * @return  void
     */
    public function __construct()
    {
        parent::__construct();

       	$this->filter('before', 'hybrid::not-auth')
            ->only(array('login', 'register'));
       	
        $this->filter('before', 'hybrid::csrf')
            ->only(array('login', 'register'))
            ->on(array('post'));
    }
    
    /**
     * Login
     *
     * Restful get method
     * 
     * @return Response
     */
    public function get_login()
    {
        $var['redirect'] = Session::get('hybrid.redirect', handles('hybrid'));
        
        if (Request::ajax())
        {
            $js = Javascript::make('jquery')
                ->html('#ajax-result')
                ->compile();
            
            View::share('javascript', $js); 
        }

        $this->layout->nest('content', 'hybrid::auth.login', $var);
    }

    /**
     * Login
     *
     * Restful post method
     * 
     * @return Response
     */
    public function post_login()
    {
        $input = Input::all();
        
        $rules = array(
            'username'  => array('required'),
            'password'  => array('required'),
        );
        
        $validator = Validator::make($input, $rules);
        
        // Validate user login, if any errors is found redirect it back to
        // login page with the errors
        if ($validator->fails())
        {
            return Redirect::to(handles('hybrid::login'))
                ->with_input()
                ->with_errors($validator);
        }
        
        $attempt = array(
            'username' => $input['email'],
            'password' => $input['password']
        );
        
        $messages = new Messages;
        
        // We should now attempt to login the user using Auth class,
        if (Auth::attempt($attempt))
        {
            Event::fire('hybrid.logged.in');
        
            $messages->add('success', __('hybrid::response.credential.logged-in'));
        
            $redirect = Input::get('redirect', handles('hybrid'));
        
            return Redirect::to($redirect)->with('message', $messages->serialize());
        }
        else
        {
            $messages->add('error', __('hybrid::response.credential.invalid-combination'));
        
            return Redirect::to(handles('hybrid::login'))->with('message', $messages->serialize());
        }
    }
    
    /**
     * Logout
     * 
     * Restful post method
     * 
     * @return Response
     */
    public function get_logout()
    {
        Auth::logout();
    
        Event::fire('hybrid.logged.out');
    
        $messages = new Messages;
        $messages->add('success', __('hybrid::response.credential.logged-out'));
    
        return Redirect::to(handles('hybrid::login'))->with('message', $messages->serialize());
    }    
}