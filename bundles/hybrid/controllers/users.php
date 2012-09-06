<?php

use Hybrid\Messages,
    Hybrid\Model\Role,
    Hybrid\Model\User;

class Hybrid_Users_Controller extends Backend_Controller {
    
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
    * Dashboard Page
    *
    * @return Response
    */
    public function get_index()
    {
   	    $users = User::with('roles')->where_not_null('users.id');
       	$users = $users->paginate(30);
        
        $var = array(
            'users'     => $users,
            'title'     => 'Users',
            'json_data' => json_encode(array(
                'uset_id'   => 1,
                'username'  => 'tester',
                'fullname'  => 'Valery',
                'email'     => 'gueessa@gmail.com',
                'status_id' => '1',
                'last_login'=> '04.11.2012'    
            )),
        );
        
       	return View::make('hybrid::users.index', $var);
    }
}