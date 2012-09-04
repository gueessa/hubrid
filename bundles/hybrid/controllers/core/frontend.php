<?php

class Frontend_Controller extends Base_Controller {

    /**
     * Constructor
     * 
     * @return void 
     */
    public function __constructor() 
    { 
        parent::__construct(); 

        Event::fire('hybrid.started: frontend');
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