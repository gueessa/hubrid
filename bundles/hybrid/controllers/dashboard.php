<?php

class Hybrid_Dashboard_Controller extends Backend_Controller {
    
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
        $var = array();
        
        $this->layout->nest('content', 'hybrid::dashboard.index', $var);
    }
}