<?php namespace Hybrid\Javascript;


class Jquery {

    /**
     * Jquery function for compile.
     * 
     * @var array
     */
    protected $compile = array(); 
    
    /**
     * Html output container name.
     * 
     * @var string
     */
    protected $element = 'ajax-container';
    
    /**
     * Constructor
     * 
     * @param   string  $name
     * @param   array   $config
     * @return  void
     */
    public function __construct($name, $config = array())
    {
        
    }

    /**
     * HTML
     * 
     * @param   string  $element
     * @return  string
     */    
    public function html($element = null)
    {
        if (is_null($element))
        {
            $element = $this->element;
        }
        
		$event = PHP_EOL.'$(' . $this->prep_element($element) . ').html(html);' . PHP_EOL;
        
        $this->compile[] = $event;
        
		return $this;
    } 

    /**
     * Redirect
     * 
     * @param   string  $uri
     * @return  this
     */
    public function redirect($uri = '', $data = array())
    {
        if ( ! empty($data))
        {
    		if (\Config::get('session.driver') == '')
    		{
    			throw new Exception('A session driver must be set before setting flash data.');
    		}
            
            foreach ((array) $data as $key => $value)
            {
                \Session::flash($key, $value);    
            }
        }
        
        $this->compile[] = "window.location.href = '".(empty($uri) ? '/' : \URL::to($uri))."'".PHP_EOL;
        
        return $this; 
    }    

    /**
     * Compile
     * 
     * @param   bool    $return
     * @param   bool    $script_tags
     * @return  string|void
     */ 
    public function compile($return = true, $script_tags = true)
	{
		if (count($this->compile) == 0)
		{
			return;
		}
        
        $script  = 'document.onHBRun = function(html) { '.PHP_EOL;
        $script .= implode('', $this->compile);
		$script .= '}';
		
        $output = ($script_tags == false) ? $script : $this->inline($script);
        
        if ($return == true)
        {
            return $output;
        }
        
        echo $output;  
	} 

	/**
	 * Clear Compile
	 *
	 * @return	void
	 */
	public function clear_compile()
	{
		$this->compile = array();
	}       
  
    /**
     * Prep Element
     * 
     * @param   string  $element
     * @return  string
     */
	protected function prep_element($element)
	{
		if ($element != 'this')
		{
			$element = '"' . $element . '"';
		}
        
		return $element;
	}
    
    /**
     * Inline
     * 
     * @param   string  $script
     * @param   bool    $cdata
     * @return  string
     */    
    protected function inline($script, $cdata = true)
	{
		$str  = $this->open_script();
		$str .= $cdata ? PHP_EOL . "// <![CDATA[".PHP_EOL.$script.PHP_EOL."// ]]>" . PHP_EOL : PHP_EOL . $script . PHP_EOL;
		$str .= $this->close_script();
        
		return $str;
	}
    
    /**
     * Open script tag
     * 
     * @param   string  $src
     * @return  string
     */ 
    protected function open_script($src = '')
	{
		$str  = '<script type="text/javascript" charset="' . strtolower(\Config::get('application.encoding', 'utf-8')) . '"';
		$str .= ($src == '') ? '>' : ' src="'. $src .'">';
        
		return $str;
	}
  
    /**
     * Close script tag
     * 
     * @return  string
     */ 
    protected function close_script()
	{
		return '</script>'.PHP_EOL;
	}  
}    