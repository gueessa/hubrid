<?php namespace Hybrid\Memory;

abstract class Driver {

	/**
	 * Memory name
	 *
	 * @var     string
	 */
	protected $name = null;

	/**
	 * Memory configuration
	 *
	 * @var     array
	 */
	protected $config = array();

	/**
	 * Collection of key-value pair of either configuration or data
	 * 
	 * @var     array
	 */
	protected $data = array();

	/**
	 * Storage name
	 * 
	 * @var     string  
	 */
	protected $storage;

	/**
	 * Construct an instance.
	 *
	 * @param   string  $storage
	 */
	public function __construct($name = 'default', $config = array()) 
	{
		$this->name   = $name;
		$this->config = is_array($config) ? $config : array(); 

		$this->initiate();
	}

	/**
	 * Get value of a key
	 *
	 * @param   string  $key
	 * @param   mixed   $default
	 * @return  mixed
	 */
	public function get($key = null, $default = null)
	{
		return array_get($this->data, $key, $default);
	}

	/**
	 * Set a value from a key
	 *
	 * @param   string  $key
	 * @param   mixed   $value
	 * @return  void
	 */
	public function put($key, $value = '')
	{
		array_set($this->data, $key, $value);

		return $this;
	}

	/**
	 * Delete value of a key
	 *
	 * @access  public
	 * @param   string  $key
	 * @return  bool
	 */
	public function forget($key = null)
	{
		return array_forget($this->data, $key);
	}

	/**
	 * Initialize method
	 *
	 * @abstract
	 * @access  public
	 * @return  void
	 */
	public abstract function initiate();
	
	/**
	 * Shutdown method
	 *
	 * @abstract
	 * @access  public
	 * @return  void
	 */
	public abstract function shutdown();
}