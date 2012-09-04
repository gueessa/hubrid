<?php namespace Hybrid\Memory;

class Runtime extends Driver {

	/**
	 * Storage name
	 * 
	 * @access  protected
	 * @var     string  
	 */
	protected $storage = 'runtime';

	/**
	 * No initialize method for runtime
	 *
	 * @access  public
	 * @return  void
	 */
	public function initiate() {}

	/**
	 * No shutdown method for runtime
	 *
	 * @access  public
	 * @return  void
	 */
	public function shutdown() {}
}