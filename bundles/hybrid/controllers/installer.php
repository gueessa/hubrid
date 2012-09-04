<?php

use Hybrid\Core,
    Hybrid\Installer,
    Hybrid\Installer\Runner,
    Hybrid\Messages;

class Hybrid_Installer_Controller extends Base_Controller {
    
    /**
     * Installer Layout
     * 
     * @var string
     */    
    public $layout = 'hybrid::layouts.installer';

	/**
     * Set Hybrid\Controller to default use Restful Controller
     *
     * @var boolean
     */
    public $restful = false;
    
    /**
     * Constructor
     * 
     * @return  void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Index action
     * 
     * Initiate Installer and show database and environment setting
     * 
     * @return Response
     */
    public function action_index()
    {
   	    Session::flush();

        $driver     = Config::get('database.default', 'mysql');
        $database   = Config::get('database.connections.'.$driver, array());
        $auth       = Config::get('auth');

        // for security, we shouldn't expose database connection to anyone.
        if (isset($database['password']) and ($password = strlen($database['password'])))
        {
            $database['password'] = str_repeat('*', $password);
        }
        
        // Check database connection, we should be able to indicate the user
        // whether the connection is working or not.
        $database['status'] = Installer::check_database();
        
        $var = array(
            'auth'     => $auth,
            'database' => $database,
        );
        
        $this->layout->content = View::make('hybrid::installer.step1', $var);
    }
    
    /**
     * Installation steps, migrate database as well as create first 
     * administration user for current application
     * 
     * @param   integer $step
     * @return  Response
     */
   	public function action_steps($step)
    {
		$var = array(
			'site_name' => 'Hybrid Website',
		);
        
   	    switch (intval($step))
        {
            case 1:
                // step 1 involve running basic database migrations so we can
                // run hybrid properly. Extension migration will not be
                // done at this point.
                Runner::install();

                $this->layout->content = View::make('hybrid::installer.step2', $var);
                break;
            
            case 2:
           	    Session::flush();
                // Step 2 involve creating administation user account for
                // current application.
                if (Runner::create_user())
                {
                    $this->layout->content = View::make('hybrid::installer.step3', $var);
                }
                else
                {
                    $message = new Messages;
                    $message->add('error', 'Unable to create user');
                
                    return Redirect::to(handles('hybrid::installer/steps/1'))->with('message', serialize($message));
                }
                break;
        }
    }
}    