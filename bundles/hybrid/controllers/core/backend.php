<?php

class Backend_Controller extends Base_Controller {

    /**
     * Backend Layout
     * 
     * @var string
     */    
    public $layout = 'hybrid::layouts.base';
    
    /**
     * Constructor
     * 
     * @return void 
     */
    public function __constructor() 
    { 
        parent::__construct(); 

        $this->filter('before', 'hybrid::auth');
    
        Event::fire('hybrid.started: backend');
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
}