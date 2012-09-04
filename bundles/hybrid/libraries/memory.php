<?php namespace Hybrid;

use \Config, \Event;

class Memory {

	/**
	 * Memory initiated status
	 *
	 * @var boolean
	 */
	protected static $initiated = false;

	/**
	 * Cache memory instance so we can reuse it
	 * 
	 * @var array
	 */
	protected static $instances = array();

	/**
	 * Run Memory start configuration once before doing anything else.
	 *
	 * @return void
	 */
	protected static function start()
	{
		if (false === static::$initiated)
		{
			Event::listen('laravel.done', function($response) { Memory::shutdown(); });

			static::$initiated = true;
		}
	}

	/**
	 * Initiate a new Memory instance
	 * 
	 * @param   string  $name
	 * @param   array   $config
	 * @return  Memory
	 */
	public static function make($name = null, $config = array())
	{
		static::start();

		if (is_null($name)) $name = 'runtime.default';

		if (false === strpos($name, '.')) $name = $name.'.default';

		list($storage, $_name) = explode('.', $name, 2);

		$name = $storage.'.'.$_name;
		
		if ( ! isset(static::$instances[$name]))
		{
			switch ($storage)
			{
				case 'fluent' :
					if ($_name === 'default') $_name = Config::get('hybrid::memory.default_table');
					static::$instances[$name] = new Memory\Fluent($_name, $config);
					break;
				case 'eloquent' :
					if ($_name === 'default') $_name = Config::get('hybrid::memory.default_model');
					static::$instances[$name] = new Memory\Eloquent($_name, $config);
					break;
				case 'cache' :
					static::$instances[$name] = new Memory\Cache($_name, $config);
					break;
				case 'runtime' :
					static::$instances[$name] = new Memory\Runtime($_name, $config);
					break;
				default :
					throw new Exception("Requested Hybrid\Memory Driver [$storage] does not exist.");
			}
		}

		return static::$instances[$name];
	}

	/**
	 * UI\Memory doesn't support a construct method
	 *
	 * @access  protected
	 */
	protected function __construct() {}

	/**
	 * Loop every instance and execute shutdown method (if available)
	 *
	 * @static
	 * @access  public
	 * @return  void
	 */
	public static function shutdown()
	{
		foreach (static::$instances as $name => $class)
		{
			$class->shutdown();
		}
	}
}