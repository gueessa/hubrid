<?php

class Base_Controller extends Controller {

	/**
     * Set Hybrid\Controller to default use Restful Controller
     *
     * @var boolean
     */
    public $restful = true;

    /**
     * Constructor
     * 
     * @return void 
     */
    public function __constructor() 
    { 
        parent::__construct(); 

		// All controller should be accessible only after Hybrid is installed.
		$this->filter('before', 'hybrid::installed');
        
        View::share('memory', Hybrid\Core::memory());           
    }

    /**
     * Before
     * 
     * @return void 
     */
    public function before()
    {
        parent::before();
    }
    
    /**
     * After method
     * 
     * @return  void
     */    
    public function after($response)
    {
        return parent::after($response);
    }
    
    /**
     * Error Override
     *
     * This is used to throw a 404 page with our
     * layout data assigned.
     *
     * @param   string  $method
     * @param   array   $args
     * @return  Response
     */
    public function __call($method, $args)
    {
        return Event::first('404');
    }        
}    