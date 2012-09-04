<?php namespace Hybrid;

use \Config, \Exception, \Event;

class Core {
    
	/**
     * Core initiated status
     * 
     * @var boolean
     */
    protected static $initiated = false;
    
	/**
     * Cached instances for hybrid
     *
     * @var array
     */
    protected static $cached = array();
    
    /**
     * Start core
     * 
     * @return  void
     */
    public static function start()
    {
        // Avoid current method from being called more than once.
        if (true === static::$initiated) return;        
        
        // Make ACL instance
        static::$cached['acl'] = Acl::make('hybrid');
        
        // First, we need to ensure that Hybrid\Acl is compliance with
        // our Eloquent Model, This would overwrite the default configuration
        Config::set('hybrid::auth.roles', function($user, $roles)
        {
            foreach ($user->roles()->get() as $role)
            {
                array_push($roles, $role->name);
            }

            return $roles;
        });

        try
        {
            // Initiate Memory class
            static::$cached['memory'] = Memory::make('fluent.hybrid_options');
        
            if (is_null(static::$cached['memory']->get('site.name')))
            {
                throw new Exception('Installation is not completed');
            }
        
            // In event where we reach this point, we can consider no
            // exception has occur, we should be able to compile acl and menu
            // configuration
            static::$cached['acl']->attach(static::$cached['memory']);
        
            // In any event where Memory failed to load, we should set
            // Installation status to false routing for installation is
            // enabled.
            Installer::$status = true;
        
            static::loader();
            static::extensions();
        }
        catch (Exception $e)
        {
            // In any case where Exception is catched, we can be assure that
            // Installation is not done/completed, in this case we should use
            // runtime/in-memory setup
            static::$cached['memory'] = Memory::make('runtime.hybrid');
        
            //static::$cached['orchestra_menu']->add('install')->title('Install')->link(handles('hybrid::installer'));
        }        
        
        static::$initiated = true;
    }
    
    /**
     * Done core
     * 
     * @return  void
     */
   	public static function done()
    {
        // Only do this on installed application
        if (false === Installer::$status) return;
    } 
    
	/**
     * Get memory instance for hybrid
     *
     * @return  Hybrid\Memory
     */
    public static function memory()
    {
        return isset(static::$cached['memory']) ? static::$cached['memory'] : null;
    }

    /**
     * Get Acl instance for hybrid
     *
     * @return  Hybrid\Acl
     */
    public static function acl()
    {
        return isset(static::$cached['acl']) ? static::$cached['acl'] : null;
    }

    /**
     * Load Extensions for hybrid
     *
     * @return void
     */
    protected static function extensions()
    {
        $memory     = Core::memory();
        $availables = (array) $memory->get('extensions.available', array());
        $actives    = (array) $memory->get('extensions.active', array());
    
        foreach ($actives as $extension => $config)
        {
            if (is_numeric($extension))
            {
                $extension = $config;
                $config    = array();
                
                if (isset($availables[$extension]))
                {
                    $config = (array) $availables[$extension]['config'];
                }
            }
    
            if (isset($availables[$extension]))
            {
                Extension::start($extension, $config);
            }
        }
    
        // Resynchronize all active extension, this to ensure all configuration
        // is standard.
        $memory->put('extensions.active', Extension::all());
    }
    
    /**
     * Loader for hybrid
     * 
     * @return  void
     */
    protected static function loader()
    {
	   // Multiple event listener for Backend (administrator panel)
        Event::listen('hybrid.started: backend', function() 
        {
            
        });        
    }
}    