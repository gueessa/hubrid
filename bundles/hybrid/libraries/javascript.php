<?php namespace Hybrid;

use \Config, \Exception;

class Javascript {
    
    /**
     * Cache javascript instance so we can reuse it
     * 
     * @var Javascript\Driver
     */
    protected static $instances = array();

    /**
     * Make a new Javascript instance
     *
     * @param   string  $name
     * @param   array   $config
     * @return  Javascript\Driver
     */
    public static function make($name, $config = array())
    {
        if (false === strpos($name, '.')) $name = $name.'.default';
    
        list($type, $_name) = explode('.', $name, 2);
    
        if ( ! isset(static::$instances[$name]))
        {
            switch ($type)
            {
                case 'jquery':
                    static::$instances[$name] = new Javascript\Jquery($_name, $config);
                    break;
                default :
                    throw new Exception("Requested Hybrid\Javascript Driver [{$type}] does not exist.");
            }
        }
    
        return static::$instances[$name];
    }

    /**
     * Hybrid\Javascript doesn't support a construct method
     *
     * @return  void
     */
    protected function __construct() {}    
}    