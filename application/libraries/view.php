<?php

class View extends \Laravel\View {
    
	/**
	 * Sets a bound variable by reference.
     * 
	 * @param   string  $key
	 * @param   mixed   $value
     * @return  View
	 */
	public function bind($key, & $value)
	{
		$this->data[$key] =& $value;
		
        return $this;
	}
    
	public static function share_bind($key, & $value)
	{
		static::$shared[$key] =& $value;
	}
    
}    